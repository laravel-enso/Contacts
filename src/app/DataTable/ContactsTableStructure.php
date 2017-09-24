<?php

namespace LaravelEnso\Contacts\app\DataTable;

use LaravelEnso\DataTable\app\Classes\TableStructure;

class ContactsTableStructure extends TableStructure
{
    public function __construct()
    {
        $this->data = [
            'name'                => __('Contacts'),
            'icon'                => 'fa fa-address-book-o',
            'crtNo'               => __('#'),
            'actions'             => __('Actions'),
            'actionButtons'       => ['destroy'],
            'customActionButtons' => [
                ['icon' => 'fa fa-pencil-square-o', 'class' => 'is-warning', 'event' => 'edit-contact', 'route' => 'core.contacts.update'],
            ],
            'headerButtons'       => ['exportExcel'],
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
