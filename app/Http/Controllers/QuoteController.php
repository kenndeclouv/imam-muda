<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function index()
    {
        $role = Auth::user()->Role->code;
        $quotes = Quote::all();
        return view("{$role}.quote.index", compact('quotes'));
    }

    public function create()
    {
        $role = Auth::user()->Role->code;
        return view("{$role}.quote.create");
    }

    public function store(Request $request)
    {
        $role = Auth::user()->Role->code;
        $request->validate([
            'content' => 'required|string',
            'source' => 'nullable|string',
        ]);

        Quote::create($request->all());

        return redirect()->route("{$role}.quote.index")
            ->with('success', 'Quote berhasil dibuat.');
    }

    public function edit(Quote $quote)
    {
        $role = Auth::user()->Role->code;
        return view("{$role}.quote.edit", compact('quote'));
    }

    public function update(Request $request, Quote $quote)
    {
        $role = Auth::user()->Role->code;
        $request->validate([
            'content' => 'required|string',
            'source' => 'nullable|string',
        ]);

        $quote->update($request->all());

        return redirect()->route("{$role}.quote.index")
            ->with('success', 'Quote berhasil diperbarui.');
    }

    public function destroy(Quote $quote)
    {
        $role = Auth::user()->Role->code;
        $quote->delete();

        return redirect()->route("{$role}.quote.index")
            ->with('success', 'Quote berhasil dihapus.');
    }
    public function toggleStatus(Quote $quote)
    {
        $role = Auth::user()->Role->code;
        $allQuotes = Quote::all();
        foreach ($allQuotes as $q) {
            $q->update(['status' => false]);
        }
        $quote->update(['status' => true]);
        return redirect()->route("{$role}.quote.index")->with('success', 'Quote berhasil ditampilkan.');
    }
    public function randomQuote(Request $request)
    {
        $query = $request->input('query');
        $quote = Quote::query();
        if ($query) {
            $quote->where('content', 'LIKE', '%' . $query . '%')
                ->orWhere('source', 'LIKE', '%' . $query . '%');
        }
        return response()->json($quote->inRandomOrder()->first());
    }
}
