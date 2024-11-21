<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('SuperAdmin.Admin.index', compact('admins'));
    }

    public function create()
    {
        return view('SuperAdmin.Admin.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
    }
}
