# PHP Shopping Cart

Simple shopping cart where the user can add items to the shopping cart, view the shopping cart, update the quantities selected and remove an item from the shopping cart altogether. 

The quantity of product that one can add to the cart is based on how much of that product is in stock, which is tracked in the database. With each addition or subtraction to the quantity of an item in the cart, both the product in stock quantity and product quantity in the cart are updated synergistically.

When the user selects to add the entire stock of a product to the cart, subsequently that product will display as out of stock and will not provide the option to be added to the cart - until the user goes to the cart and lowers the cart quantity.

## Technologies Used

PHP, Laravel, SQL, Blade and JavaScript.