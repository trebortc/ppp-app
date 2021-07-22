<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'lastname',
        'email',
        'password',
        'phone',
        'mobile',
        'sex',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            switch ($user->userable_type) {
                case 'App\Teacher':
                    $user->role = self::ROLE_TEACHER;
                    break;
                case 'App\Student':
                    $user->role = self::ROLE_STUDENT;
                    break;
                case 'App\Representative':
                    $user->role = self::ROLE_REPRESENTATIVE;
                    break;
                case 'App\Administrative':
                    $user->role = self::ROLE_ADMINISTRATIVE;
                    break;
                default:
                    abort(422);
            }
        });
    }

    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    const ROLE_ADMINISTRATIVE = 'ROLE_ADMINISTRATIVE';
    const ROLE_COMMISSION = 'ROLE_COMMISSION';
    const ROLE_TEACHER = 'ROLE_TEACHER';
    const ROLE_STUDENT = 'ROLE_STUDENT';
    const ROLE_REPRESENTATIVE = 'ROLE_REPRESENTATIVE';

    private const ROLES_HIERARCHY = [
        self::ROLE_SUPERADMIN => [
            self::ROLE_ADMINISTRATIVE,
            self::ROLE_COMMISSION,
            self::ROLE_TEACHER,
            self::ROLE_STUDENT,
            self::ROLE_REPRESENTATIVE
        ],
        self::ROLE_ADMINISTRATIVE => [],
        self::ROLE_COMMISSION => [self::ROLE_TEACHER],
        self::ROLE_TEACHER => [],
        self::ROLE_STUDENT => [],
        self::ROLE_REPRESENTATIVE => [],
    ];

    public function userable()
    {
        return $this->morphTo();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isGranted($role)
    {
        if ($role === $this->role) {
            return true;
        }
        return self::isRoleInHierarchy($role, self::ROLES_HIERARCHY[$this->role]);
    }

    private static function isRoleInHierarchy($role, $role_hierarchy)
    {
        if (in_array($role, $role_hierarchy)) {
            return true;
        }
        foreach ($role_hierarchy as $role_included) {
            if (self::isRoleInHierarchy($role, self::ROLES_HIERARCHY[$role_included])) {
                return true;
            }
        }
        return false;
    }
}
