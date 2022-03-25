<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Invoices',
            'Invoices List',
            'Paid',
            'Unpaid',
            'Partly Paid',
            'Archived Invoices',

            'Reports',
            'Invoices Reports',
            'customers Reports',

            'Users',
            'Users List',
            'Users Roles',

            'Settings',
            'Departments',
            'Products',

            'Add Invoices',
            'Export Invoices',
            'Edit Invoice',
            'Delete Invoice',
            'Add Attachment',
            'Delete Attachment',
            'Show Status',

            'Add User',
            'Edit User',
            'Delete User',

            'show Role',
            'Add Role',
            'Edit Role',
            'Delete Role',

            'Add Product',
            'Edit Product',
            'Delete Product',

            'Add Department',
            'Edit Department',
            'Delete Department',

            'Notifications'





        ];
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
