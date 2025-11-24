<?php
include '../includes/db.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../assets/images/$image");

    $sql = "INSERT INTO products (name, description, price, category, image)
            VALUES ('$name', '$desc', '$price', '$category', '$image')";
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
    <h2>Add Product</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="price" placeholder="Price" required>

        <select name="category" required>
            <option value="">Select Category</option>
            <option>Smartphones</option>
            <option>Laptops</option>
            <option>Audio</option>
            <option>Wearables</option>
            <option>Tablets</option>
            <option>Accessories</option>
        </select>

        <input type="file" name="image" required>

        <button name="add">Add Product</button>
    </form>
</div>
</body>
</html>
