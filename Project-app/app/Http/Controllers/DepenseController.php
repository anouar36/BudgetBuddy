<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Depense;


class DepenseController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'number' => 'required|integer', 
            'user_id' => 'required|integer',
        ]);

        $depens = Depense::create([
            'name' => $request->name,
            'number' => $request->number,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'The Depense is added successfully!'], 201);
    }


    public function store()
    {

        $data = Depense::whereNotNull('user_id')->get();
        return response()->json([$data], 201);
    }

    public function show($id)
    {
        $data = Depense::where('id','=',$id)->get();
        return response()->json([$data], 201);
    }


    public function update($id , Request $request)
    {
        $depense = Depense::find($id);

        if (!$depense) {
            return response()->json(['message' => 'Depense not found'], 404);
        }
    
        $depense->update([
            'name' => $request->name,  
            'number' => $request->number,
            'user_id' => $request->user_id,
        ]);
    
        return response()->json(['message' => 'Depense updated successfully!'], 200);
    }


    public function destroy($id)
    {

         $depense = Depense::find($id)->delete();

         if(!$depense){

            return response()->json(['message' => 'Depense id not delete !'], 200);
         }
         return response()->json(['message' => 'Depense delete successfully!'], 200);

    }
}
