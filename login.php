<?php
session_start();
// Connect to database (replace with your database credentials)
$pdo = new PDO('mysql:host=localhost;dbname=tours_and_travels', 'username', 'password');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to dashboard or home page
        header('Location: index.php');
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!-- HTML form for user login -->
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required><br><br>
    
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    
    <input type="submit" value="Login">
</form>
