<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Feature;
use App\Models\User;

class AdminController extends Controller
{
    private function uploadPhoto($photo)
    {
        $filename = uniqid() . '_' . time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('public/uploads/photo/'), $filename);
        return 'public/uploads/photo/' . $filename;
    }

    public function index()
    {
        $admins = Admin::all();
        return view('superadmin.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('superadmin.admin.create');
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'username' => 'required|string|max:50',
    //         'email' => 'nullable|email|max:255',
    //         'password' => 'required|string|min:8',
    //         'confirm_password' => 'required|same:password',
    //         'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5000',
    //     ], [
    //         'username.required' => 'Username harus diisi.',
    //         'username.string' => 'Username harus berupa string.',
    //         'username.max' => 'Username maksimal 50 karakter.',
    //         'password.required' => 'Password harus diisi.',
    //         'password.string' => 'Password harus berupa string.',
    //         'password.min' => 'Password minimal 8 karakter.',
    //         'confirm_password.required' => 'Konfirmasi password harus diisi.',
    //         'confirm_password.same' => 'Konfirmasi password harus sama dengan password.',
    //         'email.email' => 'Email harus berupa email yang valid.',
    //         'email.max' => 'Email maksimal 255 karakter.',
    //         'photo.file' => 'Foto harus berupa file.',
    //         'photo.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, atau gif.',
    //         'photo.max' => 'Foto maksimal 5MB.',
    //     ]);

    //     $validatedAdmin = $request->validate([
    //         'fullname' => 'required|string|max:50',
    //         'phone' => 'required|string|max:20',
    //         'birthplace' => 'required|string|max:100',
    //         'birthdate' => 'required|date',
    //         'description' => 'nullable|string|max:255',
    //         'address' => 'nullable|string|max:255',
    //     ], [
    //         'fullname.required' => 'Nama harus diisi.',
    //         'fullname.string' => 'Nama harus berupa string.',
    //         'fullname.max' => 'Nama maksimal 50 karakter.',
    //         'phone.required' => 'Nomor telepon harus diisi.',
    //         'phone.string' => 'Nomor telepon harus berupa string.',
    //         'phone.max' => 'Nomor telepon maksimal 20 karakter.',
    //         'birthplace.required' => 'Tempat lahir harus diisi.',
    //         'birthplace.string' => 'Tempat lahir harus berupa string.',
    //         'birthplace.max' => 'Tempat lahir maksimal 100 karakter.',
    //         'birthdate.required' => 'Tanggal lahir harus diisi.',
    //         'birthdate.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
    //         'description.max' => 'Deskripsi maksimal 255 karakter.',
    //         'address.max' => 'Alamat maksimal 255 karakter.',
    //     ]);

    //     $validated['name'] = $validatedAdmin['fullname'];
    //     $validated['role_id'] = 2;

    //     if ($request->hasFile('photo')) {
    //         $filename = uniqid() . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
    //         $photoPath = $request->file('photo')->move(public_path('public/uploads/photo/'), $filename);
    //         $validated['photo'] = 'public/uploads/photo/' . $filename;
    //     }

    //     $user = User::create($validated);

    //     $validatedAdmin['user_id'] = $user->id;

    //     Admin::create($validatedAdmin);

    //     return redirect()->route('superadmin.admin.index')->with('success', 'Admin berhasil ditambahkan.');
    // }
    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();

        // Proses upload foto (kalau ada)
        $validated['photo'] = $request->hasFile('photo')
            ? $this->uploadPhoto($request->file('photo'))
            : null;

        // Simpan user
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'photo' => $validated['photo'],
            'name' => $validated['fullname'],
            'role_id' => 2,
        ]);

        // Simpan admin
        Admin::create([
            'user_id' => $user->id,
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()->route('superadmin.admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }


    public function edit(Admin $admin)
    {
        return view('superadmin.admin.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $user = User::findOrFail($admin->user_id);
        $validated = $request->validated();

        // Proses upload foto (kalau ada)
        $validated['photo'] = $request->hasFile('photo')
            ? $this->uploadPhoto($request->file('photo'))
            : null;

        // Simpan user
        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'photo' => $validated['photo'],
            'name' => $validated['fullname'],
        ]);

        // Simpan admin
        $admin->update([
            'fullname' => $validated['fullname'],
            'phone' => $validated['phone'],
            'birthplace' => $validated['birthplace'],
            'birthdate' => $validated['birthdate'],
            'description' => $validated['description'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()->route('superadmin.admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('superadmin.admin.index')->with('success', 'Admin berhasil dihapus.');
    }

    public function permissions(Admin $admin)
    {
        $features = Feature::whereNotIn('id', $admin->User->Permissions->pluck('feature_id'))->get();

        $permissions = Permission::where('user_id', $admin->user_id)->get();
        return view('superadmin.admin.permissions', compact('admin', 'permissions', 'features'));
    }

    public function permissionsStore(Request $request, Admin $admin)
    {
        foreach ($request->feature_id as $feature) {
            $permissionExist = Permission::where('user_id', $admin->user_id)->where('feature_id', $feature)->first();
            if ($permissionExist) {
                return back()->with('error', 'Fitur sudah ada.');
            }
            if ($feature == 1) {
                $admin->User->Permissions()->delete();
                Permission::create([
                    'user_id' => $admin->user_id,
                    'feature_id' => 1
                ]);
            } else {
                Permission::create([
                    'user_id' => $admin->user_id,
                    'feature_id' => $feature
                ]);
            }
        }
        return redirect()->route('superadmin.admin.permissions', $admin->id)->with('success', 'Ijin Akses berhasil ditambahkan.');
    }
    public function permissionsDestroy(Permission $permission)
    {
        $permission->delete();
        return back()->with('success', 'Ijin Akses berhasil dihapus.');
    }
}
