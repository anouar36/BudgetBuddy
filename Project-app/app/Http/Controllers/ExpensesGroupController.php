<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpensesGroup;

class ExpensesGroupController extends Controller
{

    public function index()
    {

        $data = ExpensesGroup::whereNotNull('user_id')->get();
        return response()->json([$data], 201);
    }



    public function ExpensesGroup($id, Request $request)
{
   
    $request->validate([
        'depenses_id' => 'required|integer',
        'amount' => 'required|numeric',
        'paid_by' => 'required|string',
        'split_method' => 'required|string',
    ]);
    $ExpensesGroup = ExpensesGroup::create([
        'group_id' => $id,
        'depenses_id' => $request->depenses_id,
        'user_id' => $request->user()->id, 
        'amount' => $request->amount,
        'paid_by' => $request->paid_by,
        'split_method' => $request->split_method,
    ]);

    return response()->json(['message' => 'The ExpensesGroup has been added successfully!'], 201);
}

    public function destroy($id, $expenseId)
    {
        $ExpensesGroup = ExpensesGroup:: where('group_id', $id)
                                        ->where('depenses_id', $expenseId)
                                        ->delete();
        
        if(!$ExpensesGroup){
            return response()->json(['message' => 'ExpensesGroup id not delete !'], 200);
        }
        return response()->json(['message' => 'ExpensesGroup delete successfully!'], 200);
    }

}
