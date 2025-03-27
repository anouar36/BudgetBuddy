<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Depense;


class DepenseController extends Controller
{

    public function index()
    {

        $data = Depense::whereNotNull('user_id')->get();
        return response()->json([$data], 201);
    }


    public function store(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $request->validate([
            'name' => 'required|string',
            'number' => 'required|integer', 
        ]);

        $depens = Depense::create([
            'name' => $request->name,
            'number' => $request->number,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['message' => 'The Depense is add successfully!'], 201);
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

    public function attachTags($id, Request $request)
    {
        $request->validate([
            'tages' => 'required|array',
        ]);

        $depense = Depense::find($id);

        if (!$depense) {
            return response()->json(['error' => 'Depense not found!'], 404);
        }

        $depense->tages()->sync($request->tages);

        return response()->json(['message' => 'Tags added successfully!', 'data' => $depense->tages], 200);
    }


    public function detectAnomalies(Request $request)
    {
        $userId = $request->user()->id;
        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $currentMonth = now()->format('Y-m');
        $previousMonth = now()->subMonth()->format('Y-m');

        $currentMonthExpenses = Depense::where('user_id', $userId)
            ->where('date', 'like', "$currentMonth%")
            ->get();

        $previousMonthExpenses = Depense::where('user_id', $userId)
            ->where('date', 'like', "$previousMonth%")
            ->get();

        $currentMonthTotal = $currentMonthExpenses->sum('amount');
        $previousMonthTotal = $previousMonthExpenses->sum('amount');

        if ($previousMonthTotal > 0 && $currentMonthTotal > ($previousMonthTotal * 1.2)) {
            return response()->json([
                'message' => 'تم اكتشاف زيادة مفاجئة في النفقات!',
                'current_month_total' => $currentMonthTotal,
                'previous_month_total' => $previousMonthTotal,
            ], 200);
        }
        
        foreach ($currentMonthExpenses as $expense) {
            if ($expense->amount > 1000) {
                return response()->json([
                    'message' => ' تم اكتشاف معاملة غير معتادة!',
                    'amount' => $expense->amount,
                    'date' => $expense->date,
                ], 200);
            }
        }

        return response()->json(['message' => 'لا توجد أي أنشطة مشبوهة'], 200);
    }


    
}
