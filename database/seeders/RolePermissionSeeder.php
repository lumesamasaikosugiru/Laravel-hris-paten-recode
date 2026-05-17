<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)
            ->forgetCachedPermissions();

        // === ROLES ===
        $roles = [
            'super_admin' => 'Super Admin',
            'hr_admin' => 'HR Admin',
            'kepala_sekolah' => 'Kepala Sekolah',
            'employee' => 'Pegawai',
        ];

        foreach ($roles as $name => $label) {
            Role::firstOrCreate([
                'name' => $name,
                'guard_name' => 'web',
            ]);
        }

        // === PERMISSIONS ===
        // Format: resource.action
        $permissions = [
            // Master Data
            'master.view',
            'master.create',
            'master.edit',
            'master.delete',

            // Recruitment
            'recruitment.view',
            'recruitment.create',
            'recruitment.edit',
            'recruitment.delete',
            'recruitment.process',   // screening, interview, accept, reject

            // Employee
            'employee.view',
            'employee.create',
            'employee.edit',
            'employee.delete',
            'employee.view_own',     // pegawai lihat data sendiri

            // Attendance
            'attendance.view',
            'attendance.create',
            'attendance.edit',
            'attendance.view_own',

            // Leave
            'leave.view',
            'leave.create',
            'leave.approve',
            'leave.reject',
            'leave.view_own',
            'leave.request_own',

            // Report
            'report.view',
            'report.export',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // === ASSIGN PERMISSIONS KE ROLE ===

        // Super Admin: semua permission
        $superAdmin = Role::findByName('super_admin');
        $superAdmin->syncPermissions(Permission::all());

        // HR Admin: semua kecuali master delete
        $hrAdmin = Role::findByName('hr_admin');
        $hrAdmin->syncPermissions(
            Permission::whereNotIn('name', [
                'master.delete',
            ])->get()
        );

        // Kepala Sekolah: lihat semua + approve leave/attendance
        $kepalaSekolah = Role::findByName('kepala_sekolah');
        $kepalaSekolah->syncPermissions([
            'master.view',
            'employee.view',
            'attendance.view',
            'leave.view',
            'leave.approve',
            'leave.reject',
            'report.view',
            'report.export',
        ]);

        // Employee: hanya data sendiri
        $employee = Role::findByName('employee');
        $employee->syncPermissions([
            'employee.view_own',
            'attendance.view_own',
            'leave.view_own',
            'leave.request_own',
        ]);

        $this->command->info('Roles dan permissions berhasil dibuat.');
    }
}
