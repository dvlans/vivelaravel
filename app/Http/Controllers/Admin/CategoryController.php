<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use File;
use App\Product;
use App\ProductImage;

class CategoryController extends Controller
{
	public function index(){
    	
    	$categories = Category::orderBy('name')->paginate(10);
    	return view('admin.categories.index')->with(compact('categories')); //listado
    }

    public function create(){
    	$categories = Category::all();
    	return view('admin.categories.create'); //formulario de registro
    }

    public function store(Request $request){
    	// registrar el nuevo producto en la bbdd
    	//dd($request->all());

    	$this->validate($request, Category::$rules, Category::$messages);

    	$category = Category::create($request->only('name', 'description'));	

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/categories'; //public path es la ruta absoluta donde se guarda la img
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);


            //Actualizar la tabla category
            if ($moved) {
                $category->image = $fileName;
                $category->save(); //INSERT EN LA BD
            }   
        } 

    	return redirect('/admin/categories');
    }


    public function edit(Category $category){
    	return view('admin.categories.edit')->with(compact('category')); //formulario de registro
    }

    public function update(Request $request, Category $category){
    	// registrar el nuevo producto en la bbdd
    	//dd($request->all());
    	

    	$this->validate($request, Category::$rules, Category::$messages);
        $category->update($request->only('name', 'description'));


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/categories'; //public path es la ruta absoluta donde se guarda la img
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);


            //Actualizar la tabla category
            if ($moved) {
                $previousPath = $path . '/' . $category->image;
                $category->image = $fileName;
                $saved = $category->save(); //INSERT EN LA BD

                if($saved)
                    File::delete($previousPath);
            }   
        } 

    	return redirect('/admin/categories');
    }


    public function destroy(Category $category){
        
        $product = Product::find($category);
        
        $product->delete();
        $category->delete(); //DELETE

    	return back();
    }
}
