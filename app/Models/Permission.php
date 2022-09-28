<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permission
 * About the Permission Entity
 * @package App\Models
 * @author malayvuong
 * @since 7.0.0
 *
 * ==== Properties - Fields
 * @property integer id
 * @property string group
 * @property string name
 * @property string title
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * === Relationships
 *
 */
class Permission extends Model
{
    use HasFactory, SoftDeletes;

    /** @var string */
    public $table = Tables::PERMISSIONS;

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
        'group', 'name', 'title'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
