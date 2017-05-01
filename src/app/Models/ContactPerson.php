<?php

namespace LaravelEnso\ContactPersons\app\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $table = 'contact_persons';
    protected $fillable = ['owner_id', 'first_name', 'last_name', 'phone', 'email'];

    public function owner()
    {
        return $this->belongsTo('LaravelEnso\Core\app\Models\Owner');
    }
}
