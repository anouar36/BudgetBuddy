<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'amount',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function expenses()
    {
        return $this->hasMany(ExpensesGroup::class);
    }

    public function depenses()
    {
        return $this->belongsToMany(Depense::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tage::class);
    }
}
