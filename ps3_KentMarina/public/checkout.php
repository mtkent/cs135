<!-- Marina Kent -->
<?php 
require "../application/cart.php";
include('../dbconn.php');

session_start(); 


?>

<!DOCTYPE html>

<?php 
// If this session is just beginning, store an empty ShoppingCart in it.
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new ShoppingCart();
}
?>

<html lang="en">

<head>
<title>Checkout</title>
</head>

<body>

<h2>Checkout</h2>

<?php

// define variables and set to empty values
$nameErr = $cityErr = $streetErr = $zipErr = $stateErr = $snameErr = $troopErr =  "";
$name = $city = $street = $zip = $state = $sname = $troop = "";

// form validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["street"])) {
    $streetErr = "Street is required";
  } else {
    $street = test_input($_POST["street"]);
    // check if address is correct
    if (!preg_match("/^[a-zA-Z ]*$/",$street)) {
      $streetErr = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["city"])) {
    $cityErr = "City is required";
  } else {
    $city = test_input($_POST["city"]);
    // check if address is correct
    if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
      $cityErr = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["zip"])) {
    $zipErr = "zip is required";
  } else {
    $zip = test_input($_POST["zip"]);
    // check if address is correct
    if (!preg_match("/(^\d{5}$)/",$zip)) {
      $zipErr = "Must be 5 numbers"; 
    }
  }
  if (empty($_POST["state"])) {
    $stateErr = "State is required";
  } else {
    $state = test_input($_POST["state"]);
    // check if address is correct
    if (!preg_match("/^[a-zA-Z ]*$/",$state)) {
      $stateErr = "Only letters and white space allowed"; 
    }
  }


  if (empty($_POST["sname"])) {
    $snameErr = "Scout name is required";
  } else {
    $sname = test_input($_POST["sname"]);
    // check if address is correct
    if (!preg_match("/^[a-zA-Z ]*$/",$sname)) {
      $snameErr = "Only letters and white space allowed"; 
    }
  }
  if (empty($_POST["troop"])) {
    $troopErr = "State is required";
  } else {
    $troop = test_input($_POST["troop"]);
    // check if address is correct
    if (!preg_match("/^[a-zA-Z ]*$/",$troop)) {
      $troopErr = "Only letters and white space allowed"; 
    }
  }

}

// functions to look for characters - not currently used
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// looks for the right customer name
function checkName($aname)
{
    $dbc  = connect_to_db( "GSC" );      

    $query = "SELECT cid FROM Customer WHERE name= '" . $aname . "'";
    $result = perform_query($dbc, $query);
    $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );

    return ($row);
    
}

// looks for the right girl scout name
function checkGSName($asname)
{
    $dbc  = connect_to_db( "GSC" );      

    $query = "SELECT gsid FROM GirlScouts WHERE name= '" . $asname . "'";
    $result = perform_query($dbc, $query);
    $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );

    return ($row);
    
}
?>

<!-- the form to be filled out -->
<h2>Please fill out this form: </h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Street: <input type="text" name="street" value="<?php echo $street;?>">
  <span class="error">* <?php echo $streetErr;?></span>
  <br><br>
  City: <input type="text" name="city" value="<?php echo $city;?>">
  <span class="error">* <?php echo $cityErr;?></span>
  <br><br>
  State: <input type="text" name="state" value="<?php echo $state;?>">
  <span class="error">* <?php echo $stateErr;?></span>
  <br><br>
  Zip: <input type="text" name="zip" value="<?php echo $zip;?>">
  <span class="error">* <?php echo $zipErr;?></span>
  <br><br>
  Scout Name: <input type="text" name="sname" value="<?php echo $sname;?>">
  <span class="error">* <?php echo $snameErr;?></span>
  <br><br>
  Troop: <input type="text" name="troop" value="<?php echo $troop;?>">
  <span class="error">* <?php echo $troopErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  

</form>

<!-- displays the order -->
<p>Here is your order: <?php
$_SESSION['cart']->displayCheckout();

?></p>

<p>Your credit card will be billed.  Thanks for the order!</p>

<p><a href="index4.php">Shop some more!</a></p>

<?php
  // get the cart items
  $cookieArr = ($_SESSION['cart']->passCookies());

  $savecookies = $cookieArr;

// have to give the session this array so it knows the order on the next page
  if (!isset($_SESSION['cookieArr'])) {
    $_SESSION['cookieArr'] = $cookieArr;
  }


    // if the form is submitted:
    if(sizeof($_POST) > 0){
      // set variables 
  	  $aname = $_POST['name'];
  	  $astreet = $_POST['street'];
  	  $acity = $_POST['city'];
  	  $astate = $_POST['state'];
  	  $azip = $_POST['zip'];
  	  $asname = $_POST['sname'];
  	  $atroop = $_POST['troop'];

      // connect to the database 
      $dbc    = connect_to_db( "GSC" );                                     

      // various queries for updating the database
      // adding a customer
      $query = "INSERT INTO Customer (name, street, city, state, zip) VALUES(?, ?, ?, ?, ?)";
      $customerInsert = $dbc->prepare($query);
      $customerInsert->bind_param("ssssi", $aname, $astreet, $acity, $astate, $azip);

      // adding a girl scout
      $query = "INSERT INTO GirlScouts (name, troop) VALUES (?, ?)";
      $girlScoutInsert = $dbc->prepare($query);
      $girlScoutInsert->bind_param("ss", $asname, $atroop);

      // if customer exists, do not add again
      if (checkName($aname)) {
        $query = "SELECT cid FROM Customer WHERE name = '". $aname . "'";
        $result = perform_query($dbc, $query);
        $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );
        $cid = $row['cid'];

        echo "You're a returning customer! Your customer ID is: " . $cid;

      } else {
        echo "You're new!";
        mysqli_stmt_execute($customerInsert);  
        $query = "SELECT cid FROM Customer WHERE name = '". $aname . "'";
        $result = perform_query($dbc, $query);
        $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );
        $cid = $row['cid'];
        mysqli_stmt_close($customerInsert);

      }

      // if girl scout exists, do not add again
      if (checkGSName($asname)) {
        $query = "SELECT gsid FROM GirlScouts WHERE name = '". $asname . "'";
        $result = perform_query($dbc, $query);
        $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );
        $gsid = $row['gsid'];

      } else {
        mysqli_stmt_execute($girlScoutInsert);
        $query = "SELECT gsid FROM GirlScouts WHERE name = '". $asname . "'";
        $result = perform_query($dbc, $query);
        $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );
        $gsid = $row['gsid'];
        mysqli_stmt_close($girlScoutInsert);

      }

      // update the order table
      $query = "INSERT INTO Orders (gsid, cid) VALUES (?, ?)";
      $orderInsert = $dbc->prepare($query);
      $orderInsert->bind_param("ii", $gsid, $cid);


      mysqli_stmt_execute($orderInsert);                    
      mysqli_stmt_close($orderInsert);


      // update the cookie table
      $cookieArr = $_SESSION['cookieArr'];
      $query = "INSERT INTO Cookies (type, quantity, cookieOrderID) VALUES (?,?,?)";
      $cookieInsert = $dbc->prepare($query);
      $cookieInsert->bind_param("sii", $type, $quantity, $cookieOrderID);
      $arrlength = count($cookieArr);

      $query = "SELECT orderID FROM Orders ORDER BY orderID DESC LIMIT 1";   // not working on new orders
      $result = perform_query($dbc, $query);
      $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );
      $cookieOrderID = $row['orderID'];
      echo " Your order ID is " . $cookieOrderID;

      foreach($cookieArr as $key => $value) {    
          $type = $key;
          $quantity = $value;
          mysqli_stmt_execute($cookieInsert);
      }

      mysqli_stmt_close($cookieInsert);

      session_unset();  // remove all session variables
      session_destroy();
	  }

?>

</body>

</html>