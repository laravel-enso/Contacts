<?php

namespace LaravelEnso\Contacts\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Helpers\Traits\IsActiveTrait;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;

class Contact extends Model
{
    use IsActiveTrait, CreatedBy;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'obs', 'is_active'];

    protected $attributes = ['is_active' => false];

    protected $casts = ['is_active' => 'boolean'];

    public function contactable()
    {
        return $this->morphTo();
    }
}
