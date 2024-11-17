<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'plan',
        'active_plan',
        'billing',
        'status',
        'contact',
        'country',
        'order',
        'total_spent',
        'balance',
        'address',
        'img',
        'photo',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public static function boot()
    // {
    //     // Gunakan View Composer untuk semua view yang menggunakan navbar
    //     View::composer('layouts.navbar', function ($view) {
    //         $user = Auth::user();

    //         // Ambil semua route terdaftar
    //         $routes = collect(Route::getRoutes())->filter(function ($route) {
    //             // Hanya ambil route yang memiliki nama
    //             return $route->getName() !== null;
    //         });

    //         // Filter berdasarkan hak akses user
    //         $accessibleRoutes = $routes->filter(function ($route) use ($user) {
    //             // Logika akses: Sesuaikan dengan kebutuhan
    //             return $user->can('access-route', $route->getName());
    //         });

    //         // Kirim daftar route ke view
    //         $view->with('accessibleRoutes', $accessibleRoutes->pluck('uri', 'name'));
    //     });
    // }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function Role()
    {
        return $this->belongsTo(Role::class);
    }
    public function Schedule()
    {
        return $this->hasMany(Schedule::class);
    }
    public function Imam()
    {
        return $this->hasOne(Imam::class);
    }
    public function UserNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }
    public function UserShortcuts()
    {
        return $this->hasMany(UserShortcut::class);
    }
    public function getPhotoAttribute($value)
    {
        return (!empty($value) && !is_null($value)) ? asset('/storage/' . $value) : $value;
    }
    public function getAccessibleRoutes()
    {
        $user = Auth::user();
        $routes = collect(Route::getRoutes());

        $accessibleRoutes = $routes->filter(function ($route) use ($user) {
            // Ambil hanya middleware berupa string
            $middleware = collect($route->gatherMiddleware())->filter(fn($m) => is_string($m));

            // Cari middleware yang dimulai dengan "can:"
            $gateName = $middleware->first(fn($m) => str_starts_with($m, 'can:'));

            if ($gateName) {
                $gate = str_replace('can:', '', $gateName);

                // Evaluasi apakah user memiliki izin untuk Gate ini
                return Gate::forUser($user)->allows($gate);
            }

            // Jika tidak ada middleware "can", anggap route public
            return true;
        });

        // Format hasil yang diinginkan
        return $accessibleRoutes->map(function ($route) {
            return [
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'method' => implode('|', $route->methods()),
            ];
        });
    }
}
