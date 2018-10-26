<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use ReflectionClass;

/**
 * Trait RecordsActivity
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
trait RecordsActivity
{

    protected static function bootRecordsActivity()
    {
        foreach (static::getModelEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected static function getModelEvents()
    {
        if (isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return [
            'created',
            'deleted',
            'updated',
        ];
    }

    public function recordActivity($event)
    {
        Activity::create([
            'subject_id'   => $this->id,
            'subject_type' => get_class($this),
            'name'         => $this->getActivityName($this, $event),
            'user_id'      => isset(Auth::user()->id) ? Auth::user()->id : $this->user_id,
            'team_id'      => Auth::user()->getTeam()->id,
        ]);
    }

    protected function getActivityName($model, $action)
    {
        $name = strtolower((new ReflectionClass($model))->getShortName());

        return "{$action}_{$name}";
    }
}
