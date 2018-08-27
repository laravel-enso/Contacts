<?php

namespace LaravelEnso\Contacts\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Helpers\app\Traits\IsActive;
use LaravelEnso\Contacts\app\Classes\ConfigMapper;
use LaravelEnso\ActivityLog\app\Traits\LogActivity;

class Contact extends Model
{
    use IsActive, LogActivity;

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

    public function store(array $attributes, array $params)
    {
        $this->create(
            $attributes + [
                'contactable_id' => $params['contactable_id'],
                'contactable_type' => (new ConfigMapper($params['contactable_type']))
                    ->class(),
            ]
        );
    }

    public function scopeFor($query, array $request)
    {
        $query->whereContactableId($request['contactable_id'])
            ->whereContactableType(
                (new ConfigMapper($request['contactable_type']))
                    ->class()
            );
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
