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
    $itemsInCart = $this->items_in_cart;

    return view('cart.index', [
      'products' => $products,
      'cartTotal' => $cartTotal,
      'itemsInCart' => $itemsInCart
    ]);
  }

  public function amend()
  {
    $product_id = request('product_id');
    $current_quantity = request('current_quantity');
    $new_quantity = request('new_quantity');

    Cart::amend($product_id, $current_quantity, $new_quantity);

    return redirect('/cart');
  }
}
