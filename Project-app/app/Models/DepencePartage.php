<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepencePartage extends Model
{
    use HasFactory;


    protected $table = 'depence_partages'; 

    protected $fillable = ['montant', 'description','group_id'];

   

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

   
}
