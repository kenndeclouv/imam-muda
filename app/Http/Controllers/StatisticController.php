<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Imam;
use App\Models\Masjid;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function statistik()
    {
        return view('admin.statistik.index');
    }
}
