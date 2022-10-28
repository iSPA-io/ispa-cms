<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EnumerateType
 * About the EnumerateType Entity
 * @package App\Models
 * @author malayvuong
 * @since 7.0.0
 *
 * ==== Properties - Fields
 * @property integer id
 * @property string name
 * @property string key_name
 * @property string created_at
 * @property string updated_at
 *
 * === Relationships
 *
 */
class EnumerateType extends Model
{
    use HasFactory;

    /** @var string */
    public $table = Tables::ENUMERATES_TYPE;

    /** @var string[] */
    protected $dates = [
        'created_at', 'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'key_name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
