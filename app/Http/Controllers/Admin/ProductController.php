<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\ProductImage;

class ProductController extends Controller
{
    public function index(){
    	$producto =Product::all();
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); //listado
    }

    public function create(){

    	$categories = Category::orderBy('name')->get();
    	return view('admin.products.create')->with(compact('categories')); //formulario de registro
    }

    public function store(Request $request){
    	// registrar el nuevo producto en la bbdd
    	//dd($request->all());
    	$messages=[
    		'name.required' => 'Debe ingresar un nombre.',
    		'name.min' => 'Debe ingresar minimo 3 caracteres.',
    		'description.required' => 'Debe ingresar una descripción.',
    		'description.max' => 'No debe exceder los 200 caracteres.',
    		'price.required' => 'Debe ingresar un precio.',
    		'price.numeric' => 'Debe ingresar solo valores numericos.',
    		'price.min' => 'Debe ingresar solo valores positivos.'
    	];


    	$rules=[
    		'name'=> 'required|min:3',
    		'description'=> 'required|max:200',
    		'price'=> 'required|numeric|min:0'
    	];

    	$this->validate($request, $rules, $messages);



    	$product = new Product();
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->long_description = $request->input('long_description');
    	$product->price = $request->input('price');
        $product->category_id = $request->category_id;  
    	$product->save(); //INSERT

    	return redirect('/admin/products');
    }


    public function edit($id){
    	//return "Mostrando dato de prueba $id";
        $categories = Category::orderBy('name')->get();
    	$product = Product::find($id);
    	return view('admin.products.edit')->with(compact('product','categories')); //formulario de registro
    }

    public function update(Request $request, $id){
    	// registrar el nuevo producto en la bbdd
    	//dd($request->all());
    	$messages=[
    		'name.required' => 'Debe ingresar un nombre.',
    		'name.min' => 'Debe ingresar minimo 3 caracteres.',
    		'description.required' => 'Debe ingresar una descripción.',
    		'description.max' => 'No debe exceder los 200 caracteres.',
    		'price.required' => 'Debe ingresar un precio.',
    		'price.numeric' => 'Debe ingresar solo valores numericos.',
    		'price.min' => 'Debe ingresar solo valores positivos.'
    	];


    	$rules=[
    		'name'=> 'required|min:3',
    		'description'=> 'required|max:200',
    		'price'=> 'required|numeric|min:0'
    	];

    	$this->validate($request, $rules, $messages);


    	$product = Product::find($id);
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->long_description = $request->input('long_description');
    	$product->price = $request->input('price');
        $product->category_id = $request->category_id;  
    	$product->save(); //UPDATE

    	return redirect('/admin/products');
    }


    public function destroy($id){
    	$product = Product::find($id);
        $productImage = ProductImage::find($id);
        $productImage->delete();
    	$product->delete(); //DELETE

    	return back();
    }
}
