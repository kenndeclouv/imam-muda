<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Imam;
use App\Models\ListFee;
use App\Models\Masjid;
use App\Models\Shalat;
use Illuminate\Http\Request;

class ListFeeController extends Controller
{
    public function index($id)
    {
        $fee = Fee::findOrFail($id);
        $listFees = ListFee::where('fee_id', $id)->with('Fee')->get();
        switch ($fee->type) {
            case 'imam':
                $data = Imam::whereDoesntHave('ListFee')->get();
                break;
            case 'masjid':
                $data = Masjid::whereDoesntHave('ListFee')->get();
                break;
            case 'shalat':
                $data = Shalat::whereDoesntHave('ListFee')->get();
                break;
        }
        return view('admin.bayaran.list', compact('listFees', 'data', 'fee'));
    }

    public function create()
    {
        $imams = Imam::all();
        return view('admin.bayaran.create', compact('imams'));
    }

    public function store(Request $request, $id)
    {
        $fee = Fee::findOrFail($id);
        $request->validate([
            'data_id' => 'required',
            'fee_id' => 'required|exists:fees,id',
        ]);

        foreach ($request->data_id as $dataId) {
            switch ($fee->type) {
                case 'imam':
                    ListFee::create(['imam_id' => $dataId, 'fee_id' => $id]);
                    break;
                case 'masjid':
                    ListFee::create(['masjid_id' => $dataId, 'fee_id' => $id]);
                    break;
                case 'shalat':
                    ListFee::create(['shalat_id' => $dataId, 'fee_id' => $id]);
                    break;
                default:
                    // handle tipe tidak valid, kalau perlu
                    break;
            }
        }
        foreach ($request->data_id as $dataId) {
            $exists = ListFee::where('fee_id', $id)
                ->where(function ($query) use ($dataId, $fee) {
                    if ($fee->type == 'imam') $query->where('imam_id', $dataId);
                    if ($fee->type == 'masjid') $query->where('masjid_id', $dataId);
                    if ($fee->type == 'shalat') $query->where('shalat_id', $dataId);
                })->exists();

            if (!$exists) {
                ListFee::create([
                    ($fee->type == 'imam' ? 'imam_id' : ($fee->type == 'masjid' ? 'masjid_id' : 'shalat_id')) => $dataId,
                    'fee_id' => $id,
                ]);
            }
        }


        return redirect()->route('admin.bayaran.list.index', $fee->id)->with('success', 'Bayaran berhasil dibuat.');
        // return back()->with('success', 'Bayaran berhasil dibuat.');
    }

    public function destroy(ListFee $listFee)
    {
        $listFee->delete();
        return redirect()->route('admin.bayaran.list.index', $listFee->fee_id)->with('success', 'Bayaran berhasil dihapus.');
    }
}
