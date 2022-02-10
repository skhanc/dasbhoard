<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $fillable=
    [
        'company_id',
        'name',
        'quantity',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
