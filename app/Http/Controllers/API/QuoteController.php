<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ayah;
use App\Models\HadithMuslim as Hadith;
use App\Models\Quote;
use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    public function quotes(Request $request)
    {
        $query = $request->input('query');
        $minLength = $request->input('minLength', 0); // Default: 0
        $maxLength = $request->input('maxLength', PHP_INT_MAX); // Default: tidak terbatas
        $tags = $request->input('tags');
        $limit = $request->input('limit', 10); // Default: 10
        $page = $request->input('page', 1); // Default: halaman pertama

        $quotes = Quote::query();

        // Filter berdasarkan query
        if ($query) {
            $quotes->where('quote', 'LIKE', '%' . $query . '%')
                ->orWhere('source', 'LIKE', '%' . $query . '%');
        }

        // Filter berdasarkan panjang
        if ($minLength) {
            $quotes->where('length', '>=', $minLength);
        }
        if ($maxLength) {
            $quotes->where('length', '<=', $maxLength);
        }
        if ($tags) {
            $quotes->where('tags', '==', $tags);
        }

        // Hitung total data
        $totalCount = $quotes->count();

        // Pagination
        $results = $quotes->skip(($page - 1) * $limit)->take($limit)->get();
        $totalPages = (int) ceil($totalCount / $limit);
        $lastItemIndex = ($page - 1) * $limit + $results->count();

        return response()->json([
            "count" => $results->count(),
            "totalCount" => $totalCount,
            "page" => $page,
            "totalPages" => $totalPages,
            "lastItemIndex" => $lastItemIndex,
            "results" => $results,
        ]);
    }


    public function quote(Request $request)
    {
        $id = $request->input('id');
        $minLength = $request->input('minLength', 0); // Default: 0
        $maxLength = $request->input('maxLength', PHP_INT_MAX); // Default: tidak terbatas
        $tags = $request->input('tags');
        $query = $request->input('query');

        $quote = Quote::query();

        if ($id) {
            $quote->where('id', $id);
        }
        if ($query) {
            $quote->where('content', 'LIKE', '%' . $query . '%')
                ->orWhere('source', 'LIKE', '%' . $query . '%')
                ->orWhere('tags', 'LIKE', '%' . $query . '%');
        }
        // Filter berdasarkan panjang
        if ($minLength) {
            $quote->where('length', '>=', $minLength);
        }
        if ($maxLength) {
            $quote->where('length', '<=', $maxLength);
        }
        if ($tags) {
            $quote->where('tags', '==', $tags);
        }
        return response()->json($quote->first());
    }

    public function randomQuote(Request $request)
    {
        $tags = $request->input('tags');
        $minLength = $request->input('minLength', 0); // Default: 0
        $maxLength = $request->input('maxLength', PHP_INT_MAX); // Default: tidak terbatas
        $query = $request->input('query');
        $quote = Quote::query();
        if ($query) {
            $quote->where('content', 'LIKE', '%' . $query . '%')
                ->orWhere('source', 'LIKE', '%' . $query . '%')
                ->orWhere('tags', 'LIKE', '%' . $query . '%');
        }
        if ($tags) {
            $quote->where('tags', '==', $tags);
        }
        if ($minLength) {
            $quote->where('length', '>=', $minLength);
        }
        if ($maxLength) {
            $quote->where('length', '<=', $maxLength);
        }
        return response()->json($quote->inRandomOrder()->first());
    }

    public function randomQuotes(Request $request)
    {
        $limit = $request->input('limit', 10); // Default: 10
        $tags = $request->input('tags');
        $minLength = $request->input('minLength', 0); // Default: 0
        $maxLength = $request->input('maxLength', PHP_INT_MAX); // Default: tidak terbatas
        $query = $request->input('query');
        $quote = Quote::query();
        if ($query) {
            $quote->where('content', 'LIKE', '%' . $query . '%')
                ->orWhere('source', 'LIKE', '%' . $query . '%')
                ->orWhere('tags', 'LIKE', '%' . $query . '%');
        }
        if ($tags) {
            $quote->where('tags', '==', $tags);
        }
        if ($minLength) {
            $quote->where('length', '>=', $minLength);
        }
        if ($maxLength) {
            $quote->where('length', '<=', $maxLength);
        }
        return response()->json($quote->inRandomOrder()->limit($limit)->get());
    }

    public function uploadJson(Request $request)
    {
        // validasi input
        $request->validate([
            'json' => 'required|file'
        ]);

        // baca file json
        $jsonData = json_decode(file_get_contents($request->file('json')->getPathname()), true);

        // proses setiap item dalam json
        foreach ($jsonData as $item) {
            Hadith::updateOrCreate(
                ['number' => $item['number']], // identifikasi unik
                ['arab' => $item['arab'], 'ind' => $item['id']] // data yang akan diupdate/insert
            );
        }

        return back()->with('success', 'Data successfully uploaded!');
    }

    public function uploadCombinedJson(Request $request)
    {
        // validasi file
        $request->validate([
            'file_arab' => 'required|file',
            'file_ind' => 'required|file',
            'file_en' => 'required|file',
        ]);

        // baca file json
        $jsonArab = file_get_contents($request->file('file_arab')->getPathname());
        $jsonInd = file_get_contents($request->file('file_ind')->getPathname());
        $jsonEn = file_get_contents($request->file('file_en')->getPathname());

        $surahsArab = json_decode($jsonArab, true);
        $surahsInd = json_decode($jsonInd, true);
        $surahsEn = json_decode($jsonEn, true);
        
        // pastikan struktur kedua json sama
        if (!$surahsArab || !$surahsInd || !$surahsEn || count($surahsArab) !== count($surahsInd) || count($surahsArab) !== count($surahsEn)) {
            return response()->json(['error' => 'File tidak valid atau tidak cocok'], 400);
        }

        return response()->json(
            array_map(function ($surahArab, $index) use ($surahsInd, $surahsEn) {
                return [
                    'number' => $surahArab['number'],
                    'name' => $surahArab['name'],
                    'english_name' => $surahArab['englishName'],
                    'english_name_translation' => $surahArab['englishNameTranslation'],
                    'revelation_type' => $surahArab['revelationType'],
                    'ayahs' => array_map(function ($ayahArab, $i) use ($surahsInd, $surahsEn, $index) {
                        return [
                            'number' => $ayahArab['number'],
                            'arab' => $ayahArab['arab'],
                            'ind' => $surahsInd[$index]['ayahs'][$i]['ind'],
                            'en' => $surahsEn[$index]['ayahs'][$i]['en'],
                            'number_in_surah' => $ayahArab['numberInSurah'],
                            'juz' => $ayahArab['juz'],
                            'manzil' => $ayahArab['manzil'],
                            'page' => $ayahArab['page'],
                            'ruku' => $ayahArab['ruku'],
                            'hizb_quarter' => $ayahArab['hizbQuarter'],
                            'sajda' => $ayahArab['sajda'],
                        ];
                    }, $surahArab['ayahs'], array_keys($surahArab['ayahs'])),
                ];
            }, $surahsArab, array_keys($surahsArab))
        );
    }
}
