<?php

namespace LaravelEnso\Contacts\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Helpers\app\Traits\IsActive;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;

class Contact extends Model
{
    use IsActive, CreatedBy;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'obs', 'is_active'];

    protected $attributes = ['is_active' => false];

    protected $casts = ['is_active' => 'boolean'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('enso.contacts.table') ?: 'contacts';
    }

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'created_by', 'id');
    }

    public function contactable()
    {
        return $this->morphTo();
    }
}
