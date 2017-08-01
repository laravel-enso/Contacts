<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForContacts extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'core.contacts', 'description' => 'Contacts group',
    ];

    protected $permissions = [
        ['name' => 'core.contacts.index', 'description' => 'Contacts for contactable', 'type' => 0, 'default' => false],
        ['name' => 'core.contacts.update', 'description' => 'Update edited contact', 'type' => 1, 'default' => false],
        ['name' => 'core.contacts.store', 'description' => 'Store newly created contact', 'type' => 1, 'default' => false],
        ['name' => 'core.contacts.destroy', 'description' => 'Delete contact', 'type' => 1, 'default' => false],
        ['name' => 'core.contacts.list', 'description' => 'Show all contacts', 'type' => 1, 'default' => false],
        ['name' => 'core.contacts.initTable', 'description' => 'Init table for contacts', 'type' => 0, 'default' => false],
        ['name' => 'core.contacts.getTableData', 'description' => 'Get table data for contacts', 'type' => 0, 'default' => false],
        ['name' => 'core.contacts.exportExcel', 'description' => 'Export excel for contacts', 'type' => 0, 'default' => false],
    ];

    protected $menu = [
        'name' => 'Contacts', 'icon' => 'fa fa-fw fa-address-book-o', 'link' => 'core/contacts/list', 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}
