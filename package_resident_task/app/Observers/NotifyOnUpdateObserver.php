<?php
namespace App\Observers;

use App\Notifications\ModelUpdatedNotification;
use Illuminate\Database\Eloquent\Model;

class NotifyOnUpdateObserver
{
    protected array $notifiableModels = [
        \App\Models\Package::class,
        \App\Models\Resident::class,
    ];

    public function created(Model $model)
    {
        $this->notify($model, 'created');
    }

    public function updated(Model $model)
    {
        $this->notify($model, 'updated');
    }

    public function deleted(Model $model)
    {
        $this->notify($model, 'deleted');
    }

    private function notify(Model $model, string $event)
    {
        if (!in_array(get_class($model), $this->notifiableModels)) {
            return;
        }

        $user = $model->user ?? auth()->user(); // Make sure this resolves to the correct user
        if ($user) {
            $user->notify(new ModelUpdatedNotification($model, $event));
        }
    }
}
