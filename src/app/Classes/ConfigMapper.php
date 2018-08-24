<?php

namespace LaravelEnso\Contacts\app\Classes;

use LaravelEnso\Helpers\app\Classes\MorphableConfigMapper;

class ConfigMapper extends MorphableConfigMapper
{
    protected $configPrefix = 'enso.contacts';
    protected $morphableKey = 'contactables';
}
