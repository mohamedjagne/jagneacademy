<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'id' => 1,
                'type' => 'Admin'
            ],
            [
                'id' => 2,
                'type' => 'User'
            ],
            [
                'id' => 3,
                'type' => 'Student'
            ],
            [
                'id' => 4,
                'type' => 'Instructor'
            ]
        ]);
    }
}
