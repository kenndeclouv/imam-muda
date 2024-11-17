<?php

namespace App\Http\Controllers\Imam;

use App\Http\Controllers\Controller;
use App\Models\Imam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('Imam.index'); // Assuming you have a view file for the Imam home page
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'juz' => 'nullable|integer',
            'school' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $imam = Imam::where('user_id', Auth::id())->firstOrFail();

        $imam->update($validated);

        return redirect()->route('account')->with('success', 'Imam berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $imam = Imam::findOrFail($id);
        $user = $imam->User; // Get the associated user
        $imam->delete();

        if ($user) {
            $user->delete(); // Delete the user as well
        }

        return redirect()->route('admin.imam.index')->with('success', 'Imam berhasil dihapus.');
    }
}
