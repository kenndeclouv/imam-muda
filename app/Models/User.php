<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, MustVerifyEmailTrait;

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
    private function getConsistentColor()
    {
        $hash = md5($this->name ?? 'Guest');
        $color = substr($hash, 0, 6);

        return $color;
    }
    public function getPhotoAttribute($value)
    {
        if (!empty($value) && !is_null($value)) {
            return $value;
        }
        $randomColor = $this->getConsistentColor();
        $name = $this->name ?? 'Imam';

        return "https://api.dicebear.com/6.x/initials/svg?seed=" . urlencode($name) . "&backgroundColor=" . $randomColor;
    }

    public function getAccessibleRoutes()
    {
        $user = Auth::user();
        $routes = collect(Route::getRoutes());
        $userRoleCode = $user->Role->code ?? null;
        $accessibleRoutes = $routes->filter(function ($route) use ($user, $userRoleCode) {
            $routeName = $route->getName();
            $middleware = collect($route->gatherMiddleware())->filter(fn($m) => is_string($m));
            if ($middleware->contains("checkRole:$userRoleCode")) {
                return true;
            }
            return false;
        });
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
        if ($this->Admin && $this->is_active == true) {
            $codes = $this->Permissions
                ? $this->Permissions->pluck('Feature.code')
                : collect([]);

            if ($codes->contains('all_feature')) {
                return Feature::pluck('code');
            }
            return $codes;
        } else {
            return collect([]);
        }
    }
    public function Student()
    {
        return $this->hasOne(Student::class);
    }
    public function Musyrif()
    {
        return $this->hasOne(Musyrif::class);
    }
}
