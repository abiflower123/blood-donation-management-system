<?php
session_start();

// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "mini";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($username) && !empty($password)) {
    // SQL query to fetch user data
    $sql = "SELECT * FROM register WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching record is found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];

        // Redirect to a dashboard or success page
        echo "Login successful! Welcome, " . $user['username'];
        header("Location:home.php");
    }
    
        else {
        echo "Invalid username or password.";
    }

    $stmt->close();
} else {
    echo "Username and password are required.";
}

$conn->close();
?>