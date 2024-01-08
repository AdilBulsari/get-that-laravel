<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;

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


// Route::get('/post/{id}',[PostsController::class,'index']);

Route::resource('posts', PostsController::class);
Route::get('/contact', [PostsController::class, 'contact']);
// Route::get('post/{id}/{name}', [PostsController::class, 'showPost']);

Route::get('/insert', function () {
    DB::insert('insert into posts(title,body) values(?,?)', ['PHP with laravel', 'PHP laravel is best
']);
});


//DB raw SQL queries 
Route::get('/read', function () {
    $result = DB::select('SELECT * FROM posts WHERE id= ?', [1]);
    foreach ($result as $eachresult) {
        return $eachresult->title;
    }
});

Route::get('/update', function () {
    $updated = DB::update('UPDATE posts SET title ="Adil" WHERE id =?', [1]);

    return $updated;
});

Route::get('/delete', function () {
    $deleted = DB::delete('DELETE FROM posts WHERE id=?', [1]);
    return $deleted;
});

//eloquent ORM

Route::get('/read', function () {
    $posts =  Post::all();

    foreach ($posts as $post) {
        return $post->title;
    }
});

// Route::get('/post/{id}', function ($id) {
//     $post =  Post::find($id);

//     // foreach($posts as $post){
//     // return $post->title;
//     // }
//     if ($post) {
//         return $post->title;
//     }

//     return $id . ' not found any data for this id';
// });

Route::get('/findwhere', function () {
    $posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
    return $posts->body;
});

Route::get('/findmore', function () {
    $posts = Post::findOrFail(1);

    return $posts;
});

// saving data 
Route::get('/basicinsert', function () {
    $post = new Post;
    $post->title = 'New Eloquent insert';
    $post->body = 'Eloquent is cool !!';
    $post->save();
});
Route::get('/findandinsert', function () {
    $post = Post::find(1);
    $post->title = 'updated Eloquent insert';
    $post->body = 'Eloquent is cool with updates!!';
    $post->save();
});


//creating data and configuring mass assignments
Route::get('/create', function () {
    Post::create(['title' => 'the create method', 'body' => 'WOW I\'am learning alot with php']);
});

//update with eloquent

Route::get('/update', function () {
    Post::where('id', 20)->where('is_Admin', 7)->update(['title' => 'New php title', 'body' => 'PHP with laravel vue is best']);
});

//delete 

Route::get('/delete', function () {
    $post = Post::find(2);
    $post->delete();
});

Route::get('/delete2', function () {
    Post::destroy(1);
});

Route::get('/delete2', function () {
    Post::destroy([1, 3]);
    //by query
    Post::where('is_admin', 0)->delete();
});
Route::get('/softdelete', function () {
    Post::find(2)->delete();
});

Route::get('/readsoftdelete', function () {
    // $post = Post::find(1);
    // return $post;

    // $post = Post::withTrashed()->where('id',1)->get();
    // return $post;

    $post = Post::onlyTrashed()->where('is_admin', 0)->get();

    return $post;
});


//eloquent relationships
//one to one
Route::get('/user/{id}/post', function ($id) {
    return User::find($id)->post;
});

Route::get('/post/{id}/user', function ($id) {
    // print_r($id);
    return Post::find($id)->user->name;
});

//one to many
Route::get('/posts', function () {
    $user = User::find(1);
    foreach ($user->posts as $post) {
        echo $post->title . "<br>";
    }
});

//many to many 
Route::get('/user/{id}/role', function ($id) {
    $user = User::find($id);

    foreach ($user->roles as $role) {
        return $role->name;
    }
});
