<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. <a href='login.php'>Login Here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Register</h2>
<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Role:
    <select name="role" required>
        <option value="customer">Customer</option>
        <option value="provider">Service Provider</option>
    </select><br><br>
    <input type="submit" value="Register">
</form>
