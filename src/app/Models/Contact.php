<?php

namespace LaravelEnso\Contacts\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Helpers\app\Traits\ActiveState;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;

class Contact extends Model
{
    use ActiveState, LogsActivity;

    protected $fillable = [
        'contactable_id', 'contactable_type', 'first_name', 'last_name',
        'phone', 'email', 'position', 'obs', 'is_active',
    ];

    protected $attributes = ['is_active' => false];

    protected $casts = ['is_active' => 'boolean'];

    protected $loggableLabel = 'fullName';

    protected $loggable = [
        'first_name', 'last_name', 'phone', 'email', 'position', 'is_active' => 'active state',
    ];

    public function contactable()
    {
        return $this->morphTo();
    }

    public function getFullNameAttribute()
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    public function scopeFor($query, array $params)
    {
        $query->whereContactableId($params['contactable_id'])
            ->whereContactableType($params['contactable_type']);
    }

    public function scopeOrdered($query)
    {
        $query->orderBy('created_at', 'desc');
    }

    public function getLoggableMorph()
    {
        return config('enso.contacts.loggableMorph');
    }
}
