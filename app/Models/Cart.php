<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    public static function add($product_id, $quantity_selected) {
      // error_log('MODEL, PRODUCT ID');
      // error_log($product_id);
      // error_log('MODEL, QUANTITY SELECTED');
      // error_log($quantity_selected);

      if (DB::table('cart')->where('product_id', $product_id)->exists()) {
        
      } else {
        DB::table('cart')->insert([
          'product_id' => $product_id,
          'quantity_selected' => $quantity_selected
        ]);

        error_log('INSERTED RECORDS INTO THE DATABASE');
      }
    }
}
