<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    public function index()
    {
        $suggestions = Suggestion::all();
        return view('suggestions.index', compact('suggestions'));
    }
    public function create()
    {
        return view('suggestions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Suggestion::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Saran berhasil dibuat.');
    }
}
