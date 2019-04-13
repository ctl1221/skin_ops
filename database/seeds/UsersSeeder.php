<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_user = User::create([
            'name' => 'Administrator Licup',
            'email' => 'admin@laravel',
            'password' => Hash::make('admin'),
            ]);

        $sales_role_id = Role::create([
            'name' => 'Sales',
            'slug' => 'sales',
            'description' => 'Sales Access',
            'system' => 0
        ]);

        $management_role_id = Role::create([
            'name' => 'Management',
            'slug' => 'management',
            'description' => 'Management Access',
            'system' => 0
        ]);

        $admin_role_id = Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'description' => 'Admin Access',
            'system' => 0
        ]);

        $admin_user->roles()->attach($sales_role_id);
        $admin_user->roles()->attach($management_role_id);
        $admin_user->roles()->attach($admin_role_id);
    }
}
