<?php
include '../includes/db.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($query);

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    if ($_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../assets/images/$image");
    } else {
        $image = $product['image'];
    }

    $sql = "UPDATE products SET 
            name='$name',
            description='$desc',
            price='$price',
            category='$category',
            image='$image'
            WHERE id=$id";

    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?= $product['name']; ?>" required>
        <textarea name="description" required><?= $product['description']; ?></textarea>
        <input type="number" name="price" value="<?= $product['price']; ?>" required>

        <select name="category" required>
            <option <?= $product['category']=="Smartphones"?"selected":""; ?>>Smartphones</option>
            <option <?= $product['category']=="Laptops"?"selected":""; ?>>Laptops</option>
            <option <?= $product['category']=="Audio"?"selected":""; ?>>Audio</option>
            <option <?= $product['category']=="Wearables"?"selected":""; ?>>Wearables</option>
            <option <?= $product['category']=="Tablets"?"selected":""; ?>>Tablets</option>
            <option <?= $product['category']=="Accessories"?"selected":""; ?>>Accessories</option>
        </select>

        <p>Current image:</p>
        <img src="../assets/images/<?= $product['image']; ?>" width="120"><br><br>

        <input type="file" name="image">

        <button name="edit">Save Changes</button>
    </form>
</div>
</body>
</html>
