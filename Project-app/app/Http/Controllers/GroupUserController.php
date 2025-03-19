<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupUser;

class GroupUserController extends Controller
{
    public function index()
    {
        $data = GroupUser::all();
        return response()->json([$data], 201);
    }

    
}