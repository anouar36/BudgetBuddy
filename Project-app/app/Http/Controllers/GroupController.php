<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $data = Group::all();
        return response()->json([$data], 201);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'devise' => 'required|string',
        ]);


        $depens = Group::create([
            'name' => $request->name,
            'devise' => $request->devise,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'The Group is added successfully!'], 201);
    }


    public function show($id)
    {
        $data = Group::where('id','=',$id)->get();
        return response()->json([$data], 201);
    }


    public function destroy($id)
    {
         $Group = Group::find($id)->delete();
         if(!$Group){
            return response()->json(['message' => 'Group id not delete !'], 200);
         }
         return response()->json(['message' => 'Group delete successfully!'], 200);

    }
}
