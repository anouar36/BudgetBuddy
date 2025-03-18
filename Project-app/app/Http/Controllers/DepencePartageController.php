<?php
namespace App\Http\Controllers;

use App\Models\DepencePartage;
use Illuminate\Http\Request;


class DepencePartageController extends Controller
{
    public function index()
    {
        $data = DepencePartage::all();
        return response()->json([$data], 201);
    }


    public function store(Request $request, $id)
    {
        $request->validate([
            'montant' => 'required|string',
            'Qui_a_paye' => 'required|string',
            'diviser' => 'required|string',
        ]);

        $depens = DepencePartage::create([
            'montant' => $request->montant,
            'Qui_a_paye' => $request->Qui_a_paye,
            'diviser' => $request->diviser,
            'group_id' => $id,
        ]);


        

        return response()->json(['message' => 'The DepencePartage is added successfully!'], 201);
    }


    public function show($id)
    {
        $data = DepencePartage::where('id','=',$id)->get();
        return response()->json([$data], 201);
    }


    public function destroy($id)
    {
         $DepencePartage = DepencePartage::find($id)->delete();
         if(!$DepencePartage){
            return response()->json(['message' => 'DepencePartage id not delete !'], 200);
         }
         return response()->json(['message' => 'DepencePartage delete successfully!'], 200);

    }
}
