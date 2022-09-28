<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AuditLog
 * About the AuditLog Entity
 * @package App\Models
 * @author malayvuong
 * @since 7.0.0
 *
 * ==== Properties - Fields
 * @property integer id
 * @property string action
 * @property string old_value
 * @property string new_value
 * @property string target_type
 * @property int target_id
 * @property string ip_address
 * @property string user_agent
 * @property string url
 * @property string options
 * @property int user_id
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * === Relationships
 *
 */
class AuditLog extends Model
{
    use HasFactory, SoftDeletes;

    /** @var string */
    public $table = Tables::AUDIT_LOGS;

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
        'action', 'old_value', 'new_value', 'target_type', 'target_id',
        'ip_address', 'user_agent', 'url', 'options', 'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'old_value' => 'array',
        'new_value' => 'array',
        'options' => 'array',
        'target_id' => 'integer',
        'user_id' => 'integer',
    ];
}
