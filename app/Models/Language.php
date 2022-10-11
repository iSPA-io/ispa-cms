<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language
 * About the Language Entity
 * @package App\Models
 * @author malayvuong
 * @since 7.0.0
 *
 * ==== Properties - Fields
 * @property integer id
 * @property string name
 * @property string code
 * @property string locale
 * @property string locale_alias
 * @property string flag
 * @property string currency
 * @property boolean default_web
 * @property boolean default_adm
 * @property boolean default_app
 * @property boolean for_web
 * @property boolean for_adm
 * @property boolean for_app
 * @property boolean is_locked
 * @property string status
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * === Relationships
 *
 */
class Language extends Model
{
    use HasFactory, SoftDeletes;

    /** @var string */
    public $table = Tables::LANGUAGES;

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
        'name', 'code', 'locale', 'locale_alias', 'flag', 'currency',
        'default_web', 'default_adm', 'default_app',
        'for_web', 'for_adm', 'for_app', 'is_locked', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'default_web' => 'boolean',
        'default_adm' => 'boolean',
        'default_app' => 'boolean',
        'for_web' => 'boolean',
        'for_adm' => 'boolean',
        'for_app' => 'boolean',
        'is_locked' => 'boolean',
    ];
}
