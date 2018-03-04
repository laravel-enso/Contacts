<?php

namespace LaravelEnso\Contacts\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Helpers\app\Traits\IsActive;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\Contacts\app\Handlers\ConfigMapper;

class Contact extends Model
{
    use IsActive, CreatedBy;

    protected $fillable = [
        'contactable_id', 'contactable_type', 'first_name', 'last_name',
        'phone', 'email', 'obs', 'is_active',
    ];

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

    public function store(array $attributes, array $params)
    {
        $this->create(
            $attributes + [
                'contactable_id' => $params['id'],
                'contactable_type' => (new ConfigMapper($params['type']))->class(),
            ]
        );
    }
}
