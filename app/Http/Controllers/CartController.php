<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
  public function add() 
  {
    $product_id = request('product_id');
    $quantity_selected = request('quantity_selected');

    Cart::add($product_id, $quantity_selected);

    return redirect('/');
  }

  public function index() 
  {
    $cart = Cart::retrieve();
    $products = $cart['products'];
    $cartTotal = $cart['total'];

    return view('cart.index', [
      'products' => $products,
      'cartTotal' => $cartTotal
    ]);
  }
}
