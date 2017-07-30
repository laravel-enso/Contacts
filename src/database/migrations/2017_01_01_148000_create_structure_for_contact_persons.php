<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForContacts extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'administration.contacts', 'description' => 'Contact persons group',
    ];

    protected $permissions = [
        ['name' => 'administration.contacts.index', 'description' => 'Contact persons index', 'type' => 0, 'default' => false],
        ['name' => 'administration.contacts.edit', 'description' => 'Edit contact person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contacts.create', 'description' => 'Create contact person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contacts.update', 'description' => 'Update edited contact person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contacts.store', 'description' => 'Store newly created contact person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contacts.destroy', 'description' => 'Delete contact person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contacts.initTable', 'description' => 'Init table for contact persons', 'type' => 0, 'default' => false],
        ['name' => 'administration.contacts.getTableData', 'description' => 'Get table data for contact persons', 'type' => 0, 'default' => false],
        ['name' => 'administration.contacts.exportExcel', 'description' => 'Export excel for contact persons', 'type' => 0, 'default' => false],
    ];

    protected $menu = [
        'name' => 'Contact Persons', 'icon' => 'fa fa-fw fa-address-book-o', 'link' => 'administration/contacts', 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}
