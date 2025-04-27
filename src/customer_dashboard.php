<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit();
}

// Fetch all service providers
$providers = [];
$sql = "SELECT * FROM users WHERE role='provider'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $providers[] = $row;
    }
}

// Handle booking form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $provider_id = $_POST['provider_id'];
    $booking_date = $_POST['booking_date'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO bookings (user_id, provider_id, booking_date, status) 
            VALUES ('$user_id', '$provider_id', '$booking_date', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Customer Dashboard</h2>
<p>Welcome, Customer!</p>

<h3>Book a Cleaner</h3>
<form method="POST">
    Select Cleaner:
    <select name="provider_id" required>
        <?php foreach ($providers as $provider): ?>
            <option value="<?php echo $provider['user_id']; ?>">
                <?php echo htmlspecialchars($provider['name']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    Select Date and Time:
    <input type="datetime-local" name="booking_date" required><br><br>

    <input type="submit" value="Book Cleaner">
</form>

<br>
<a href="logout.php">Logout</a>
