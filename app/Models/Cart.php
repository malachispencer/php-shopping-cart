<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    public static function add($product_id, $quantity_selected) 
    {
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

      Cart::decrement_product($product_id, $quantity_selected);
    }

    public static function retrieve() 
    {
      $products = DB::table('cart')
        ->join('products', 'cart.product_id', '=', 'products.id')
        ->select(
          'products.id as id', 
          'products.name as name', 
          'products.price as price',
          'cart.quantity as quantity'
        )
        ->orderBy('cart.id', 'desc')
        ->get();
      
      $products = Cart::appendSubtotals($products);
      $cartTotal = Cart::total($products);

      $cart = [
        'products' => $products,
        'total' => $cartTotal
      ];

      return $cart;
    }

    protected static function items_count() 
    {
      return DB::table('cart')->count();
    }

    private static function decrement_stock($product_id, $quantity_selected)
    {
      DB::table('products')
          ->where('id', $product_id)
          ->decrement('in_stock', $quantity_selected);
    }

    private static function appendSubtotals($products)
    {
      return $products->map(function ($product) {
        $subtotal = Cart::productTotal($product->price, $product->quantity);
        $product->subtotal = $subtotal;
        return $product;
      });

      return $products;
    }

    private static function productTotal($price, $quantity)
    {
      $subtotal = $price * $quantity;
      $subtotal = number_format($subtotal, 2, '.', ',');
      return $subtotal;
    }

    private static function total($products)
    {
      $cartTotal = $products->reduce(function ($acc, $product) {
        $acc += ($product->price * $product->quantity);
        return $acc;
      }, 0);

      return number_format($cartTotal, 2, '.', ',');
    }
}