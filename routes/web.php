<?php
//global
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\LogViewerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\Auth\LoginController;
// API
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\UserNotificationController;

// Admin
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ImamController as AdminImamController;
use App\Http\Controllers\Admin\MasjidController as AdminMasjidController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\ShalatController as AdminShalatController;
use App\Http\Controllers\Admin\FeeController as AdminFeeController;
use App\Http\Controllers\Admin\StatisticController as AdminStatisticController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
// Imam
use App\Http\Controllers\Imam\ScheduleController as ImamScheduleController;
use App\Http\Controllers\Imam\HomeController as ImamHomeController;

// SuperAdmin
use App\Http\Controllers\SuperAdmin\HomeController as SuperAdminHomeController;
use App\Http\Controllers\SuperAdmin\AdminController as SuperAdminAdminController;

// use Arcanedev\LogViewer\Contracts\LogViewer as ContractsLogViewer;

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
// Islamic Quote
Route::middleware(['apiKey', 'throttle:120,1'])->group(function () {
    Route::get('/api/quotes', [QuoteController::class, 'quotes']);
    Route::get('/api/quote', [QuoteController::class, 'quote']);

    Route::get('/api/random-quotes', [QuoteController::class, 'randomQuotes']);
    Route::get('/api/random-quote', [QuoteController::class, 'randomQuote']);

});

Route::post('/api/upload-combined-json', [QuoteController::class, 'uploadCombinedJson']);
// Route::post('/api/upload-hadith-bukhari-json', [QuoteController::class, 'uploadHadithBukhariJson']);
// Route::post('/api/upload-hadith-muslim-json', [QuoteController::class, 'uploadHadithMuslimJson']);

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

// Routes untuk SuperAdmin
Route::prefix('superadmin')->name('superadmin.')->middleware(['auth', 'can:isSuperAdmin'])->group(function () {
    Route::get('/home', [SuperAdminHomeController::class, 'index'])->name('home');
    Route::get('/log-viewer', [LogViewerController::class, 'index'])->name('logs');
    Route::get('/log-viewer/show/{filename}', [LogViewerController::class, 'show'])->name('logs.show');
    Route::delete('/log-viewer/delete/{filename}', [LogViewerController::class, 'destroy'])->name('logs.destroy');
    Route::get('/log-viewer/download/{filename}', [LogViewerController::class, 'download'])->name('logs.download');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [SuperAdminAdminController::class, 'index'])->name('index');
        Route::get('/create', [SuperAdminAdminController::class, 'create'])->name('create');
        Route::post('/create', [SuperAdminAdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SuperAdminAdminController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [SuperAdminAdminController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SuperAdminAdminController::class, 'destroy'])->name('destroy');

        Route::get('/permissions/{id}', [SuperAdminAdminController::class, 'permissions'])->name('permissions');
        Route::post('/permissions/{id}', [SuperAdminAdminController::class, 'permissionsStore'])->name('permissions.store');
        Route::get('/permissions/edit/{id}', [SuperAdminAdminController::class, 'permissionsEdit'])->name('permissions.edit');
        Route::put('/permissions/edit/{id}', [SuperAdminAdminController::class, 'permissionsUpdate'])->name('permissions.update');
        Route::delete('/permissions/delete/{id}', [SuperAdminAdminController::class, 'permissionsDestroy'])->name('permissions.destroy');

    });
});

// Routes untuk Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
    Route::put('/account', [AdminHomeController::class, 'update'])->name('update');

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
        Route::get('/', [AdminShalatController::class, 'index'])->name('index');
        Route::get('/create', [AdminShalatController::class, 'create'])->name('create');
        Route::post('/create', [AdminShalatController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminShalatController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AdminShalatController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminShalatController::class, 'destroy'])->name('destroy');
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
        Route::get('/', [AdminFeeController::class, 'index'])->name('index');
        Route::get('/create', [AdminFeeController::class, 'create'])->name('create');
        Route::post('/create', [AdminFeeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminFeeController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AdminFeeController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminFeeController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('statistik')->name('statistik.')->group(function () {
        Route::get('/', [AdminStatisticController::class, 'statistik'])->name('index');
    });
    Route::prefix('rekap')->name('rekap.')->group(function () {
        Route::get('/imam', [RekapController::class, 'imam'])->name('imam.index');
        Route::get('/imam/export', [RekapController::class, 'exportImam'])->name('imam.export');
    });
    Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
        Route::get('/', [AdminAnnouncementController::class, 'index'])->name('index');
        Route::get('/create', [AdminAnnouncementController::class, 'create'])->name('create');
        Route::post('/create', [AdminAnnouncementController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminAnnouncementController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AdminAnnouncementController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminAnnouncementController::class, 'destroy'])->name('destroy');
    });
});

// Routes untuk Imam
Route::prefix('imam')->name('imam.')->middleware(['auth', 'can:isImam'])->group(function () {
    Route::get('/home', [ImamHomeController::class, 'index'])->name('home');
    Route::put('/account', [ImamHomeController::class, 'update'])->name('update');

    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [ImamScheduleController::class, 'index'])->name('index');
        Route::get('/fetch', [ImamScheduleController::class, 'fetch'])->name('fetch');
        Route::post('/updateJSON', [ImamScheduleController::class, 'updateJSON'])->name('updateJSON');
        Route::get('/create', [ImamScheduleController::class, 'create'])->name('create');
        Route::post('/create', [ImamScheduleController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ImamScheduleController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [ImamScheduleController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ImamScheduleController::class, 'destroy'])->name('destroy');

        Route::post('/cari-badal/{id}', [ImamScheduleController::class, 'cariBadal'])->name('cariBadal');
        Route::post('/done/{id}', [ImamScheduleController::class, 'done'])->name('done');
        Route::post('/cancel/{id}', [ImamScheduleController::class, 'cancel'])->name('cancel');
    });
});
