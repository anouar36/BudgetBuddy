<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'devise', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function depencePartages()
    {
        return $this->hasMany(depencePartage::class);
    }

    
}
