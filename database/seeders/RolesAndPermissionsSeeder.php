<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleStudent = Role::create(['name' => 'student']);
        $roleTeacher = Role::create(['name' => 'teacher']);

        $studentsPermission = Permission::create(['name' => 'students_permissions']);
        $teachersPermission = Permission::create(['name' => 'teachers_permissions']);

        $roleStudent->givePermissionTo($studentsPermission);
        $roleTeacher->givePermissionTo($teachersPermission);
    }
}
