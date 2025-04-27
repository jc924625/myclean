<?php
include 'db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'customer') {
                header('Location: customer_dashboard.php');
            } elseif ($row['role'] == 'provider') {
                header('Location: provider_dashboard.php');
            } elseif ($row['role'] == 'admin') {
                header('Location: admin_dashboard.php');
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }
}
?>

<h2>Login</h2>
<form method="POST">
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
