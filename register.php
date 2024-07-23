<?php
// Connect to database (replace with your database credentials)
$pdo = new PDO('mysql:host=localhost;dbname=tours_and_travels', 'username', 'password');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    // Redirect to login page
    header('Location: login.php');
    exit();
}
?>

<!-- HTML form for user registration -->
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required><br><br>
    
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    
    <input type="submit" value="Register">
</form>
