<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public static function retrieve_all() 
    {
      $products = DB::table('products')
        ->orderBy('id', 'asc')
        ->get();
      
      return $products;
    }

    public static function decrement_stock($product_id, $quantity_selected)
    {
      DB::table('products')
          ->where('id', $product_id)
          ->decrement('in_stock', $quantity_selected);
    }

    public static function update_stock($product_id, $difference)
    {
      DB::table('products')
        ->where('id', $product_id)
        ->increment('in_stock', $difference);
    }
}
