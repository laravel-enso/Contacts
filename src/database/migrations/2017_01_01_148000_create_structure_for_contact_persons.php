<?php

use LaravelEnso\StructureManager\app\Classes\StructureMigration;

class CreateStructureForContactPersons extends StructureMigration
{
    protected $permissionGroup = [
        'name' => 'administration.contactPersons', 'description' => 'Contact persons group',
    ];

    protected $permissions = [
        ['name' => 'administration.contactPersons.index', 'description' => 'Contact persons index', 'type' => 0, 'default' => false],
        ['name' => 'administration.contactPersons.edit', 'description' => 'Edit contact person', 'type' => 0, 'default' => false],
        ['name' => 'administration.contactPersons.create', 'description' => 'Create contact person', 'type' => 0, 'default' => false],
        ['name' => 'administration.contactPersons.update', 'description' => 'Update edited contact person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contactPersons.store', 'description' => 'Store newly created contact person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contactPersons.destroy', 'description' => 'Delete contact person', 'type' => 1, 'default' => false],
        ['name' => 'administration.contactPersons.initTable', 'description' => 'Init table for contact persons', 'type' => 0, 'default' => false],
        ['name' => 'administration.contactPersons.getTableData', 'description' => 'Get table data for contact persons', 'type' => 0, 'default' => false],
    ];

    protected $menu = [
        'name' => 'Contact Persons', 'icon' => 'fa fa-fw fa-address-book-o', 'link' => 'administration/contactPersons', 'has_children' => false,
    ];

    protected $parentMenu = 'Administration';
}
