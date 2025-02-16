<?php

namespace Database\Seeders;

use App\Enums\RoleTypeEnum;
use App\Helpers\Enum;
use Exception;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = collect(Enum::make(RoleTypeEnum::class)->values())->map(function ($role, $key) {
            try {
                $createRole = Role::create([
                    'name' => $role,
                    'guard_name' => 'dashboard',
                ]);

                if ($createRole->name === RoleTypeEnum::SUPER_ADMIN->value) {
                    $createRole->syncPermissions(Permission::all());
                }

                if ($createRole->name === RoleTypeEnum::MANAGER->value) {
                    $createRole->syncPermissions([2, 3, 4]);
                }

            } catch (Exception $e) {
                throw ($e);
            }
        });
    }
}