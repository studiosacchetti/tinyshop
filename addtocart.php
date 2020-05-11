<?php

session_start();
if (isset($_GET) & !empty($_GET)) {
    $id = $_GET['id'];
    if (isset($_GET['quant']) & !empty($_GET['quant'])) {
        $quant = $_GET['quant'];
    } else {
        $quant = 1;
    }
    if ($_SESSION['cart'][$id]) {
        $quant = $quant + $_SESSION['cart'][$id]['quantity'];
    }

    $_SESSION['cart'][$id] = array("quantity" => $quant);
    // header('location: cart.php');
    header("location: " . $_SERVER["HTTP_REFERER"]);    // stay in page while adding products into cart
} else {
    // header('location: cart.php');
    header("location: " . $_SERVER["HTTP_REFERER"]);
}
/* echo "<pre>";
  print_r($_SESSION['cart']);
  echo "</pre>"; */
?>