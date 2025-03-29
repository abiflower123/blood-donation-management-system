<?php
session_start();
if (!isset($_SESSION['username'])) {
  // Redirect to login page if user is not logged in
  header("Location: login.html");
  exit();
}

$username = $_SESSION['username'];

// Fetch user profile data from the database
$conn = new mysqli("localhost", "root", "", "mini");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM register WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>My Profile</h1>
    <nav>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="donordash.php">Donar Dashboard</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section>
      <h2>Your Profile Information</h2>
      <p>Username: <?php echo $user['username']; ?></p>
      <p>Place: <?php echo $user['place']; ?></p>
      <p>Email: <?php echo $user['email']; ?></p>
      <p>Phone: <?php echo $user['phoneno']; ?></p>
      <a href="update_profile.php">Update Profile</a>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 Blood Donation Management System. All Rights Reserved.</p>
  </footer>
</body>
</html>