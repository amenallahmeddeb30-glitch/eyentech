<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);
?>

<h2><?php echo $product['name']; ?></h2>
<img src="assets/images/<?php echo $product['image']; ?>" width="250">
<p><?php echo $product['description']; ?></p>
<h3><?php echo $product['price']; ?>TND</h3>

<a href="cart.php?action=add&id=<?php echo $product['id']; ?>">Add to Cart</a>

<?php include 'includes/footer.php'; ?>
