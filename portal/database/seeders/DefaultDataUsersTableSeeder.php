<?php

namespace Database\Seeders;

use App\Models\Maintainer;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;

class DefaultDataUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentRouteName = Route::currentRouteName();
        if ($currentRouteName != 'LaravelUpdater::database') {
            // Default All Permission
            $allPermission = [
                [
                    'name' => 'manage user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete contact',
                    'guard_name' => 'web',
                ],


                [
                    'name' => 'manage note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage logged history',
                    'guard_name' => 'web',

                ],
                [
                    'name' => 'delete logged history',
                    'guard_name' => 'web',

                ],

                [
                    'name' => 'manage account settings',
                    'guard_name' => 'web',

                ],
                [
                    'name' => 'manage password settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage general settings',
                    'guard_name' => 'web',

                ],
                [
                    'name' => 'manage company settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage email settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage payment settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage seo settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage google recaptcha settings',
                    'guard_name' => 'web',
                ],


                [
                    'name' => 'manage property',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create property',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit property',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete property',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show property',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage unit',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create unit',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit unit',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete unit',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage tenant',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create tenant',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit tenant',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete tenant',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show tenant',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage invoice',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create invoice',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit invoice',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete invoice',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show invoice',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage maintainer',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create maintainer',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit maintainer',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete maintainer',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage maintenance request',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create maintenance request',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit maintenance request',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete maintenance request',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show maintenance request',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete invoice type',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create invoice payment',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete invoice payment',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show expense',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage types',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create types',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit types',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete types',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage notification',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit notification',
                    'guard_name' => 'web',
                ],

            ];
            Permission::insert($allPermission);



            // Default Owner Role
            $ownerRoleData = [
                'name' => 'owner',
                'parent_id' => 0,
            ];
            $systemOwnerRole = Role::create($ownerRoleData);

            // Default Owner All Permissions
            $systemOwnerPermission = [
                ['name' => 'manage user'],
                ['name' => 'create user'],
                ['name' => 'edit user'],
                ['name' => 'delete user'],
                ['name' => 'manage role'],
                ['name' => 'create role'],
                ['name' => 'edit role'],
                ['name' => 'delete role'],
                ['name' => 'manage contact'],
                ['name' => 'create contact'],
                ['name' => 'edit contact'],
                ['name' => 'delete contact'],

                ['name' => 'manage note'],
                ['name' => 'create note'],
                ['name' => 'edit note'],
                ['name' => 'delete note'],
                ['name' => 'manage logged history'],
                ['name' => 'delete logged history'],
                ['name' => 'manage company settings'],
                ['name' => 'manage account settings'],
                ['name' => 'manage password settings'],
                ['name' => 'manage general settings'],
                ['name' => 'manage email settings'],
                ['name' => 'manage payment settings'],
                ['name' => 'manage seo settings'],
                ['name' => 'manage google recaptcha settings'],
                ['name' => 'manage property'],
                ['name' => 'create property'],
                ['name' => 'edit property'],
                ['name' => 'delete property'],
                ['name' => 'show property'],
                ['name' => 'manage unit'],
                ['name' => 'create unit'],
                ['name' => 'edit unit'],
                ['name' => 'delete unit'],
                ['name' => 'manage tenant'],
                ['name' => 'create tenant'],
                ['name' => 'edit tenant'],
                ['name' => 'delete tenant'],
                ['name' => 'show tenant'],
                ['name' => 'manage invoice'],
                ['name' => 'create invoice'],
                ['name' => 'edit invoice'],
                ['name' => 'delete invoice'],
                ['name' => 'show invoice'],
                ['name' => 'manage maintainer'],
                ['name' => 'create maintainer'],
                ['name' => 'edit maintainer'],
                ['name' => 'delete maintainer'],
                ['name' => 'manage maintenance request'],
                ['name' => 'create maintenance request'],
                ['name' => 'edit maintenance request'],
                ['name' => 'delete maintenance request'],
                ['name' => 'show maintenance request'],
                ['name' => 'delete invoice type'],
                ['name' => 'create invoice payment'],
                ['name' => 'delete invoice payment'],
                ['name' => 'manage expense'],
                ['name' => 'create expense'],
                ['name' => 'edit expense'],
                ['name' => 'delete expense'],
                ['name' => 'show expense'],
                ['name' => 'manage types'],
                ['name' => 'create types'],
                ['name' => 'edit types'],
                ['name' => 'delete types'],
                ['name' => 'manage notification'],
                ['name' => 'edit notification'],


            ];
            $systemOwnerRole->givePermissionTo($systemOwnerPermission);

            // Default Owner Create
            $ownerData =    [
                'first_name' => 'Owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'owner',
                'lang' => 'english',
                'email_verified_at' => now(),
                'profile' => 'avatar.png',
                'parent_id' => 0,
            ];
            $systemOwner = User::create($ownerData);
            // Default Owner Role Assign
            $systemOwner->assignRole($systemOwnerRole);


            // Default Owner Role
            $managerRoleData =  [
                'name' => 'manager',
                'parent_id' => $systemOwner->id,
            ];
            $systemManagerRole = Role::create($managerRoleData);
            // Default Manager All Permissions
            $systemManagerPermission = [
                ['name' => 'manage user'],
                ['name' => 'create user'],
                ['name' => 'edit user'],
                ['name' => 'delete user'],
                ['name' => 'manage contact'],
                ['name' => 'create contact'],
                ['name' => 'edit contact'],
                ['name' => 'delete contact'],
                ['name' => 'manage note'],
                ['name' => 'create note'],
                ['name' => 'edit note'],
                ['name' => 'delete note'],

                ['name' => 'manage property'],
                ['name' => 'create property'],
                ['name' => 'edit property'],
                ['name' => 'delete property'],
                ['name' => 'show property'],
                ['name' => 'manage unit'],
                ['name' => 'create unit'],
                ['name' => 'edit unit'],
                ['name' => 'delete unit'],
                ['name' => 'manage tenant'],
                ['name' => 'create tenant'],
                ['name' => 'edit tenant'],
                ['name' => 'delete tenant'],
                ['name' => 'show tenant'],
                ['name' => 'manage invoice'],
                ['name' => 'create invoice'],
                ['name' => 'edit invoice'],
                ['name' => 'delete invoice'],
                ['name' => 'show invoice'],
                ['name' => 'manage maintainer'],
                ['name' => 'create maintainer'],
                ['name' => 'edit maintainer'],
                ['name' => 'delete maintainer'],
                ['name' => 'manage maintenance request'],
                ['name' => 'create maintenance request'],
                ['name' => 'edit maintenance request'],
                ['name' => 'delete maintenance request'],
                ['name' => 'show maintenance request'],
                ['name' => 'delete invoice type'],
                ['name' => 'create invoice payment'],
                ['name' => 'delete invoice payment'],
                ['name' => 'manage expense'],
                ['name' => 'create expense'],
                ['name' => 'edit expense'],
                ['name' => 'delete expense'],
                ['name' => 'show expense'],
                ['name' => 'manage types'],
                ['name' => 'create types'],
                ['name' => 'edit types'],
                ['name' => 'delete types'],
            ];
            $systemManagerRole->givePermissionTo($systemManagerPermission);
            // Default Manager Create
            $managerData =   [
                'first_name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'manager',
                'email_verified_at' => now(),
                'lang' => 'english',
                'profile' => 'avatar.png',
                'parent_id' => $systemOwner->id,
            ];
            $systemManager = User::create($managerData);
            // Default Manager Role Assign
            $systemManager->assignRole($systemManagerRole);


            // Default Tenant role
            $systemTenantRole = defaultTenantCreate($systemOwner->id);
            // Default Tenant
            $tenantData =  [
                'first_name' => 'Tenant',
                'email' => 'tenant@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'tenant',
                'email_verified_at' => now(),
                'lang' => 'english',
                'profile' => 'avatar.png',
                'parent_id' => $systemOwner->id,
            ];
            $systemTenant = User::create($tenantData);
            $systemTenantDetail = new Tenant();
            $systemTenantDetail->user_id = $systemTenant->id;
            $systemTenantDetail->parent_id = $systemOwner->id;
            $systemTenantDetail->save();
            // Default tenant role assign
            $systemTenant->assignRole($systemTenantRole);

            // Default Maintainer role
            $systemTenantRole = defaultMaintainerCreate($systemOwner->id);
            // Default admin
            $maintainerData = [
                'first_name' => 'Maintainer',
                'email' => 'maintainer@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'maintainer',
                'email_verified_at' => now(),
                'lang' => 'english',
                'profile' => 'avatar.png',
                'parent_id' => $systemOwner->id,
            ];
            $systemMaintainer = User::create($maintainerData);
            $systemMaintainerDetail = new Maintainer();
            $systemMaintainerDetail->user_id = $systemMaintainer->id;
            $systemMaintainerDetail->parent_id = $systemOwner->id;
            $systemMaintainerDetail->save();

            // Default Template
            defultTemplate($systemOwner->id);

            // Default admin role assign
            $systemMaintainer->assignRole($systemTenantRole);
        }
    }
}
