<?php

// Represents the shopping cart for a single session.

class ShoppingCart {
	
    // List of products that is used to generate the HTML menu.
    public static $cookieTypes = Array("thinmints" => "Thin Mints",
                                       "samoas" => "Samoas",
                                       "trefoils" => "Trefoils",
                                       "lemoncreme" => "Lemon Chalet Cremes",
                                       "dosidos" => "Do-Si-Dos",
                                       "dulce" => "Dulce de Leche",
                                       "thanks" => "Thank U Berry Munch",
                                       "tagalongs" => "Tagalongs"
                                       );
	
    // The array that contains the order
    private $order;
	
    // Initially, the cart is empty
    public function __construct() {
        $this->order = Array();
    }
	
    // Adds an order to the shopping cart.  
    public function order($variety, $quantity) {
        $currentQuantity = $this->order[$variety];
        $currentQuantity += $quantity;
        $this->order[$variety] = $currentQuantity;
    }
	
  // functions to change the order amount 
    public function increase ($cookieName) {
        $num = $this->order[$cookieName];
        $this->order[$cookieName] = $num + 1;
    }

  // functions to change the order amount 
    public function decrease ($cookieName) {
        $num = $this->order[$cookieName];
        $this->order[$cookieName] = $num - 1;
    }

  // functions to change the order amount 
    public function clear ($cookieName) {
        $this->order[$cookieName] = 0;
    }
    // Display the order for purchasing.
    public function display() {
        $cookies = Array ('thinmints', 'samoas', 'trefoils', 'lemoncreme', 'dosidos', 'dulce', 'thanks', 'tagalongs');

        $arrlength = count($cookies);
              
        // making this a form so the buttons can update the page
        echo "<form method='post'>  ";
        echo "<table>";

        // loops through all cookies bought to put them in the table with buttons 
        for($x = 0; $x < $arrlength; $x++) {

            $acookie = self::$cookieTypes[$cookies[$x]];
            $toPrint = array_key_exists($cookies[$x], $this->order) ? $this->order[$cookies[$x]] : null;

            if ($toPrint > 0){

              echo "</tr>";
              echo "<td>". "Cookie:  $acookie </td>";
              echo "<td>" . "Quantity: $toPrint </td>";
              echo "<td> <button type='submit' name=' " .  $acookie ."_plus'> (+)</button></td>";
              echo "<td> <button type='submit' name=' " .$acookie .  "_minus'> (-) </button></td>";
              echo "<td> <button type='submit' name=' " . $acookie . "_clear'> (clear all) </button></td>";
              echo "</tr>";


            }
        }
        echo "</table> </form>";
 

    }

    public function passCookies() {
        $toReturn = $this->order;
        return ($toReturn);

    }

    // for the checkout page - displays what you bought
    public function displayCheckout() {
        $cookies = Array ('thinmints', 'samoas', 'trefoils', 'lemoncreme', 'dosidos', 'dulce', 'thanks', 'tagalongs');

        $arrlength = count($cookies);
                 
        echo "<table>";

        for($x = 0; $x < $arrlength; $x++) {

            $acookie = self::$cookieTypes[$cookies[$x]];
            $toPrint = array_key_exists($cookies[$x], $this->order) ? $this->order[$cookies[$x]] : null;

            if ($toPrint > 0){

              echo "</tr>";
              echo "<td>". "Cookie: " . $acookie ."</td>";
              echo "<td>" . "Quantity: " . $toPrint ."</td>";
              echo "</tr>";
            }
        }
        echo "</table>";     

    }
}

?>

