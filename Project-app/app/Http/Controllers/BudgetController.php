<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Models\Budget;


class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::with('category')->get();
    

        $formattedData = [];
    
        foreach ($budgets as $budget) {
            $userId = $budget->user_id;  
            $categoryName = $budget->category->name; 
        
    
            $totalSpent = Budget::where('user_id', $userId)
                                ->whereHas('category', function ($query) use ($categoryName) {
                                    $query->where('name', $categoryName);
                                })
                                ->sum('amount');
    
            $remaining = $budget->amount - $totalSpent;
    
            $formattedData[] = [
                'user_id' => $userId,
                'user_name' => $budget->user->name,
                'category_name' => $categoryName,
                'category' => $categoryName,
                'amount' => $budget->amount,
                'spent' => $totalSpent,
                'remaining' => $remaining,
            ];
        }
    
        return response()->json($formattedData, 200);
    }
    


    
    
    public function store(Request $request)
    {   
        $request->validate([
            'category_id' => 'required|integer',
            'amount' => 'required|numeric',
        ]);

        $budget = Budget::create([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return response()->json($budget);
    }

   

    public function destroy($id)
    {
        $budget = Budget::find($id)->delete();
        if (!$budget) {
            return response()->json(['message' => 'Budget id not delete !'], 200);
        }
        return response()->json(['message' => 'Budget delete successfully!'], 200);
    }

    public function update ($id , Request $request){
        $budget = Budget::find($id);
        if(!$budget){
            return response()->json(['message' => 'Budget not found !'], 200);
        }
        $request->validate([
            'category_id' => 'required|integer',
            'amount' => 'required|numeric',
        ]);
        $budget->category_id = $request->category_id;
        $budget->amount = $request->amount;
        $budget->save();
        return response()->json(['message' => 'Budget updated successfully!'], 200);
    }

}