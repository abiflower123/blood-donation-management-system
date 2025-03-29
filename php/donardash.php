<?php
session_start();
if (!isset($_SESSION['email'])) { // Assuming email is the unique identifier for login
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'mini');

// Fetch donor details from the register table
$query = "SELECT * FROM register";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donor Dashboard</title>
</head>
<body>
    <h1>Donor Dashboard</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Blood Group</th>
            <th>Contact</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['blood']; ?></td>
                <td><?php echo $row['phoneno']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>