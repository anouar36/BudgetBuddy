<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tage;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'user_id',
    ];

    
    public function tages(){

        return $this->belongsToMany(tage::class);
        
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function expensesGroups()
    {
        return $this->hasMany(ExpensesGroup::class, 'depenses_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tage::class);
    }


}
