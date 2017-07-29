<?php

namespace LaravelEnso\ContactPersons\app\DataTable;

use LaravelEnso\Core\app\Enums\IsActiveEnum;
use LaravelEnso\DataTable\app\Classes\TableStructure;

class ContactPersonsTableStructure extends TableStructure
{
    public function __construct()
    {
        $this->data = [
            'crtNo'         => __('#'),
            'actionButtons' => __('Actions'),
            'headerAlign'   => 'center',
            'bodyAlign'     => 'center',
            'tableName'     => __('Contact Persons'),
            'enumMappings'  => [
                'is_active' => IsActiveEnum::class,
            ],
            'columns'       => [
                0 => [
                    'label' => __('First Name'),
                    'data'  => 'first_name',
                    'name'  => 'contact_persons.first_name',
                ],
                1 => [
                    'label' => __('Last Name'),
                    'data'  => 'last_name',
                    'name'  => 'contact_persons.last_name',
                ],
                2 => [
                    'label' => __('Owner'),
                    'data'  => 'owner_name',
                    'name'  => 'owners.name',
                ],
                3 => [
                    'label' => __('Phone'),
                    'data'  => 'phone',
                    'name'  => 'contact_persons.phone',
                ],
                4 => [
                    'label' => __('Email'),
                    'data'  => 'email',
                    'name'  => 'contact_persons.email',
                ],
                5 => [
                    'label' => __('Active'),
                    'data'  => 'is_active',
                    'name'  => 'contact_persons.is_active',
                ],
            ],
        ];
    }
}
