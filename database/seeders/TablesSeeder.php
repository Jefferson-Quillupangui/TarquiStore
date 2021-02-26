<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Category;
use App\Models\TypeIdentification;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\Collaborator;
use Illuminate\Support\Carbon;
use App\Models\CitySale;
use App\Models\Sector;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new TablesSeeder;
        $user->userTable(); 

        $category = new TablesSeeder;
        $category->categoryTable();

        $permission = new TablesSeeder;
        $permission->permissionTable();

        $city = new TablesSeeder;
        $city->citySale();

        $sector = new TablesSeeder;
        $sector->sectors();

        // $products = new TablesSeeder();
        // $products->productTable();
     
        $typeIdentification = new TablesSeeder();
        $typeIdentification->typeIdentificationTable();

        $orderStatus = new TablesSeeder();
        $orderStatus->orderstatusTable();

        $collaborator = new TablesSeeder();
        $collaborator->collaboratorTable();
        
        //User Admin
        $user = User::find(1); //Italo Morales
        $user->assignRole('Administrador');

        //User Vendedor
        $user2 = User::find(2); //Italo Morales
        $user2->assignRole('Vendedor');
        
    }

    public function userTable(){

        User::create([
            'name' => 'Admin',
            'email' =>  'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'Vendedor',
            'email' =>  'vendedor@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);

    }

    public function categoryTable(){

        Category::create([
            'name' => 'Cocina',
            'description' => 'Productos de hogar para la cocina'
        ]);

        Category::create([
            'name' => 'Gadgets',
            'description' => 'Variedad en productos prácticos y novedosos'
        ]);

        Category::create([
            'name' => 'Baño',
            'description' => 'Productos para el baño entre otros'
        ]);

        Category::create([
            'name' => 'Dormitorio',
            'description' => 'Productos para el dormitorio entre otros'
        ]);

    }

    public function permissionTable(){
        Permission::create([
            'name' => 'Mantenimiento' 
        ]);

        Permission::create([
            'name' => 'Administrar categorias' 
        ]);

        Permission::create([
            'name' => 'Listar categorias' 
        ]);

        Permission::create([
            'name' => 'Administrar productos' 
        ]);

        Permission::create([
            'name' => 'Listar productos' 
        ]);

        Permission::create([
            'name' => 'Administrar pedidos' 
        ]);
        
        Permission::create([
            'name' => 'Ingresar pedidos' 
        ]);

        Permission::create([
            'name' => 'Editar pedidos' 
        ]);

        Permission::create([
            'name' => 'Listar pedidos' 
        ]);

        Permission::create([
            'name' => 'Cancelar pedidos' 
        ]);

        Permission::create([
            'name' => 'Administrar usuarios' 
        ]);

        Permission::create([
            'name' => 'Administrar roles' 
        ]);

        Permission::create([
            'name' => 'Ver reportes' 
        ]);

        //Admin
        $admin = Role::create(['name' => 'Administrador']);

        $admin->givePermissionTo([
            'Mantenimiento',
            'Administrar categorias',
            'Administrar productos',
            'Administrar pedidos',
            'Administrar usuarios',
            'Administrar usuarios',
            'Administrar roles',
            'Ver reportes',
        ]);

        //Admin
        $vendedor = Role::create(['name' => 'Vendedor']);

        $vendedor->givePermissionTo([
            'Listar categorias',
            'Listar productos',
            'Ingresar pedidos',
            'Editar pedidos',
            'Listar pedidos',
            'Cancelar pedidos'
        ]);

    }

    // public function productTable(){

    //     Product::create([
    //         'name'      => 'Platera cromada de 2 niveles',
    //         'image'     => 'img/prueba.jpg',
    //         'price'     => 20,
    //         'description' => 'Platera de dos niveles de material cromado',
    //         'comission' => 2.99,
    //         'quantity'  => 10,
    //         'discount'  => 0,
    //         'category_id' => 1
    //     ]);
    // }


    public function typeIdentificationTable()
    {
        TypeIdentification::create([
            'codigo'      => '05',
            'name'     => 'CEDULA'
           // 'status' => 'A'
        ]);

        TypeIdentification::create([
            'codigo'      => '06',
            'name'     => 'RUC'
           // 'status' => 'A'
        ]);
    }

    public function citySale()
    {
        CitySale::create([
            'codigo'      => 'GYE',
            'name'     => 'Guayaquil'
           // 'status' => 'A'
        ]);

    }

    public function sectors()
    {
        Sector::create([
            'codigo'      => 'N',
            'name'     => 'Norte'
        ]);

        Sector::create([
            'codigo'      => 'S',
            'name'     => 'Sur'
        ]);

        Sector::create([
            'codigo'      => 'E',
            'name'     => 'Este'
        ]);

        Sector::create([
            'codigo'      => 'OE',
            'name'     => 'Oeste'
        ]);

    }


    public function orderstatusTable(){
        OrderStatus::create([
            'codigo'      => 'OP',
            'name'     => 'Pendiente',
            'description'     => 'El pedido ha sido registrado'
        ]);

        OrderStatus::create([
            'codigo'      => 'OC',
            'name'     => 'Cancelado',
            'description'     => 'El pedido ha sido cancelado'
        ]);

        OrderStatus::create([
            'codigo'      => 'OE',
            'name'     => 'Entregado',
            'description'     => 'El pedido ha sido entregado'
        ]);

        OrderStatus::create([
            'codigo'      => 'OR',
            'name'     => 'Reagendado',
            'description'     => 'El pedido ha sido reagendado'
        ]);
    }
   


    public function collaboratorTable()
    {
        Collaborator::create([
            'identification'      => '099999999',
            'name'     => 'Admin',
            'phone'     => '099999999',
            'birth_date'  => Carbon::parse('1996-08-07'),
            'sex'  => 'H',
            'status'     => 'A',
            'user_id'     => 1,
        ]);

        Collaborator::create([
            'identification'      => '0111111111',
            'name'     => 'Vendedor',
            'phone'     => '0111111111',
            'birth_date'  => Carbon::parse('1996-08-07'),
            'sex'  => 'H',
            'status'     => 'A',
            'user_id'     => 2,
        ]);
    }

    

   

}