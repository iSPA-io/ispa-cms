<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * About the User Entity
 * @package App\Models
 * @author malayvuong
 * @since 7.0.0
 *
 * ==== Properties - Fields
 * @property integer id
 * @property string uuid
 * @property string username
 * @property string name
 * @property string email
 * @property string email_verified_at
 * @property string password
 * @property string remember_token
 * @property integer type
 * @property integer level
 * @property integer parent_id
 * @property string status
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * === Relationships
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** @var string */
    public $table = Tables::USERS;

    /** @var string[] */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'email_verified_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', 'name', 'email', 'password',
        'type', 'level', 'parent_id', 'status',
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
        'type' => 'integer',
        'level' => 'integer',
        'parent_id' => 'integer',
    ];

    /**
     * Roles relationship
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-29, 00:26 ICT
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, Tables::USER_ROLE, 'user_id', 'role_id');
    }
}
