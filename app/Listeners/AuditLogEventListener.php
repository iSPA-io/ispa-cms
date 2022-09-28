<?php

namespace App\Listeners;

use App\Events\AuditLogEvent;
use App\Repositories\Interface\AuditLogInterface;

class AuditLogEventListener
{
    protected AuditLogInterface $model;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(AuditLogInterface $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the event.
     *
     * @param AuditLogEvent $event
     * @return void
     */
    public function handle(AuditLogEvent $event): void
    {
        $data = [
            'action' => $event->action,
            'old_value' => $event->old_value,
            'new_value' => $event->new_value,
            'target_type' => $event->model,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->fullUrl(),
            'options' => [
                'method' => request()->method(),
                'headers' => request()->headers->all(),
                'query' => request()->query(),
                'icon' => $event->icon ?? 'fa fa-history',
                'color' => $event->color ?? 'info',
            ]
        ];

        $inputs = request()->input();

        foreach ($inputs as $key => $value) {
            if (str($key)->contains(['password', 'token', 'pws', 'secret'])) {
                unset($inputs[$key]);
            }
        }

        $data['options']['input'] = $inputs;

        if ($event->model_id) {
            $data['target_id'] = $event->model_id;
        }

        if ($event->user_id > 0) {
            $data['user_id'] = $event->user_id;
        } else {
            $data['user_id'] = auth()->id();
        }

        $this->model->create($data);
    }
}
