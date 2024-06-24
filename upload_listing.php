<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "landlink";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$ownerName = $_POST['ownerName'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$titleDeedNumber = $_POST['titleDeedNumber'];
$govCert = $_POST['govCert'];

// Insert data into database
$sql = "INSERT INTO listings (owner_name, phone_number, email, title_deed_number, gov_cert) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $ownerName, $phoneNumber, $email, $titleDeedNumber, $govCert);

if ($stmt->execute()) {
    echo "Listing uploaded successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>