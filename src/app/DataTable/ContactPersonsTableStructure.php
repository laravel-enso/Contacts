<?php

namespace LaravelEnso\ContactPersons\app\DataTable;

use LaravelEnso\DataTable\app\Classes\Abstracts\TableStructure;

class ContactPersonsTableStructure extends TableStructure
{
    public function __construct()
    {
        $this->data = [

            'crtNo'         => __('#'),
            'actionButtons' => __('Actions'),
            'headerAlign'   => 'center',
            'bodyAlign'     => 'center',
            'tableClass'    => 'table display',
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
            ],
        ];
    }
}
