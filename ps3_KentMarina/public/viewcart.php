<!-- Marina Kent -->
<?php 

require "../application/cart.php";
session_start(); 

?>

<!DOCTYPE html>

<?php 

// If this session is just beginning, store an empty ShoppingCart in it.
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new ShoppingCart();
}

// update cookie number here - minus, clear, plus
if(sizeof($_POST) > 0)
{ 

	foreach($_POST as $key=>$value)
	{
	  $cookie =  $key;
	}
	// checks if these cookies exist, decides how to update
	if (strpos($cookie, 'Thin') !== false) {
   		$toChange = 'thinmints';
	}if (strpos($cookie, 'Samoas') !== false) {
   		$toChange = 'samoas';
	}if (strpos($cookie, 'Trefoils') !== false) {
   		$toChange = 'trefoils';
	}if (strpos($cookie, 'Lemon') !== false) {
   		$toChange = 'lemoncreme';
	}if (strpos($cookie, 'Do-Si-Dos') !== false) {
   		$toChange = 'dosidos';
	}if (strpos($cookie, 'Thank') !== false) {
   		$toChange = 'thanks';
	}if (strpos($cookie, 'Tag') !== false) {
   		$toChange = 'tagalongs';
	}if (strpos($cookie, 'Dulce') !== false) {
   		$toChange = 'dulce';
	}

	// will update values if needed
	if (strpos($cookie, 'minus') !== false) {
		  $_SESSION['cart']->decrease($toChange);
	}if (strpos($cookie, 'plus') !== false) {
		  $_SESSION['cart']->increase($toChange);
	}if (strpos($cookie, 'clear') !== false) {
		  $_SESSION['cart']->clear($toChange);
	}
}

?>

<html lang="en">

<head>
<title>Girl Scout Cookie Shopping Cart</title>
</head>

<body>

<h2>Girl Scout Cookie Shopping Cart</h2>

<p><?php
// Display of shopping cart
$_SESSION['cart']->display();

?></p>

<p><a href="index4.php">Resume shopping</a></p>

<p><a href="checkout.php">Check out</a></p>

</body>
</html>