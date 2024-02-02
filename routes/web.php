<?php

use App\Http\Controllers\AdminController;
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
    return view('welcome');

});

Route::post('/app/create_tag',[AdminController::class,'addTag']);
Route::get('/app/get_tags',[AdminController::class,'getTags']);
Route::patch('/app/edit_tag',[AdminController::class,'editTag']);
Route::delete('/app/delete_tag',[AdminController::class,'deleteTag']);
Route::post('app/upload',[AdminController::class,'upload']);

// Route::get('/new',[TestController::class,'test']);

Route::any('{any}',function(){
return view('welcome');
});
