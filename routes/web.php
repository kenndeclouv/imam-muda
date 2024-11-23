<?php
//global
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\LogViewerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImamController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ShalatController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\RekapController;

// API
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\UserNotificationController;

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
Route::prefix('superadmin')->name('superadmin.')->middleware(['auth', 'checkRole:superadmin'])->group(function () {
    Route::get('/home', [HomeController::class, 'superAdminHome'])->name('home');
    Route::get('/log-viewer', [LogViewerController::class, 'index'])->name('logs');
    Route::get('/log-viewer/show/{filename}', [LogViewerController::class, 'show'])->name('logs.show');
    Route::delete('/log-viewer/delete/{filename}', [LogViewerController::class, 'destroy'])->name('logs.destroy');
    Route::get('/log-viewer/download/{filename}', [LogViewerController::class, 'download'])->name('logs.download');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/create', [AdminController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('destroy');

        Route::get('/permissions/{id}', [AdminController::class, 'permissions'])->name('permissions');
        Route::post('/permissions/{id}', [AdminController::class, 'permissionsStore'])->name('permissions.store');
        Route::get('/permissions/edit/{id}', [AdminController::class, 'permissionsEdit'])->name('permissions.edit');
        Route::put('/permissions/edit/{id}', [AdminController::class, 'permissionsUpdate'])->name('permissions.update');
        Route::delete('/permissions/delete/{id}', [AdminController::class, 'permissionsDestroy'])->name('permissions.destroy');

    });
});

// Routes untuk Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'adminHome'])->name('home');
    Route::put('/account', [AccountController::class, 'updateAdmin'])->name('update');

    Route::prefix('imam')->name('imam.')->group(function () {
        Route::get('/', [ImamController::class, 'index'])->name('index');
        Route::get('/create', [ImamController::class, 'create'])->name('create');
        Route::post('/create', [ImamController::class, 'store'])->name('store');
        Route::get('/{imam}/edit', [ImamController::class, 'edit'])->name('edit');
        Route::put('/{imam}/edit', [ImamController::class, 'update'])->name('update');
        Route::delete('/{imam}/delete', [ImamController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('masjid')->name('masjid.')->group(function () {
        Route::get('/', [MasjidController::class, 'index'])->name('index');
        Route::get('/create', [MasjidController::class, 'create'])->name('create');
        Route::post('/create', [MasjidController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [MasjidController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [MasjidController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [MasjidController::class, 'destroy'])->name('destroy');
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
        Route::get('/', [ScheduleController::class, 'index'])->name('index');
        Route::get('/fetch', [ScheduleController::class, 'fetch'])->name('fetch');
        Route::get('/create', [ScheduleController::class, 'create'])->name('create');
        Route::post('/create', [ScheduleController::class, 'store'])->name('store');

        Route::post('/updateJSON', [ScheduleController::class, 'updateJSON'])->name('updateJSON');
        Route::get('/{schedule}/edit', [ScheduleController::class, 'edit'])->name('edit');
        Route::put('/{schedule}/edit', [ScheduleController::class, 'update'])->name('update');
        Route::delete('/{schedule}/delete', [ScheduleController::class, 'destroy'])->name('destroy');
        Route::delete('/delete-selected', [ScheduleController::class, 'destroySelected'])->name('destroySelected');
    });
    Route::prefix('bayaran')->name('bayaran.')->group(function () {
        Route::get('/', [FeeController::class, 'index'])->name('index');
        Route::get('/create', [FeeController::class, 'create'])->name('create');
        Route::post('/create', [FeeController::class, 'store'])->name('store');
        Route::get('/{fee}/edit', [FeeController::class, 'edit'])->name('edit');
        Route::put('/{fee}/edit', [FeeController::class, 'update'])->name('update');
        Route::delete('/{fee}/delete', [FeeController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('statistik')->name('statistik.')->group(function () {
        Route::get('/', [StatisticController::class, 'statistik'])->name('index');
    });
    Route::prefix('rekap')->name('rekap.')->group(function () {
        Route::get('/imam', [RekapController::class, 'imam'])->name('imam.index');
        Route::get('/imam/export', [RekapController::class, 'exportImam'])->name('imam.export');
    });
    Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('index');
        Route::get('/create', [AnnouncementController::class, 'create'])->name('create');
        Route::post('/create', [AnnouncementController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AnnouncementController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AnnouncementController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AnnouncementController::class, 'destroy'])->name('destroy');
    });
});

// Routes untuk Imam
Route::prefix('imam')->name('imam.')->middleware(['auth', 'checkRole:imam'])->group(function () {
    Route::get('/home', [HomeController::class, 'imamHome'])->name('home');
    Route::put('/account', [AccountController::class, 'updateImam'])->name('update');

    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('index');
        Route::get('/fetch', [ScheduleController::class, 'fetch'])->name('fetch');
        Route::post('/updateJSON', [ScheduleController::class, 'updateJSON'])->name('updateJSON');
        Route::get('/create', [ScheduleController::class, 'create'])->name('create');
        Route::post('/create', [ScheduleController::class, 'store'])->name('store');
        Route::get('/{schedule}/edit', [ScheduleController::class, 'edit'])->name('edit');
        Route::put('/{schedule}/edit', [ScheduleController::class, 'update'])->name('update');
        Route::delete('/{schedule}/delete', [ScheduleController::class, 'imamDestroy'])->name('destroy');

        Route::post('/{schedule}/cari-badal', [ScheduleController::class, 'imamCariBadal'])->name('cariBadal');
        Route::post('/{schedule}/done', [ScheduleController::class, 'imamDone'])->name('done');
        Route::post('/{schedule}/cancel', [ScheduleController::class, 'imamCancel'])->name('cancel');
    });
});
