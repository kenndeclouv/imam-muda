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
    public function index()
    {
        return view('superadmin.admin.index', ['admins' => Admin::all()]);
    }

    public function create()
    {
        return view('superadmin.admin.create');
    }

    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();

        
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'photo' => $validated['photo'],
            'name' => $validated['fullname'],
            'role_id' => 2,
        ]);

        
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

        
        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'photo' => $validated['photo'],
            'name' => $validated['fullname'],
        ]);

        
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
        $permissions = $admin->User->Permissions;

        return view('superadmin.admin.permissions', compact('admin', 'permissions', 'features'));
    }

    public function permissionsStore(Request $request, Admin $admin)
    {
        foreach ($request->feature_id as $feature) {
            if ($admin->User->Permissions()->where('feature_id', $feature)->exists()) {
                return back()->with('error', 'Fitur sudah ada.');
            }
            if ($feature == 1) {
                $admin->User->Permissions()->delete();
            }
            Permission::create(['user_id' => $admin->user_id, 'feature_id' => $feature]);
        }
        return redirect()->route('superadmin.admin.permissions', $admin->id)->with('success', 'Ijin Akses berhasil ditambahkan.');
    }

    public function permissionsDestroy(Permission $permission)
    {
        $permission->delete();
        return back()->with('success', 'Ijin Akses berhasil dihapus.');
    }
}
