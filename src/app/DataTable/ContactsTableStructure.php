<?php

namespace LaravelEnso\Contacts\app\DataTable;

use LaravelEnso\DataTable\app\Classes\TableStructure;

class ContactsTableStructure extends TableStructure
{
    public function __construct()
    {
        $this->data = [
            'tableName'           => __('Contacts'),
            'crtNo'               => __('#'),
            'actionButtons'       => __('Actions'),
            'customActionButtons' => [
                ['class' => 'btn-warning fa fa-pencil-square-o', 'event' => 'edit-contact', 'route' => 'core.contacts.update'],
            ],
            'headerAlign'         => 'center',
            'bodyAlign'           => 'center',
            'boolean'             => [5],
            'columns'             => [
                0 => [
                    'label' => __('First Name'),
                    'data'  => 'first_name',
                    'name'  => 'contacts.first_name',
                ],
                1 => [
                    'label' => __('Last Name'),
                    'data'  => 'last_name',
                    'name'  => 'contacts.last_name',
                ],
                2 => [
                    'label' => __('Phone'),
                    'data'  => 'phone',
                    'name'  => 'contacts.phone',
                ],
                3 => [
                    'label' => __('Email'),
                    'data'  => 'email',
                    'name'  => 'contacts.email',
                ],
                4 => [
                    'label' => __('Observations'),
                    'data'  => 'obs',
                    'name'  => 'contacts.obs',
                ],
                5 => [
                    'label' => __('Active'),
                    'data'  => 'is_active',
                    'name'  => 'contacts.is_active',
                ],
            ],
        ];
    }
}
