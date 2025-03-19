<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'devise', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function depenses()
    {
        return $this->hasMany(depense::class);
    }
    

    public function expensesGroups()
    {
        return $this->hasMany(ExpensesGroup::class, 'group_id');
    }

   
    


    public function tags()
    {
        return $this->belongsToMany(Tage::class);
    }



    
}
