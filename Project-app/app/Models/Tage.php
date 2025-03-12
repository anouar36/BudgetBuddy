<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Depense;


class Tage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'depense_id',
    ];

    public function Depense(){

        return $this->belongsToMany(Depense::class);
    }
}
