<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\isarel\Models\Rola;
use App\isarel\Models\Permission;
use Illuminate\Support\Facades\Hash;


class UserAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*
        DB::table('users')->insert([
            'id' => '1000',
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('laravel'), 
          ]);
          
          
          DB::table('roles')->insert([
            'id' => '2000',
            'name' => 'Administrador',
          ]);  

          DB::table('role_user')->insert([
            'user_id' => '1000',
            'role_id' => '2000',
          ]);  
          */

         //apagamos los foreing
         DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //truncate vacia la tabla
         DB::table('rola_user')->truncate();
         DB::table('permission_rola')->truncate();
         Permission::truncate();
         Rola::truncate();
         DB::statement('SET FOREIGN_KEY_CHECKS=1');
          //codigo escrito por israel

          $useradmin= User::where('email','jadmin@admin.com')->first(); 
          if($useradmin){
            $useradmin->delete();
          }
          $useradmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' =>  Hash::make('laravel')
            
         ]);

          //rol admin
         $roladmin= Rola::create([
          'name' => 'admin',
          'slug' => 'admin',
          'description' => 'administrador',
           'full-access' => 'yes'
  
        ]);
         //pasamos ese rol unico al usuario
         //table role_user
        $useradmin->rolas()->sync([$roladmin->id]);

           //permission
          $permission_all = [];

            
             $permission = Permission::create([
              'name' => 'List role',
              'slug' => 'rola.index',
              'description' => 'A user can List role',
            ]);
            $permission_all[] = $permission->id;


             

            $permission = Permission::create([
            'name' => 'show role',
            'slug' => 'rola.show',
            'description' => 'A user can see role',
            ]);
            $permission_all[] = $permission->id;

            $permission = Permission::create([
              'name' => 'Create role',
              'slug' => 'rola.create',
              'description' => 'A user can create role',
              ]);
              $permission_all[] = $permission->id;

            $permission = Permission::create([
            'name' => 'edit role',
            'slug' => 'rola.edit',
            'description' => 'A user can edit role',
            ]);
            $permission_all[] = $permission->id;

            $permission = Permission::create([
            'name' => 'destroy role',
            'slug' => 'rola.destroy',
            'description' => 'A user can destroy role',
            ]);
            $permission_all[] = $permission->id;
            

            //permisos_para los user
            $permission = Permission::create([
              'name' => 'List user',
              'slug' => 'user.index',
              'description' => 'A user can List role',
            ]);
            $permission_all[] = $permission->id;


             

            $permission = Permission::create([
            'name' => 'show user',
            'slug' => 'user.show',
            'description' => 'A user can see user',
            ]);
            $permission_all[] = $permission->id;

            /*
            $permission = Permission::create([
              'name' => 'Create user',
              'slug' => 'user.create',
              'description' => 'A user can create user',
              ]);
              $permission_all[] = $permission->id;
              */

            $permission = Permission::create([
            'name' => 'edit user',
            'slug' => 'user.edit',
            'description' => 'A user can edit user',
            ]);
            $permission_all[] = $permission->id;

            $permission = Permission::create([
            'name' => 'destroy user',
            'slug' => 'user.destroy',
            'description' => 'A user can destroy user',
            ]);
            $permission_all[] = $permission->id;
       
             // Permisos de las rotes  Permisos Personal Academico
            $permission = Permission::create([
              'name' => 'Lista de Personal Academico',
              'slug' => 'personalAcademico.index',
              'description' => 'Usted Puede ver la lista del personal Academico',
              ]);
              $permission_all[] = $permission->id;

              $permission = Permission::create([
                'name' => 'Eliminar personal Academico',
                'slug' => 'personalAcademico.destroy',
                'description' => 'Usted puede eliminar Personal Academico',
                ]);
                $permission_all[] = $permission->id;

                $permission = Permission::create([
                  'name' => 'Crear personal Academico',
                  'slug' => 'personalAcademico.personalAcademico.create',
                  'description' => 'Usted puede Crear Personal Academico',
                  ]);
                  $permission_all[] = $permission->id;
      //table permission_rola
     // $roladmin->permissions()->sync( $permission_all );
        
    }
}
