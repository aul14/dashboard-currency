<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // Role::truncate();
        // User::truncate();
        // Module::truncate();
        // Permission::truncate();

        // PROFILE
        $moduleProfile = Module::create([
            'name'      => 'Module Profile'
        ]);


        $permissionModuleProfile = [
            [
                'name' => 'manage-profile',
                'display_name' => 'Manage Profile',
                'description' => 'Can Manage Profile'
            ],
            [
                'name' => 'edit-profile',
                'display_name' => 'Edit Profile',
                'description' => 'Can Edit Profile'
            ]
        ];

        foreach ($permissionModuleProfile as $val) {
            Permission::create([
                'name' => $val['name'],
                'display_name' => $val['display_name'],
                'description' => $val['description'],
                'module_id' => $moduleProfile->id
            ]);
        }

        // MODULE
        $module = Module::create([
            'name' => 'Module'
        ]);

        $permissionModule = [
            [
                'name' => 'manage-module',
                'display_name' => 'Manage Module',
                'description' => 'Can Manage Module'
            ],
            [
                'name' => 'create-module',
                'display_name' => 'Create Module',
                'description' => 'Can Create Module'
            ],
            [
                'name' => 'edit-module',
                'display_name' => 'Edit Module',
                'description' => 'Can Edit Module'
            ],
            [
                'name' => 'delete-module',
                'display_name' => 'Delete Module',
                'description' => 'Can Menghapus Module'
            ]
        ];

        foreach ($permissionModule as $key) {
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $module->id
            ]);
        }

        // Permission
        $modulePermission = Module::create([
            'name' => 'Module Permission'
        ]);

        $permissionModulePermission = [
            [
                'name' => 'manage-permission',
                'display_name' => 'Manage Permission',
                'description' => 'Can Manage Permission'
            ],
            [
                'name' => 'create-permission',
                'display_name' => 'Create Permission',
                'description' => 'Can Tambah Permission'
            ],
            [
                'name' => 'edit-permission',
                'display_name' => 'Edit Permission',
                'description' => 'Can Edit Permission'
            ],
            [
                'name' => 'delete-permission',
                'display_name' => 'Delete Permission',
                'description' => 'Can Delete Permission'
            ]
        ];

        foreach ($permissionModulePermission as $key) {

            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $modulePermission->id
            ]);
        }

        // USER
        $moduleUser = Module::create([
            'name' => 'Module User Management'
        ]);

        $permissionModuleUser = [
            [
                'name' => 'manage-user',
                'display_name' => 'Manage User',
                'description' => 'Can Manage User'
            ],
            [
                'name' => 'create-user',
                'display_name' => 'Create User',
                'description' => 'Can Create User'
            ],
            [
                'name' => 'edit-user',
                'display_name' => 'Edit User',
                'description' => 'Can Edit User'
            ],
            [
                'name' => 'delete-user',
                'display_name' => 'Delete User',
                'description' => 'Can Delete User'
            ],
            [
                'name' => 'reset-password',
                'display_name' => 'Reset Password User',
                'description' => 'Can Mengganti Password User'
            ],
            [
                'name' => 'manage-account',
                'display_name' => 'Manage Account Profile',
                'description' => 'Can Manage Profile'
            ],
            [
                'name' => 'edit-account',
                'display_name' => 'Edit Account Profile',
                'description' => 'Can Edit Profile'
            ],
            [
                'name' => 'change-password-account',
                'display_name' => 'Reset Password Profile',
                'description' => 'Can Mengganti Password Profile'
            ],
        ];

        foreach ($permissionModuleUser as $key) {

            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $moduleUser->id
            ]);
        }

        // Role
        $moduleRole = Module::create([
            'name' => 'Module Role'
        ]);

        $permissionModuleRole = [
            [
                'name' => 'manage-role',
                'display_name' => 'Manage Role',
                'description' => 'Can Manage Role'
            ],
            [
                'name' => 'create-role',
                'display_name' => 'Create Role',
                'description' => 'Can Create Role'
            ],
            [
                'name' => 'edit-role',
                'display_name' => 'Edit Role',
                'description' => 'Can Edit Role'
            ],
            [
                'name' => 'delete-role',
                'display_name' => 'Delete Role',
                'description' => 'Can Delete Role'
            ],
            [
                'name' => 'manage-role-access',
                'display_name' => 'Manage Role Access',
                'description' => 'Can Manage Role Access'
            ],
        ];

        foreach ($permissionModuleRole as $key) {

            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $moduleRole->id
            ]);
        }

        // SUPER ADMIN RULES
        Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Admin',
            'description' => 'Ini adalah Role Super Admin'
        ]);

        $adminRole = Role::where('name', 'super_admin')->first();

        $adminPermission = [
            'manage-profile',
            'edit-profile',
            'manage-module',
            'create-module',
            'edit-module',
            'delete-module',
            'manage-permission',
            'create-permission',
            'edit-permission',
            'delete-permission',
            'manage-user',
            'create-user',
            'edit-user',
            'delete-user',
            'reset-password',
            'manage-account',
            'edit-account',
            'change-password-account',
            'manage-role',
            'create-role',
            'edit-role',
            'delete-role',
            'manage-role-access',
        ];

        $userAdmin = User::create([
            'username' => 'super_admin',
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin'
        ]);

        foreach ($adminPermission as $key => $ap) {
            $permission = Permission::where('name', $ap)->first();
            $adminRole->attachPermission($permission->id);
        }

        $userAdmin->attachRole($adminRole);


        // OWNER RULES
        Role::create([
            'name' => 'owner',
            'display_name' => 'Owner',
            'description' => 'Ini adalah Role Owner'
        ]);

        $ownerRole = Role::where('name', 'owner')->first();

        $ownerPermission = [
            'manage-profile',
            'edit-profile',
            'manage-module',
            'create-module',
            'edit-module',
            'delete-module',
            'manage-permission',
            'create-permission',
            'edit-permission',
            'delete-permission',
            'manage-user',
            'create-user',
            'edit-user',
            'delete-user',
            'reset-password',
            'manage-account',
            'edit-account',
            'change-password-account',
            'manage-role',
            'create-role',
            'edit-role',
            'delete-role',
            'manage-role-access',
        ];

        $userOwner = User::create([
            'username' => 'owner',
            'firstname' => 'Project',
            'lastname' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => 'owner'
        ]);

        foreach ($ownerPermission as $key => $ap) {
            $permissionOwner = Permission::where('name', $ap)->first();
            $ownerRole->attachPermission($permissionOwner->id);
        }

        $userOwner->attachRole($ownerRole);

        // Operator
        Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'Ini adalah Role User'
        ]);

        $operatorRole = Role::where('name', 'user')->first();
        $operatorPermission = [
            'manage-profile',
            'edit-profile',
        ];

        $operatorUser = User::create([
            'username' => 'user',
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'user@gmail.com',
            'password' => 'user'
        ]);

        foreach ($operatorPermission as $key => $ap) {
            # code...
            $permission = Permission::where('name', $ap)->first();
            $operatorRole->attachPermission($permission->id);
        }

        $operatorUser->attachRole($operatorUser);

        $user1 =  User::create([
            'username' => 'user1',
            'firstname' => 'User',
            'lastname' => '1',
            'email' => 'user1@gmail.com',
            'password' => 'user1'
        ]);
        $user1Role = Role::where('name', 'super_admin')->first();
        $user1->attachRole($user1Role);
    }
}
