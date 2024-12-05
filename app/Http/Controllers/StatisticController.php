<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
class StatisticController extends Controller
{
    public function statistik()
    {
        return view('admin.statistik.index');
    }
}
