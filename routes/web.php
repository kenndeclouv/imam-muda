<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ImamController as AdminImamController;
use App\Http\Controllers\Admin\MasjidController as AdminMasjidController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\ShalatController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\SuperAdmin\HomeController as SuperAdminHomeController;
use App\Http\Controllers\Imam\HomeController as ImamHomeController;
use Illuminate\Support\Facades\Route;

// Route untuk Landing Page
Route::get('/', function () {
    return view('index');
})->name('landingpage');

//API
Route::middleware(['auth'])->group(function () {
    Route::get('/api/get-imam-schedule-data', [APIController::class, 'getImamScheduleData']);
    Route::get('/api/get-masjid-schedule-data', [APIController::class, 'getMasjidScheduleData']);
    Route::get('/api/get-masjid-shalat-schedule-data', [APIController::class, 'getMasjidShalatScheduleData']);
    Route::get('/api/get-notifications', [UserNotificationController::class, 'getNotifications']);
    Route::post('/api/mark-notification-as-read', [UserNotificationController::class, 'markNotificationAsRead']);
});

// Routes untuk Login dan Logout
Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Routes untuk Account
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account/shortcut', [AccountController::class, 'storeShortcut'])->name('account.shortcut');
    Route::put('/account/update/{id}', [AccountController::class, 'update'])->name('account.update');
});

// Routes untuk Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/home', [AdminHomeController::class, 'index'])->name('home');

    Route::prefix('imam')->name('imam.')->group(function () {
        Route::get('/', [AdminImamController::class, 'index'])->name('index');
        Route::get('/create', [AdminImamController::class, 'create'])->name('create');
        Route::post('/create', [AdminImamController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminImamController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AdminImamController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminImamController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('masjid')->name('masjid.')->group(function () {
        Route::get('/', [AdminMasjidController::class, 'index'])->name('index');
        Route::get('/create', [AdminMasjidController::class, 'create'])->name('create');
        Route::post('/create', [AdminMasjidController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminMasjidController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AdminMasjidController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminMasjidController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('shalat')->name('shalat.')->group(function () {
        Route::get('/', [ShalatController::class, 'index'])->name('index');
        Route::get('/create', [ShalatController::class, 'create'])->name('create');
        Route::post('/create', [ShalatController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ShalatController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [ShalatController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ShalatController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [AdminScheduleController::class, 'index'])->name('index');
        Route::get('/fetch', [AdminScheduleController::class, 'fetch'])->name('fetch');
        Route::get('/create', [AdminScheduleController::class, 'create'])->name('create');
        Route::post('/create', [AdminScheduleController::class, 'store'])->name('store');

        Route::post('/updateJSON', [AdminScheduleController::class, 'updateJSON'])->name('updateJSON');
        Route::get('/edit/{id}', [AdminScheduleController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AdminScheduleController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminScheduleController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('bayaran')->name('bayaran.')->group(function () {
        Route::get('/', [FeeController::class, 'index'])->name('index');
        Route::get('/create', [FeeController::class, 'create'])->name('create');
        Route::post('/create', [FeeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [FeeController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [FeeController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [FeeController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('statistik')->name('statistik.')->group(function () {
        Route::get('/', [AdminHomeController::class, 'statistik'])->name('index');
        Route::get('/bayaranimam', [AdminHomeController::class, 'bayaranimam'])->name('bayaranimam');
    });
});

// Routes untuk SuperAdmin
Route::prefix('superadmin')->name('superadmin.')->middleware(['auth', 'can:isSuperAdmin'])->group(function () {
    Route::get('/home', [SuperAdminHomeController::class, 'index'])->name('home');
});

// Routes untuk Imam
Route::prefix('imam')->name('imam.')->middleware(['auth', 'can:isImam'])->group(function () {
    Route::get('/home', [ImamHomeController::class, 'index'])->name('home');
    Route::put('/account', [ImamHomeController::class, 'update'])->name('update');
});
