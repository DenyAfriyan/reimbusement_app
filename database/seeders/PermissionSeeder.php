<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'masterdata']);
        Permission::create(['name' => 'request reimbursement']);
        Permission::create(['name' => 'approval reimbursement']);
        Permission::create(['name' => 'report']);
        Permission::create(['name' => 'user management']);

         //create roles and assign existing permissions
         $user_role = Role::create(['name' => 'user']);
         $user_role->givePermissionTo('dashboard');
         $user_role->givePermissionTo('request reimbursement');
         $user_role->givePermissionTo('report');
 
         $admin_role = Role::create(['name' => 'admin']);
         $admin_role->givePermissionTo('dashboard');
         $admin_role->givePermissionTo('masterdata');
         $admin_role->givePermissionTo('approval reimbursement');
         $admin_role->givePermissionTo('report');
 
         $superadminRole = Role::create(['name' => 'super-admin']);
         // gets all permissions via Gate::before rule
   

        $user = User::factory()->create([
            'name' => 'Admin',
            'departement_id' => 0,
            'jabatan_id' => 0,
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('123')
        ]);
        $user->assignRole($admin_role);

        $user = User::factory()->create([
            'name' => 'Super Admin',
            'departement_id' => 0,
            'jabatan_id' => 0,
            'email' => 'superadmin@test.com',
            'password' => bcrypt('123')
        ]);
        $user->assignRole($superadminRole);

    }
}
