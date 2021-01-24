<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Category;
use Spatie\Permission\Models\Permission;
use App\Models\Product;

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

        $products = new TablesSeeder();
        $products->productTable();
    }

    public function userTable(){

        User::create([
            'name' => 'Admin',
            'email' =>  'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'Vendedor',
            'email' =>  'vendedor@gmail.com',
            'password' => Hash::make('12345678')
        ]);

    }

    public function categoryTable(){

        Category::create([
            'name' => 'Cocina',
            'description' => 'Productos de hogar para la cocina'
        ]);

        Category::create([
            'name' => 'Salón',
            'description' => 'Variedad en productos para el salón'
        ]);

        Category::create([
            'name' => 'Patio',
            'description' => 'Productos de jardin entre otros'
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
            'name' => 'Eliminar pedidos' 
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
    }

    public function productTable(){

        Product::create([
            'name'      => 'Platera cromada de 2 niveles',
            'image'     => 'img/prueba.jpg',
            'price'     => 20,
            'description' => 'Platera de dos niveles de material cromado',
            'comission' => 2.99,
            'quantity'  => 10,
            'discount'  => 0,
            'category_id' => 1
        ]);
    }
}
