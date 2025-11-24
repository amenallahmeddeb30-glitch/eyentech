<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if(isset($_GET['action']) && $_GET['action'] == "add"){
    $id = $_GET['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

echo "<h2>Your Cart</h2>";

if(empty($_SESSION['cart'])){
    echo "<p>Cart is empty.</p>";
} else {
    foreach($_SESSION['cart'] as $id => $qty){
        $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
        $product = mysqli_fetch_assoc($result);

        echo "<p>{$product['name']} — Qty: $qty — $" . ($product['price'] * $qty) . "</p>";
    }
}

echo '<a href="checkout.php">Proceed to Checkout</a>';

include 'includes/footer.php';
?>
