<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'provider') {
    header('Location: login.php');
    exit();
}

$provider_id = $_SESSION['user_id'];

// Handle Accept/Reject Actions
if (isset($_GET['action']) && isset($_GET['booking_id'])) {
    $action = $_GET['action'];
    $booking_id = $_GET['booking_id'];
    
    if ($action == 'accept') {
        $status = 'accepted';
    } elseif ($action == 'reject') {
        $status = 'rejected';
    }

    $sql = "UPDATE bookings SET status='$status' WHERE booking_id='$booking_id' AND provider_id='$provider_id'";
    $conn->query($sql);
}

// Fetch Provider's Bookings
$sql = "SELECT * FROM bookings WHERE provider_id='$provider_id'";
$result = $conn->query($sql);
?>

<h2>Provider Dashboard</h2>
<p>Welcome, Provider!</p>

<h3>Your Bookings</h3>
<table border="1">
    <tr>
        <th>Booking ID</th>
        <th>Customer ID</th>
        <th>Date/Time</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['booking_id']; ?></td>
        <td><?php echo $row['user_id']; ?></td>
        <td><?php echo $row['booking_date']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
            <?php if ($row['status'] == 'pending'): ?>
                <a href="?action=accept&booking_id=<?php echo $row['booking_id']; ?>">Accept</a> |
                <a href="?action=reject&booking_id=<?php echo $row['booking_id']; ?>">Reject</a>
            <?php else: ?>
                No actions available
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<br>
<a href="logout.php">Logout</a>
