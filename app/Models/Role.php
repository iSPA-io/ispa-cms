<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Role
 * About the Role Entity
 * @package App\Models
 * @author malayvuong
 * @since 7.0.0
 *
 * ==== Properties - Fields
 * @property integer id
 * @property string name
 * @property string custom
 * @property integer user_id
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * === Relationships
 * @property BelongsToMany permissions
 * @property User user
 *
 */
class Role extends Model
{
    use HasFactory, SoftDeletes;

    /** @var string */
    public $table = Tables::ROLES;

    /** @var string[] */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'custom', 'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'custom' => 'array',
        'user_id' => 'integer',
    ];

    /**
     * Permissions relationship
     *
     * @return BelongsToMany
     * @author malayvuong
     * @since 7.0.0 - 2022-09-29, 00:16 ICT
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, Tables::ROLE_PERMISSION, 'role_id', 'permission_id');
    }

    /**
     * Users relationship
     *
     * @author malayvuong
     * @since 7.0.0 - 2022-09-29, 00:18 ICT
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, Tables::USER_ROLE, 'role_id', 'user_id');
    }
}
