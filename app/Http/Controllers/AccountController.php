<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Imam;
use App\Models\User;
use App\Models\UserShortcut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private function uploadPhoto($photo, $oldPhoto = null)
    {
        // Hapus foto lama jika ada dan valid path
        if ($oldPhoto && file_exists(public_path($oldPhoto))) {
            unlink(public_path($oldPhoto));
        }

        if ($photo) {
            // Cek apakah input berupa base64 (hasil cropper.js)
            if (preg_match('/^data:image\/(\w+);base64,/', $photo, $type)) {
                $photo = substr($photo, strpos($photo, ',') + 1);
                $type = strtolower($type[1]); // tipe file (jpg, png, dll.)

                // Validasi tipe file
                if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                    throw new \Exception('Invalid image type');
                }

                $photo = base64_decode($photo);
                if ($photo === false) {
                    throw new \Exception('Base64 decode failed');
                }

                // Generate nama file unik
                $filename = uniqid() . '_' . time() . '.' . $type;

                // Simpan file ke public/uploads/photo/
                $path = public_path('uploads/photo/') . $filename;
                file_put_contents($path, $photo);

                // Return path relatif
                return 'uploads/photo/' . $filename;
            } elseif ($photo instanceof \Illuminate\Http\UploadedFile) {
                // Jika input adalah file upload biasa
                $filename = uniqid() . '_' . time() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/photo/'), $filename);
                return 'uploads/photo/' . $filename;
            }
        }

        return null; // Kalau tidak ada file
    }

    public function index()
    {
        return view('account.index');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5000',
        ], [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah ada',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah ada',
        ]);

        if ($request->password) {
            $request->validate(['password' => 'required|string|min:8|confirmed'], [
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Password tidak cocok',
            ]);
            $validated['password'] = $request->password;
        }

        // dd($validated); // hasilnya password langsung string


        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
            $validated['photo'] = $this->uploadPhoto($request->file('photo'));
        }

        $user->update($validated);

        return redirect()->route('account')->with('success', 'Profile berhasil diperbarui!');
    }

    public function storeShortcut(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string',
            'icon' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        UserShortcut::create(array_merge($validated, ['user_id' => Auth::id()]));

        return back()->with('success', 'berhasil menambahkan shortcut');
    }

    public function updateImam(Request $request)
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
            'join_date' => 'nullable|date',
            'no_rekening' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'child_count' => 'nullable|integer',
            'wife_count' => 'nullable|integer',
        ]);

        Imam::where('user_id', Auth::id())->firstOrFail()->update($validated);

        return redirect()->route('account')->with('success', 'Imam berhasil diperbarui.');
    }

    public function updateAdmin(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'description' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        Admin::where('user_id', Auth::id())->firstOrFail()->update($validated);

        return redirect()->route('account')->with('success', 'Admin berhasil diperbarui.');
    }
}
