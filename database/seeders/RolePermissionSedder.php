<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        // Create Rules
        $roleSuperAdmin = Role::create(['name' => 'superAdmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);
        // permission list an array
        $permissions = [
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit'
                ]
            ],
            [
                'group_name' => 'blog',
                'permissions' => [
                    // blog Permission
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve'
                ]
            ],
            [
                //admin permission
                'group_name' => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve'
                ]
            ],

            [
                'group_name' => 'role',
                'permissions' => [
                    // role permission
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve'
                ]
            ],

            [
                'group_name' => 'profile',
                'permissions' => [
                    // profile permission
                    'profile.view',
                    'profile.edit'
                ]
            ]
        ];


        // create and assign permission

        // 

        for ($i=0; $i < count($permissions); $i++) { 
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j=0; $j < count($permissions[$i]['permissions']); $j++) { 
                // assign Permission and Groupname in Permission Table
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
               
            //    Assgin Permission to SuperAdmin
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }

        }
    }
}
