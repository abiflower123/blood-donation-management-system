<!DOCTYPE html>
<html>
<head>
    <title>Search Donor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <header>
    <h1>Search Donar</h1>
    <nav>
      <ul>
      <li><a href="home.php">Home</a></li>
        <li><a href="donordash.php">Donor Dashboard</a></li>
        
        <li><a href="myprofile.php">Myprofile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

    <form method="POST" action="">
        <br>
        <label>Enter Blood Group:</label>
        <input type="text" name="blood" required>
        <button type="submit" name="search">Search</button>
    </form>

    <?php

$conn = new mysqli("localhost", "root", "", "mini");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
    if (isset($_POST['search'])) {
        $blood = $_POST['blood'];
        $query = "SELECT * FROM register WHERE blood='$blood'";
        $result = $conn->query($query);

        echo "<h2>Results:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['phoneno'] . "</td>
                  </tr>";
        }
        echo "</table>";
    }
    $conn->close();
    ?>
</body>
</html>