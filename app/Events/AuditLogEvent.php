<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuditLogEvent
{
    use Dispatchable, SerializesModels;

    /** @var string $action */
    public string $action;

    /** @var array $old_value */
    public array $old_value;

    /** @var array $new_value */
    public array $new_value;

    /** @var null|string $model */
    public ?string $model = null;

    /** @var int $model_id */
    public int $model_id;

    /** @var int $user_id */
    public int $user_id;

    /** @var null|string $icon */
    public ?string $icon;

    /** @var null|string $color */
    public ?string $color;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        string $action, string $icon = null, string $color = null, string $model = null, int $model_id = 0,
        array $old_value = [], array $new_value = [], int $user_id = 0
    )
    {
        $this->action = $action;
        $this->old_value = $old_value;
        $this->new_value = $new_value;
        $this->model = $model;
        $this->model_id = $model_id;
        $this->user_id = $user_id;
        $this->icon = $icon;
        $this->color = $color;
    }
}
