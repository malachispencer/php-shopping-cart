<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    public static function add($product_id, $quantity_selected) {
      if (DB::table('cart')->where('product_id', $product_id)->exists()) {
        DB::table('cart')
          ->where('product_id', $product_id)
          ->increment('quantity', $quantity_selected);
      } else {
        DB::table('cart')->insert([
          'product_id' => $product_id,
          'quantity' => $quantity_selected
        ]);
      }

      DB::table('products')
          ->where('id', $product_id)
          ->decrement('in_stock', $quantity_selected);
    }

    protected static function items_count() {
      return DB::table('cart')->count();
    }
}
