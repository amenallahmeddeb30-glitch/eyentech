<?php 
include 'includes/db.php'; 
include 'includes/header.php'; 

$search = $_GET['search'] ?? '';

$category = $_GET['category'] ?? '';
$limit = 6; 
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $limit;
$where = "WHERE name LIKE '%$search%'";

if ($category != '') {
    $where .= " AND category='$category'";
}
$query = "SELECT * FROM products $where LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);
$countQuery = "SELECT COUNT(*) AS total FROM products $where";
$countResult = mysqli_query($conn, $countQuery);
$total = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($total / $limit);
?>
<h2 style="margin-top: 20px;">Explore Eyentech Gadgets</h2>
<form method="GET" style="margin: 20px 0; display:flex; gap:10px;">
    <input type="text" name="search" value="<?php echo $search; ?>" 
           placeholder="Search gadgets..." 
           style="padding: 10px; width: 260px; border-radius:6px;">

    <select name="category" style="padding: 10px; border-radius:6px;">
        <option value="">All Categories</option>
        <option value="Smartphones" <?php if($category=="Smartphones") echo "selected"; ?>>Smartphones</option>
        <option value="Laptops" <?php if($category=="Laptops") echo "selected"; ?>>Laptops</option>
        <option value="Audio" <?php if($category=="Audio") echo "selected"; ?>>Audio</option>
        <option value="Wearables" <?php if($category=="Wearables") echo "selected"; ?>>Wearables</option>
        <option value="Tablets" <?php if($category=="Tablets") echo "selected"; ?>>Tablets</option>
        <option value="Accessories" <?php if($category=="Accessories") echo "selected"; ?>>Accessories</option>
    </select>

    <button type="submit" style="padding: 10px 16px;">Filter</button>
</form>
<div class="products">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="product">
            <img src="assets/images/<?php echo $row['image']; ?>" alt="">
            <h3><?php echo $row['name']; ?></h3>
            <p>$<?php echo $row['price']; ?></p>
            <a href="product.php?id=<?php echo $row['id']; ?>">View</a>
        </div>
    <?php endwhile; ?>
</div>
<div style="margin: 25px 0; text-align:center;">

    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page-1; ?>&search=<?php echo $search; ?>&category=<?php echo $category; ?>" 
            style="margin-right:15px;">⬅ Previous</a>
    <?php endif; ?>

    <strong>Page <?php echo $page; ?> of <?php echo $totalPages; ?></strong>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?php echo $page+1; ?>&search=<?php echo $search; ?>&category=<?php echo $category; ?>" 
            style="margin-left:15px;">Next ➡</a>
    <?php endif; ?>

</div>
<?php include 'includes/footer.php'; ?>
