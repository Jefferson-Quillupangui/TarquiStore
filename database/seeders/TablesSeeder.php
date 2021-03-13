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
            'email' =>  'tarquistore@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Admin1234')
        ]);

        User::create([
            'name' => 'Vendedor',
            'email' =>  'vendedor@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Vendedor1234')
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
            'name' => 'Gestion Pedidos' 
        ]);

        Permission::create([
            'name' => 'Gestion Clientes' 
        ]);

        Permission::create([
            'name' => 'Administrar usuarios' 
        ]);

        Permission::create([
            'name' => 'Administrar roles' 
        ]);

        Permission::create([
            'name' => 'Comisiones' 
        ]);

        Permission::create([
            'name' => 'Comisiones General' 
        ]);

        Permission::create([
            'name' => 'Ver reportes' 
        ]);

        Permission::create([
            'name' => 'Dashboard General' 
        ]);

        Permission::create([
            'name' => 'Dashboard user' 
        ]);

        //Admin
        $admin = Role::create(['name' => 'Administrador']);

        $admin->givePermissionTo([
            'Mantenimiento',
            'Administrar categorias',
            'Listar categorias',
            'Administrar productos', 
            'Listar productos',
            'Administrar pedidos', 
            'Gestion Pedidos', 
            'Gestion Clientes', 
            'Administrar usuarios', 
            'Administrar roles', 
            'Comisiones', 
            'Comisiones General',
            'Ver reportes', 
            'Dashboard General'  
        ]);

        //Admin
        $vendedor = Role::create(['name' => 'Vendedor']);

        $vendedor->givePermissionTo([
            'Listar categorias',
            'Listar productos',
            'Gestion Pedidos',
            'Gestion Clientes',
            'Comisiones',  
            'Dashboard user'
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
            'name'     => 'CÉDULA'
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
            'codigo'      => 'C',
            'name'     => 'Centro'
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
            'identification'      => '0999999999',
            'name'     => 'Admin',
            'phone'     => '0999999999',
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