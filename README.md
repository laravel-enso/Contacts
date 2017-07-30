<!--h-->
# Contact Persons

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/7c859dad259f4455a21c7f22d2877917)](https://www.codacy.com/app/mihai-ocneanu/contact-persons?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/contact-persons&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/88868747/shield?branch=master)](https://styleci.io/repos/88868747)
[![License](https://poser.pugx.org/laravel-enso/contacts/license)](https://https://packagist.org/packages/laravel-enso/contacts)
[![Total Downloads](https://poser.pugx.org/laravel-enso/contacts/downloads)](https://packagist.org/packages/laravel-enso/contacts)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/contacts/version)](https://packagist.org/packages/laravel-enso/contacts)
<!--/h-->

Contact Persons dependency for [Laravel Enso](https://github.com/laravel-enso/Enso).

[![Screenshot](https://laravel-enso.github.io/contacts/screenshots/Selection_024_thumb.png)](https://laravel-enso.github.io/contacts/screenshots/Selection_024.png)

### Installation steps

1. Add `LaravelEnso\Contacts\ContactsServiceProvider::class` to `config/app.php`.

2. Run the migrations.

3. Add the following relationship to the Owner model

    ```php
    public function contact_persons()
    {
        return $this->hasMany('LaravelEnso\Contacts\app\Models\ContactPerson');
    }
    ```


<!--h-->
### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
<!--/h-->