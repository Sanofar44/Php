<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
$pdo = new PDO('mysql:host=localhost;dbname=tours_and_travels', 'username', 'password');

// Fetch all tour packages
$stmt = $pdo->query("SELECT * FROM tour_packages");
$tour_packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Display tour packages in admin panel -->
<h2>Tour Packages</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php foreach ($tour_packages as $package): ?>
    <tr>
        <td><?php echo $package['id']; ?></td>
        <td><?php echo $package['name']; ?></td>
        <td><?php echo $package['description']; ?></td>
        <td><?php echo $package['price']; ?></td>
        <td>
            <a href="edit_package.php?id=<?php echo $package['id']; ?>">Edit</a> | 
            <a href="delete_package.php?id=<?php echo $package['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- Add new tour package form -->
<h2>Add New Tour Package</h2>
<form method="POST" action="add_package.php">
    <label>Name:</label>
    <input type="text" name="name" required><br><br>
    
    <label>Description:</label>
    <textarea name="description" required></textarea><br><br>
    
    <label>Price:</label>
    <input type="number" name="price" required><br><br>
    
    <input type="submit" value="Add Package">
</form>
