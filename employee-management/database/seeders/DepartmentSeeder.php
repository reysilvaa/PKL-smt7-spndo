<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Accounting'],
            ['name' => 'Business Development'],
            ['name' => 'Engineering'],
            ['name' => 'Human Resources'],
            ['name' => 'Legal'],
            ['name' => 'Marketing'],
            ['name' => 'Product Management'],
            ['name' => 'Sales'],
            ['name' => 'Training'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
