<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'description', 'price', 'category_name'];
    
    // Allow setting the ID for sample data
    public $incrementing = false;

    function scopeSearch($q, $t) {
        return $t ? $q->where('name', 'like', "%$t%") : $q;
    }

    function scopeCategory($q, $c) {
        return $c ? $q->where('category_name', $c) : $q;
    }

    function scopePriceMin($q, $v) {
        return $v !== null && $v !== '' ? $q->where('price', '>=', $v) : $q;
    }

    function scopePriceMax($q, $v) {
        return $v !== null && $v !== '' ? $q->where('price', '<=', $v) : $q;
    }

    function scopeSortBy($q, $c, $d) {
        $c = in_array($c, ['name', 'price', 'created_at']) ? $c : 'created_at';
        $d = $d === 'asc' ? 'asc' : 'desc';
        return $q->orderBy($c, $d);
    }
}