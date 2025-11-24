<?php
include '../includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Eyentech Admin</title>
</head>
<body>
<div class="container">
    <h2>Eyentech Admin Panel</h2>

    <a href="add_product.php" class="btn">+ Add New Product</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price ($)</th>
            <th>Category</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>

        <?php
        $sql = "SELECT * FROM products ORDER BY id DESC";
        $res = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($res)):
        ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['price']; ?></td>
            <td><?= $row['category']; ?></td>
            <td><img src="../assets/images/<?= $row['image']; ?>" width="60"></td>

            <td>
                <a class="btn" href="edit_product.php?id=<?= $row['id']; ?>">Edit</a>
                <a class="btn" style="background:#c62828" href="delete_product.php?id=<?= $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
</div>
</body>
</html>
