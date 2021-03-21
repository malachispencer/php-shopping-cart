<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
</head>
<body>
  <h1>Products</h1>

  <a href="/cart" style="text-decoration:none">Cart ({{ $items_in_cart }})</a>
  <br>
  <br>

  @foreach($products as $product)
    <div>
      {{ $product->name }}
    </div>
    <div>
      {{ "£{$product->price}" }}
    </div>
    @if ($product->in_stock)
      <form action="/cart" method="POST">
        @csrf
        <select name="quantity_selected">
          @for($i = 1; $i <= $product->in_stock; $i++) {
            <option value="<?php echo $i ?>">{{ $i }}</option>
          }
          @endfor
        </select>
        <input type="hidden" name="product_id" value="<?php echo $product->id ?>">
        <input type="submit" value="Add To Cart">
      </form>
    @else
      <div>
        Currently out of stock
      </div>
    @endif
    <br>
  @endforeach
</body>
</html>