<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesGroup extends Model
{
    use HasFactory;

    protected $table = 'expenses_groups';
    protected $fillable = ['group_id', 'depenses_id', 'user_id', 'amount', 'paid_by', 'split_method'];

    public function group()
{
    return $this->belongsTo(Group::class, 'group_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function depense()
{
    return $this->belongsTo(Depense::class, 'depenses_id');
}

}
