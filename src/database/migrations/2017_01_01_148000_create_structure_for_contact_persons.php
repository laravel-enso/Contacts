<?php

use LaravelEnso\Core\app\Classes\StructureManager\StructureMigration;

class CreateStructureForContactPersons extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'administration.contactPersons', 'description' => 'Contact Persons Group',
    ];

    protected $permissions = [
        ['name' => 'administration.contactPersons.index', 'description' => 'Contact Persons index', 'type' => 0, 'default' => false],
        ['name' => 'administration.contactPersons.edit', 'description' => 'Edit Contact Person', 'type' => 0, 'default' => false],
        ['name' => 'administration.contactPersons.create', 'description' => 'Create Contact Person', 'type' => 0, 'default' => false],
        ['name' => 'administration.contactPersons.update', 'description' => 'Update Contact Person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contactPersons.store', 'description' => 'Store Contact Person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contactPersons.destroy', 'description' => 'Delete Contact Person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contactPersons.initTable', 'description' => 'Init Table for Contact Person', 'type' => 0, 'default' => false],
        ['name' => 'administration.contactPersons.getTableData', 'description' => 'Table Data for Contact Person', 'type' => 0, 'default' => false],
    ];

    protected $menu = [
        'name' => 'Contact Persons', 'icon' => 'fa fa-fw fa-address-book-o', 'link' => 'administration/contactPersons', 'has_children' => 0,
    ];

    protected $parentMenu = 'Administration';
}
