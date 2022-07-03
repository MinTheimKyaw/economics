<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function subcategories()
    {
        return $this->belongsTo(Subcategories::class);
    }

    public function orderhistories()
    {
        return $this->hasMany(Orderhistory::class);
    }
}
