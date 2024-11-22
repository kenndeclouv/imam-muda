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
    public function Admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function UserNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }
    public function UserShortcuts()
    {
        return $this->hasMany(UserShortcut::class);
    }
    // public function setPhotoAttribute($value)
    // {
    //     $this->attributes['photo'] = 'public/uploads/photos/' . $value;
    // }
    private function getConsistentColor()
    {
        $hash = md5($this->name ?? 'Guest'); // hash nama user
        $color = substr($hash, 0, 6); // ambil 6 karakter pertama sebagai warna hex

        return $color;
    }
    public function getPhotoAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            return asset($value);
        }

        $randomColor = $this->getConsistentColor();
        $name = $this->name ?? 'Imam';

        return "https://api.dicebear.com/6.x/initials/svg?seed=" . urlencode($name) . "&backgroundColor=" . $randomColor;
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
    public function Permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function getPermissionCodes()
    {
        // cek jika user punya relasi Admin
        if ($this->Admin && $this->is_active == true) {
            $codes = $this->Permissions
                ? $this->Permissions->pluck('Feature.code')
                : collect([]);

            // cek jika user punya "all_feature"
            if ($codes->contains('all_feature')) {
                return Feature::pluck('code');
            }

            return $codes;
        } else {
            return collect([]);
        }
    }
}
