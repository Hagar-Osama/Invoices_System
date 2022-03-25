<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'name' => 'AL-Bank EL-ahly',
                'description' => 'hhghjgh',
                'created_by' => 'owner'
            ],
            [
                'name' => 'CIB',
                'description' => 'hhghjgh',
                'created_by' => 'owner'
            ],

        ];
        foreach ($departments as $department) {
            Department::create([
                'name' => $department['name'],
                'description' => $department['description'],
                'created_by' => $department['created_by']
            ]);
        }
    }
}
