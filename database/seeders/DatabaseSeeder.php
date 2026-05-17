<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan WAJIB dipatuhi karena ada foreign key dependency
        $this->call([
                // 1. Auth & Roles (tidak ada dependency)
            RolePermissionSeeder::class,

                // 2. Master Data (urutan penting)
            EducationLevelSeeder::class,
            EmployeeCategorySeeder::class,
            LeaveTypeSeeder::class,
            SchoolSeeder::class,

                // 3. User default
            SuperAdminSeeder::class,
        ]);

        // Demo data HANYA untuk environment local/development
        if (app()->environment(['local', 'development'])) {
            $this->call(DemoSeeder::class);
        }
    }
}
