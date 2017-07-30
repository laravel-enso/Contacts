<?php

namespace LaravelEnso\Contacts\app\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact_persons'; //fixme => contacts

    protected $fillable = ['owner_id', 'first_name', 'last_name', 'phone', 'email', 'is_active'];

    protected $attribute = ['is_active' => false];

    public function owner()
    {
        return $this->belongsTo('LaravelEnso\Core\app\Models\Owner');
    }

    public function scopeActive($query)
    {
        return $query->whereIsActive(true);
    }
}
