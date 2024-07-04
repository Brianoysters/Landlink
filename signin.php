<?php
$servername = "127.0.0.1.3307";
$username = "root";
$password = "";
$dbname = "landlink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];

    $sql = "SELECT * FROM users WHERE username='$login_username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $row = $result->fetch_assoc();
        if (password_verify($login_password, $row['password'])) {
            echo "Login successful";
            // Redirect to user dashboard or home page
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that username";
    }
}

$conn->close();
?>
