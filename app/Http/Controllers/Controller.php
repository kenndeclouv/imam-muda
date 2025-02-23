<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    /**
     * Central Controller
     *
     * Metode yang digunakan dalam semua controller
     * di aplikasi ini adalah CENTRAL CONTROLER
     *
     * jadi semua fitur yang ada di aplikasi ini
     * akan dibuatkan controller terpisah
     * dan setiap ROLE akan dijadikan satu controller
     *
     * contoh:
     * - {$role}.student.index
     *
     * maka yang keluar adalah:
     * - admin.student.index
     * - imam.student.index
     * - badal.student.index
     *
     * dan seterusnya untuk setiap fitur yang ada di aplikasi ini
     *
     **/
}
