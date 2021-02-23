<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Storage; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::all();
        $products = Product::with('Category')->get();
        //$category = $products->categories->name;
        return view('product.show',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //Categorias
        $category = Category::where('status', '=', 'A')
                            ->orderBy('id', 'asc')
                            ->pluck('name','id');
        $products = new Product;

        return view('product.create', compact('products','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          =>  'required|unique:products,name',
            'image'         =>  'required|image',
            'price'         =>  'required',
            'comission'     =>  'required',
            'description'   =>  'required',
            'discount'      =>  'numeric',
            'quantity'      =>  'integer'
        ], 
        [   'name.required'         =>  'Ingrese el nombre del producto',
            'name.unique'           =>  'El nombre del producto ya existe',
            'price.required'        =>  'Ingrese el precio del producto',
            'image.required'        =>  'Ingrese la imagen del producto',
            'image.image'           =>  'Debe ingresar una imagen del producto',
            'comission.required'    =>  'Ingrese el valor de la comisión',
            'description.required'  =>  'Ingrese la descripción del producto',
            'discount.numeric'      =>  'Ingrese el valor de porcentaje de descuento o ingrese cero',
            'quantity.integer'      =>  'Ingrese un valor entero de cantidad disponible',
            'name.unique'           =>  'El nombre del producto ya existe'
        ]);

        // $imagenes = $request->file('image')->store('public/img');

        // $url = Storage::url($imagenes);
        
        //Subida de imagen mediante intervention image pck
        $nombre = Str::random(10).$request->file('image')->getClientOriginalName();

        $ruta = storage_path().'\app\public\img/'.$nombre;

        Image::make($request->file('image'))
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($ruta);

        $product = Product::create([
            'name'          => $request->name,
            'image'         => '/storage/img/'.$nombre,
            'price'         => $request->price,
            'description'   => $request->description,
            'comission'     => $request->comission,
            'quantity'      => $request->quantity,
            'discount'      => $request->discount,
            'category_id'   => $request->category
        ]);

        return redirect()->route('products.index')->with('status','El producto se creó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $category = Category::orderBy('id', 'asc')->pluck('name','id');
        return view('product.view', compact('product','category'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function edit(Product $product)
    {
        $category = Category::orderBy('id', 'asc')->pluck('name','id');
        return view('product.edit', compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name'          =>  'required',
            'price'         =>  'required',
            'comission'     =>  'required',
            'description'   =>  'required',
            'discount'      =>  'required',
            'quantity'      =>  'integer'
        ], 
        [   'name.required'         =>  'Ingrese el nombre del producto',
            'price.required'        =>  'Ingrese el precio del producto',
            'comission.required'    =>  'Ingrese el valor de la comisión',
            'description.required'  =>  'Ingrese la descripción del producto',
            'discount.required'     =>  'Ingrese el valor de porcentaje de descuento o ingrese cero',
            'discount.integer'      =>  'Ingrese el valor de porcentaje de descuento o ingrese cero',
            'quantity.integer'      =>  'Ingrese un valor entero de cantidad disponible',
            'name.unique'           =>  'El nombre del producto ya existe'
        ]);


        if($request->file('image')){
            
            $nombre = Str::random(10).$request->file('image')->getClientOriginalName();

            $ruta = storage_path().'\app\public\img/'.$nombre;
    
            //$image = '/storage/img/'.$nombre;
    
            Image::make($request->file('image'))
            ->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($ruta);
            
            if($product->image){
                //Borrar imagen anterior
                $url = str_replace('storage', 'public',$product->image);
                
                storage::delete($url);
            }

            $product->update([
                'name'          => $request->name,
                'image'         => '/storage/img/'.$nombre,
                'price'         => $request->price,
                'description'   => $request->description,
                'comission'     => $request->comission,
                'quantity'      => $request->quantity,
                'discount'      => $request->discount,
                'category_id'   => $request->category
            ]);


        }else{
            $product->update([
                'name'          => $request->name,
                'price'         => $request->price,
                'description'   => $request->description,
                'comission'     => $request->comission,
                'quantity'      => $request->quantity,
                'discount'      => $request->discount,
                'category_id'   => $request->category
            ]);  
        }

        // $imagenes = $request->file('image')->store('public/img');

        // $url = Storage::url($imagenes);

        //Subida de imagen mediante intervention image pck

        // $nombre = Str::random(10).$request->file('image')->getClientOriginalName();

        // $ruta = storage_path().'\app\public\img/'.$nombre;

        // $image = '/storage/img/'.$nombre;

        // Image::make($request->file('image'))
        //         ->resize(1200, null, function ($constraint) {
        //             $constraint->aspectRatio();
        //         })->save($ruta);    

        //Borrar imagen anterior
        // $url = str_replace('storage', 'public',$product->image);
        
        // storage::delete($url);

        // $product->update([
        //     'name'          => $request->name,
        //     'image'         => $image,
        //     'price'         => $request->price,
        //     'description'   => $request->description,
        //     'comission'     => $request->comission,
        //     'quantity'      => $request->quantity,
        //     'discount'      => $request->discount,
        //     'category_id'   => $request->category
        // ]);

        return redirect()->route('products.index')->with('status','El producto se actualizó correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {   
        //Ruta public de la imagen
        $url = str_replace('storage', 'public',$product->image);
        //Borrar imagen
        storage::delete($url);
        //Borra registro del producto
        $product->delete();

        return redirect()->route('products.index')->with('status','El producto se eliminó correctamente.');
    }
}
