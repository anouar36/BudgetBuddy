<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    public function index()
    {
        $data = Category::all();
        return response()->json([$data], 201);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'The Category is added successfully!'], 201);
    }

    public function show($id)
    {
        $data = Category::where('id','=',$id)->get();
        return response()->json([$data], 201);
    }

    public function destroy($id)
    {
         $category = Category::find($id)->delete();
         if(!$category){
            return response()->json(['message' => 'Category id not delete !'], 200);
         }
         return response()->json(['message' => 'Category delete successfully!'], 200);

    }


}
