<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Member\Member;
use App\Models\System\SystemAdmin;
use App\Models\Trait\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int id
 * @property string username
 * @property string email
 * @property string email_verified_at
 * @property string password
 * @property string remember_token
 * @property int user_type
 * @property int login_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property SystemAdmin admin
 * @property Member member
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SearchTrait;

    const USER_TYPE_MEMBER = 1;

    const USER_TYPE_PLATFORM_MANAGER = 100;

    const USER_TYPE_PLATFORM_SUPER_ADMIN = 999;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function admin()
    {
        return $this->hasOne(SystemAdmin::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class, 'created_by', 'id');
    }

    /**
     * @param $password
     * @return bool
     */
    public function resetPassword($password)
    {
        $this->password = bcrypt($password);
        return $this->save();
    }

    /**
     * @param $param
     * @param $role_type
     * @return bool
     */
    public function register($param, $role_type)
    {
        $param['email'] = "{$param['username']}@platform.com";
        $param['password'] = bcrypt($param['password']);
        $param['user_type'] = $role_type;
        return $this->fill($param)->save();
    }

    /**
     * @param $param
     * @return bool
     */
    public function registerManager($param)
    {
        return $this->register($param, self::USER_TYPE_PLATFORM_MANAGER);
    }

    /**
     * @param $param
     * @return bool
     */
    public function registerMember($param)
    {
        return $this->register($param, self::USER_TYPE_MEMBER);
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return self::USER_TYPE_PLATFORM_SUPER_ADMIN === $this->user_type;
    }

    /**
     * @param $param
     * @param $with
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->username)) {
            $build = $build->where('username', 'like', "%{$this->username}%");
        }
        if (!empty($this->email)) {
            $build = $build->where('email', 'like', "%{$this->email}%");
        }
        if (isset($this->user_type)) {
            $build = $build->where('user_type', $this->user_type);
        }
        return $build->with($with);
    }
}
