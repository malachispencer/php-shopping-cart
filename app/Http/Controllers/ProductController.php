<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
      $products = Product::retrieve_all();
      $items_in_cart = $this->items_in_cart;

      return view('products.index', [
        'products' => $products,
        'items_in_cart' => $items_in_cart
        ]);
    }
}
