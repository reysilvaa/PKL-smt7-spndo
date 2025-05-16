<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'firstname' => 'Marcel',
                'lastname' => 'Sturm',
                'gender' => 'male',
                'address' => 'Room 198',
                'dob' => '2000-02-19',
                'dept_id' => 4, // Human Resources
                'status' => 'emp',
            ],
            [
                'firstname' => 'Conney',
                'lastname' => 'Matysik',
                'gender' => 'male',
                'address' => 'PO Box 75969',
                'dob' => '1992-08-02',
                'dept_id' => 8, // Sales
                'status' => 'cont',
            ],
            [
                'firstname' => 'Kelci',
                'lastname' => 'Martinson',
                'gender' => 'female',
                'address' => 'Suite 32',
                'dob' => '1995-05-22',
                'dept_id' => 8, // Sales
                'status' => 'cont',
            ],
            [
                'firstname' => 'Rodina',
                'lastname' => 'Stanistreet',
                'gender' => 'female',
                'address' => 'PO Box 98249',
                'dob' => '1990-04-06',
                'dept_id' => 5, // Legal
                'status' => 'not_act',
            ],
            [
                'firstname' => 'Aloisia',
                'lastname' => 'Kedie',
                'gender' => 'female',
                'address' => 'PO Box 25525',
                'dob' => '1993-05-14',
                'dept_id' => 4, // Human Resources
                'status' => 'cont',
            ],
            [
                'firstname' => 'Thomasa',
                'lastname' => 'Lutz',
                'gender' => 'female',
                'address' => 'Room 1423',
                'dob' => '1993-09-14',
                'dept_id' => 2, // Business Development
                'status' => 'emp',
            ],
            [
                'firstname' => 'Carlen',
                'lastname' => 'Pinfold',
                'gender' => 'female',
                'address' => 'Room 1988',
                'dob' => '1993-02-22',
                'dept_id' => 2, // Business Development
                'status' => 'emp',
            ],
            [
                'firstname' => 'Andonis',
                'lastname' => 'Cellone',
                'gender' => 'male',
                'address' => 'Room 138',
                'dob' => '1994-01-26',
                'dept_id' => 8, // Sales
                'status' => 'cont',
            ],
            [
                'firstname' => 'Tonie',
                'lastname' => 'Hurling',
                'gender' => 'female',
                'address' => '1st Floor',
                'dob' => '1993-11-25',
                'dept_id' => 7, // Product Management
                'status' => 'emp',
            ],
            [
                'firstname' => 'Ashia',
                'lastname' => 'Danser',
                'gender' => 'female',
                'address' => 'Suite 74',
                'dob' => '1993-05-31',
                'dept_id' => 3, // Engineering
                'status' => 'cont',
            ],
            [
                'firstname' => 'Torrey',
                'lastname' => 'Saltern',
                'gender' => 'male',
                'address' => '9th Floor',
                'dob' => '1993-09-01',
                'dept_id' => 9, // Training
                'status' => 'emp',
            ],
            [
                'firstname' => 'Aggi',
                'lastname' => "O'Meara",
                'gender' => 'female',
                'address' => 'Suite 62',
                'dob' => '1993-12-19',
                'dept_id' => 5, // Legal
                'status' => 'cont',
            ],
            [
                'firstname' => 'Leupold',
                'lastname' => 'Somerton',
                'gender' => 'male',
                'address' => 'PO Box 29254',
                'dob' => '1993-06-08',
                'dept_id' => 6, // Marketing
                'status' => 'cont',
            ],
            [
                'firstname' => 'Donall',
                'lastname' => 'Pavelin',
                'gender' => 'male',
                'address' => 'Apt 1864',
                'dob' => '1993-06-10',
                'dept_id' => 8, // Sales
                'status' => 'emp',
            ],
            [
                'firstname' => 'Britt',
                'lastname' => 'Ault',
                'gender' => 'male',
                'address' => 'Room 609',
                'dob' => '1993-08-15',
                'dept_id' => 9, // Training
                'status' => 'cont',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
} 