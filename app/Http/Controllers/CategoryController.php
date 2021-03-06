<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use GuzzleHttp\Middleware;
use App\Models\Product;
class CategoryController extends Controller
{

    public function __construct(){

        $this->middleware('can:Administrar categorias')->only('create','edit');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', '=', 'A')->get();
        return view('category.show',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validación de campos
        $request->validate([
            'name' => 'required',
            'name' => 'required|unique:categories,name',
            'description' => 'required'
        ], 
        [
            'name.required' => 'Ingrese el nombre de la categoria',
            'name.unique' => 'El nombre de la categoria ya existe',
            'description.required' => 'Ingrese la descripción de la categoria'
        ]);
        
        //Crear categoria
        $categories = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('status','La categoria se creó correctamente');
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        // $product = Product::with('products')->findOrFail( $category->id );
        $products = Product::where('category_id', $category->id)->get();

        return view('category.view', compact('products','category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //$category = Category::all();

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {   
        //Validación de datos
        $request->validate([
            'name' => 'required',
            'name' => 'required|unique:categories,name,'.$category->id,
            'description' => 'required'
        ], 
        [
            'name.required' => 'Ingrese el nombre de la categoria',
            'name.unique' => 'El nombre de la categoria ya existe',
            'description.required' => 'Ingrese la descripción de la categoria'
        ]);

        //Actualizar datos en la tabla
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]); 

        return redirect()->route('categories.index',$category)
            ->with('status','La categoria se actualizó correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            //Eliminar registro
            $category->delete();

        } catch (\Illuminate\Database\QueryException $e) {

            $errorc = 'No se puede eliminar la categoria porque contiene productos asociados';
            return redirect()->route('categories.index')
            ->with('errorc', $errorc);
        }

        // $category->delete();
        
        return redirect()->route('categories.index')->with('status','La categoria se eliminó correctamente.');
    }

    public function detailProd(Product $product, Category $category){

        return view('category.detailprod', compact('product','category'));

    }
}
