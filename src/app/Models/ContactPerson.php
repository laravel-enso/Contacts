<?php

namespace LaravelEnso\ContactPersons\app\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $table = 'contact_persons';
    protected $fillable = ['owner_id', 'name', 'telephone', 'email'];

    public function owner()
    {
        return $this->belongsTo('App\Owner');
    }
}
