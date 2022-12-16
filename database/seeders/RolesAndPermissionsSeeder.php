<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create permissions


        $arrayOfPermissionNames = [
            'Voir Personnels', 'Ajouter Personnel','Suspendre Personnel','Editer Personnel',
            'Voir Congés', 'Ajouter Congés','Suspendre Congés','Editer Congés',
            'Voir Département', 'Ajouter Département','Supprimer Département','Editer Département',
            'Voir Direction', 'Ajouter Direction','Supprimer Direction','Editer Direction',
            'Voir Permission','Ajouter Permission','Editer Permission','Supprimer Permission',
            'Voir Role','Editer Role','Supprimer Role','Ajouter Role',
            'Voir contrôle d`\'accès',
            /*'view-products','create-product','update-product','destroy-product',
            'view-purchase','create-purchase','update-purchase','destroy-purchase',
            'view-supplier','create-supplier','update-supplier','destroy-supplier',
            'view-users','create-user','update-user','destroy-user',*/



            /*'view-expired-products','view-outstock-products','backup-app','backup-db','view-settings',*/

        ];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        // create roles and assign permissions
        $role = Role::create(['name' => 'Simple Agent'])
            ->givePermissionTo([
                'Voir Département','Voir Direction','Voir Congés', 'Ajouter Congés',
            ]);
        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());
    }
}
