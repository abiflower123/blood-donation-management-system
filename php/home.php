<?php
session_start();
if(!isset($_SESSION['username']))
{
  header("Location:login.php");
  exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Welcome to Blood Donation Management System</h1>
    <nav>
      <ul>
        <li><a href="donordash.php">Donor Dashboard</a></li>
        
        <li><a href="search.php">Search Donors</a></li>
        <li><a href="nbar.php">Notification </a></li>
        <li><a href="myprofile.php">My Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="welcome">
      <h2>Welcome <?php 
        echo $_SESSION['username']; 
    ?></h2>
      <p>Thank you for being a part of the Blood Donation Management System. Choose an action from the menu above.</p>
    </section>

    <section id="features">
      <h2>Features</h2>
      <ul>
        <li><strong>For Donors:</strong> Update your details, check notifications, and manage your account.</li>
        <li><strong>For Recipients:</strong> Search for nearby donors based on blood group and location.</li>
        <li><strong>Notifications:</strong> Receive updates about requests and approvals.</li>
      </ul>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 Blood Donation Management System. All Rights Reserved.</p>
  </footer>
</body>
</html>