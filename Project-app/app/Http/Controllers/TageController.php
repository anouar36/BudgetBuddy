<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tage;

class TageController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $depens = Tage::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'The Tage is added successfully!'], 201);
    }


    public function store()
    {

        $data = Tage::all();
        return response()->json([$data], 201);
    }

    public function show($id)
    {
        $data = Tage::where('id','=',$id)->get();
        return response()->json([$data], 201);
    }


    public function update($id , Request $request)
    {
        $Tage = Tage::find($id);

        if (!$Tage) {
            return response()->json(['message' => 'Tage not found'], 404);
        }
    
        $Tage->update([
            'name' => $request->name,  
        ]);
    
        return response()->json(['message' => 'Tage updated successfully!'], 200);
    }


    public function destroy($id)
    {

         $Tage = Tage::find($id)->delete();

         if(!$Tage){

            return response()->json(['message' => 'Tage id not delete !'], 200);
         }
         return response()->json(['message' => 'Tage delete successfully!'], 200);

    }
}
