<?php

namespace LaravelEnso\ContactPersons\app\DataTable;


use LaravelEnso\DataTable\app\Classes\Abstracts\TableStructure;


class ContactPersonsTableStructure extends TableStructure {

    public function __construct() {

        $this->data = [

            'crtNo'         => __('#'),
            'actionButtons' => __('Actions'),
            'headerAlign'   => 'center',
            'bodyAlign'     => 'center',
            'dom'           => '<"pull-right"l><"pull-left"f>rtip',
            'tableClass'    => 'table display',
            'columns'       => [

                0 => [
                    'label' => __('Name'),
                    'data'  => 'name',
                    'name'  => 'contact_persons.name',
                ],
                1 => [
                    'label' => __('Owner'),
                    'data'  => 'owner_name',
                    'name'  => 'owners.name',
                ],
                2 => [
                    'label' => __('Phone'),
                    'data'  => 'telephone',
                    'name'  => 'contact_persons.telephone',
                ],
                3 => [
                    'label' => __('Email'),
                    'data'  => 'email',
                    'name'  => 'contact_persons.email',
                ],
            ],
        ];
    }
}