<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('Admin.index',['title'=>'Admin']); // Assuming you have a view file for the Imam home page
    }
}
