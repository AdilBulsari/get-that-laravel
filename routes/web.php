<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
return view('hey');

});
Route::get('/post/{id}/{name}', function ($id,$name) {
    // return view('welcome');
return "This is post number". $id." ".$name ;

});

Route::get('/about',function(){
    return 'About';
});

// php artisan route:list => to view list of routes
Route::get('admin/post/example',array('as'=>'admin.home',function(){
$url = route('admin.home');
return "this url is ". $url;
}));