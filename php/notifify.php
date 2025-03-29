<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "mini";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get search input from the recipient
    $required_blood_group = mysqli_real_escape_string($conn, $_POST['blood']);
    $required_location = mysqli_real_escape_string($conn, $_POST['place']);
    $message = "Urgent: $required_blood_group blood required in $required_location. Please donate if available.";

    // Query to find matching donors
    $query = "SELECT * FROM register WHERE blood = '$required_blood_group' AND place = '$required_location'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $donor_id = $row['id'];

            // Insert notification into the notifications table
            $insert_notification = "INSERT INTO notifications (donor_id, message) 
                                     VALUES ('$donor_id', '$message')";
            if ($conn->query($insert_notification)) {
                echo "Notification sent to donor: " . $row['usernamename'] . "<br>";
            } else {
                echo "Error sending notification to donor: " . $row['username'] . "<br>";
            }
        }
    } else {
        echo "No matching donors found.";
    }
}
?>