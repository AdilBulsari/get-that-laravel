<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addtag(Request $request)
    {
        //validate
        $this->validate($request, [
            'tagName' => 'required'
        ]);
        return Tag::create([
            'tagName' => $request->tagName
        ]);
    }
    public function getTags(Request $request)
    {
        //validate
        return Tag::orderBy('id', 'desc')->get();
    }
    public function editTag(Request $request)
    {
        //validate
        $this->validate($request, [
            'tagName' => 'required',
            'id' => 'required'
        ]);

        return Tag::where('id', $request->id)->update(['tagName' => $request->tagName]);
    }
    public function deleteTag(Request $request)
    {
        $this->validate($request, [

            'id' => 'required'
        ]);
        return Tag::where('id', $request->id)->delete();
    }

    public function upload(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,bmp,img'
        ]);
        $image = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $image);
        return $image;
    }
}
