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

  <a href="/cart">View Cart</a>
  <br>
  <br>

  @foreach($products as $product)
    <div>
      {{ $product->name }}
    </div>
    <div>
      {{ "£{$product->price}" }}
    </div>
    <form action="/cart" method="POST">
      <select name="quantity">
        @for($i = 1; $i <= $product->in_stock; $i++) {
          <option value="<?php echo $i ?>">{{ $i }}</option>
        }
        @endfor
      </select>
      <input type="hidden" value="<?php echo $product->id ?>">
      <input type="submit" value="Add To Cart">
      </form>
    <br>
  @endforeach
</body>
</html>