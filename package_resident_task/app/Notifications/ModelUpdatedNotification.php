<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ModelUpdatedNotification extends Notification
{
    protected $model;
    protected $event;

    public function __construct($model, $event)
    {
        $this->model = $model;
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $type = class_basename($this->model);
        $name = $this->getModelName();

        return [
            'type' => $type,
            'id' => $this->model->id,
            'event' => $this->event,
            'message' => "{$type} \"{$name}\" was {$this->event}.",
        ];
    }

    private function getModelName()
    {
        // Customize based on your models’ attributes
        if ($this->model instanceof \App\Models\Package) {
            return $this->model->package_name ?? "Unnamed Package";
        }

        if ($this->model instanceof \App\Models\Resident) {
            return $this->model->resident_name ?? "Unnamed Resident";
        }

        return 'Item';
    }
}
