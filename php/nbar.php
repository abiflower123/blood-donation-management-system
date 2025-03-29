<?php
// Start session for logged-in donor
session_start();

// Check if user is logged in and has a valid donor ID
if (!isset($_SESSION['username'])) {
    die("User not logged in. Please log in to view notifications.");
}

$donor_id = $_SESSION['username']; // Assumes the donor's ID is stored in the session after login

// Database connection (ensure $conn is properly defined and connected)
$host = "localhost";
$username = "root";
$password = "";
$database = "mini";
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Query to fetch notifications for the logged-in donor
$query = "SELECT * FROM notifications WHERE donar_id = '$donor_id' AND status = 'unread'";
$result = $conn->query($query);

// Check if the query execution was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

echo "<h2>Your Notifications</h2>";

// Display notifications if available
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row['message'] . " (Received on: " . $row['date_created'] . ")</p>";
    }

    // Mark notifications as read after displaying them
    $update_status = "UPDATE notifications SET status = 'read' WHERE donor_id = '$donor_id' AND status = 'unread'";
    if (!$conn->query($update_status)) {
        echo "Error updating notification status: " . $conn->error;
    }
} else {
    echo "<p>No new notifications.</p>";
}

// Close the database connection
$conn->close();
?>