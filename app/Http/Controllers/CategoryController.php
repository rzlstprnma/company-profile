<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $blog_categories = BlogCategory::all();
        return response()->json($blog_categories);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $blog_categories = BlogCategory::create($request->all());
        return response()->json($blog_categories);
    }

    public function destroy($id){
        $blog_category = BlogCategory::destroy($id);
        return response()->json($blog_category);
    }
}
