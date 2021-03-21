<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
</head>
<body>
  <h1>Cart</h1>

  <a style="text-decoration: none;" href="/">Products</a>
  <br>

  <h4>You have {{ $itemsInCart }} items in your cart.</h4>

  @foreach($products as $product)
    <div>
      Item: {{ $product->name }}
    </div>
    <div>
      Price: £{{ $product->price }}
    </div>
    <div>
      Quantity: {{ $product->quantity }}
    </div>
    <div>
    Subtotal: £{{ $product->subtotal }}
    </div>
    <form action="/cart" method="PATCH">
      @csrf
      <select name="quantity_selected" id="qty-drop-down-<?php echo $product->id ?>">
        @for($i = 0; $i <= $product->in_stock; $i++) {
          <option value="<?php echo $i ?>">{{ $i }}</option>
        }
        @endfor
      </select>
      <input type="hidden" name="product_id" value="<?php echo $product->id ?>">
      <input type="submit" value="Edit Qty">
    </form>
    <br>

    <script>
      var qtyDropDown = document.getElementById(
        'qty-drop-down-<?php echo $product->id ?>'
      );
      
      qtyDropDown[<?php echo $product->quantity ?>].selected = true;
    </script>
  @endforeach

  <h4>Total: £{{ $cartTotal }}</h4>
</body>
</html>