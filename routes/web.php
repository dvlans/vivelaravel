<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/search','SearchController@show');
Route::get('/products/json','SearchController@data');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}','ProductController@show'); //Detalle del producto.
Route::get('/categories/{category}','CategoryController@show');

Route::get('/messageClient', 'HomeController@message');



Route::post('/cart','CartDetailController@store'); 
Route::delete('/cart','CartDetailController@destroy');

Route::post('/order', 'CartController@update');



Route::middleware(['auth','admin'])->prefix('admin')->namespace('admin')->group(function () {
   	Route::get('/products','ProductController@index'); //Listar 
	Route::get('/products/create','ProductController@create'); //Formulario 
	Route::post('/products','ProductController@store'); //Registro
	Route::get('/products/{id}/edit','ProductController@edit'); //Formulario edición del producto 
	Route::post('/products/{id}/edit','ProductController@update'); //actualizar
	Route::delete('/products/{id}','ProductController@destroy'); //eliminar


	Route::get('/products/{id}/images','ImageController@index');
	Route::post('/products/{id}/images','ImageController@store'); //Registro
	Route::delete('/products/{id}/images','ImageController@destroy'); //eliminar
	Route::get('/products/{id}/images/select/{image}','ImageController@select'); //Destacar imagen


	Route::get('/categories','CategoryController@index'); //Listar 
	Route::get('/categories/create','CategoryController@create'); //Formulario 
	Route::post('/categories','CategoryController@store'); //Registro
	Route::get('/categories/{category}/edit','CategoryController@edit'); //Formulario edición del producto 
	Route::post('/categories/{category}/edit','CategoryController@update'); //actualizar
	Route::delete('/categories/{category}','CategoryController@destroy'); //eliminar
});
 



