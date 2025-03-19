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

    public function addUsersToGroup($id,Request $request)
    {
        $request->validate([
            'users' => 'required|array',
        ]);

        $group = Group::findOrFail($id);
        $group->users()->attach($request->users); 

        return response()->json(['message' => 'Users added to group successfully!']);
    }

    
    public function calcul($id)
    {
        $group = Group::findOrFail($id);
        $users = $group->users;
        $depenses = $group->expensesGroups;
    
        $total = 0;
        $balances = [];
        
        foreach ($depenses as $depense) {
            $total += $depense->amount;
        }

        $share = count($users) > 0 ? $total / count($users) : 0;

        foreach ($users as $user) {
            $userDepenses = $user->expensesGroups; 
            $depensesAmount = 0;

            foreach ($userDepenses as $depense) {
                $depensesAmount += $depense->amount;
            }

            $balances[$user->name] = $depensesAmount - $share;
        }

        return $balances;
    }



    public function justice($id)
    {
      $balances = $this->calcul($id);
        $debts = [];    
        $credits = [];  
        foreach ($balances as $name => $balance) {
            if ($balance > 0) {
                $credits[$name] = $balance;
            } elseif ($balance < 0) {
                $debts[$name] = $balance;  
            }
        }
        $transactions = [];
        foreach ($debts as $debtor => $debt) {
            foreach ($credits as $creditor => $credit) {
                if ($debt < 0 && $credit > 0) {
                    $amount = min(-$debt, $credit);
                    $transactions[] = [
                        'mine' => $creditor,
                        'ila' => $debtor,
                        'amount' => $amount,
                    ];
                    $debts[$debtor] += $amount;
                    $credits[$creditor] -= $amount;
                }
            }
        }
        return response()->json($transactions);
    }


    public function settleUp($id, Request $request)
    {
        $request->validate([
            'mine' => 'required|string',
            'ila' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $group = Group::findOrFail($id);
        $mine = $group->users->where('name', $request->mine)->first();
        $ila = $group->users->where('name', $request->ila)->first();

        $depense = $group->expensesGroups()->create([
            'depenses_id' => 3,
            'user_id' => $mine->id,
            'amount' => $request->amount,
            'paid_by' => $mine->name,
            'split_method' => 'equal',
        ]);

        $depense = $group->expensesGroups()->create([
            'depenses_id' => 3,
            'user_id' => $ila->id,
            'amount' => -$request->amount,
            'paid_by' => $mine->name,
            'split_method' => 'equal',
        ]);

        return response()->json(['message' => 'The settlement has been added successfully!'], 201);
    }

    public function history($id)
    {
        $group = Group::findOrFail($id);
        $depenses = $group->expensesGroups;
        return response()->json($depenses);
    }

    



}
