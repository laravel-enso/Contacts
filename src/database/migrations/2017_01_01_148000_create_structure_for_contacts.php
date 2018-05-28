<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForContacts extends StructureMigration
{
    protected $permissions = [
        ['name' => 'core.contacts.index', 'description' => 'Contacts index', 'type' => 0, 'is_default' => false],
        ['name' => 'core.contacts.create', 'description' => 'Get create form  for contacts', 'type' => 0, 'is_default' => false],
        ['name' => 'core.contacts.edit', 'description' => 'Get edit form for contacts', 'type' => 0, 'is_default' => false],
        ['name' => 'core.contacts.update', 'description' => 'Update edited contact', 'type' => 1, 'is_default' => false],
        ['name' => 'core.contacts.store', 'description' => 'Store newly created contact', 'type' => 1, 'is_default' => false],
        ['name' => 'core.contacts.destroy', 'description' => 'Delete contact', 'type' => 1, 'is_default' => false],
        ['name' => 'core.contacts.initTable', 'description' => 'Init table for contacts', 'type' => 0, 'is_default' => false],
        ['name' => 'core.contacts.getTableData', 'description' => 'Get table data for contacts', 'type' => 0, 'is_default' => false],
        ['name' => 'core.contacts.exportExcel', 'description' => 'Export excel for contacts', 'type' => 0, 'is_default' => false],
    ];

    protected $permissionGroup = [
        'name' => 'core.contacts', 'description' => 'Contacts group',
    ];

    protected $menu = [
        'name' => 'Contacts', 'icon' => 'address-book', 'link' => 'core.contacts.index', 'order_index' => 999, 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}
