<?php

namespace App\Http\Controllers;
// php artisan make:controller --resource PostsController CRUD
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        return "Post controller working :)".$id;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return "Created";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return "this is the show method";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }               

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function contact(){
        $people=['adil','sam','jimmy','simon'];

        return view('pages/contact',compact('people'));
    }
    public function showPost($id,$name){
        // return view('pages/post')->with('id',$id);

        return view('pages/post',compact('id','name'));
    }
}
