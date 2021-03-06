<?php

namespace App\Http\Controllers;

use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_tags = BlogTag::all();
        return response()->json($blog_tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tag_name' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()]);
        }

        $blog_tag = BlogTag::create($request->all());
        return response()->json($blog_tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_tag = BlogTag::destroy($id);
        return response()->json($blog_tag);
    }
}
