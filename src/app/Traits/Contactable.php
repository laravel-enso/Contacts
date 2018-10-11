<?php

namespace LaravelEnso\Contacts\app\Traits;

use LaravelEnso\Contacts\app\Models\Contact;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

trait Contactable
{
    public static function bootContactable()
    {
        self::deleting(function ($model) {
            if (config('enso.contacts.onDelete') === 'restrict'
                && $model->contacts()->first() !== null) {
                throw new ConflictHttpException(
                    __('The entity has contacts and cannot be deleted')
                );
            }
        });

        self::deleted(function ($model) {
            if (config('enso.contacts.onDelete') === 'cascade') {
                $model->contacts()->delete();
            }
        });
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
