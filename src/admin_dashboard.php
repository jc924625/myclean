<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Fetch all users
$users_sql = "SELECT * FROM users";
$users_result = $conn->query($users_sql);

// Fetch all bookings
$bookings_sql = "SELECT * FROM bookings";
$bookings_result = $conn->query($bookings_sql);
?>

<h2>Admin Dashboard</h2>
<p>Welcome, Admin!</p>

<h3>All Users</h3>
<table border="1">
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    <?php while($user = $users_result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $user['user_id']; ?></td>
        <td><?php echo htmlspecialchars($user['name']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td><?php echo $user['role']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<h3>All Bookings</h3>
<table border="1">
    <tr>
        <th>Booking ID</th>
        <th>Customer ID</th>
        <th>Provider ID</th>
        <th>Date/Time</th>
        <th>Status</th>
    </tr>
    <?php while($booking = $bookings_result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $booking['booking_id']; ?></td>
        <td><?php echo $booking['user_id']; ?></td>
        <td><?php echo $booking['provider_id']; ?></td>
        <td><?php echo $booking['booking_date']; ?></td>
        <td><?php echo $booking['status']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="logout.php">Logout</a>
