<?php
// Connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "landlink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling land listing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $owner_name = $_POST['owner_name'];
    $phone_number = $_POST['phone_number'];
    $title_deed_number = $_POST['title_deed_number'];
    $search_certificate = $_POST['search_certificate'];
    $folio_registry_number = $_POST['folio_registry_number'];
    $parcel_coordinates = $_POST['parcel_coordinates'];

    // Verify folio registry number with Ardhisasa government registry database
    // Assuming we have an API or some method to verify
    $is_valid = verifyFolioRegistryNumber($folio_registry_number);

    if ($is_valid) {
        $sql = "INSERT INTO land_listings (owner_name, phone_number, title_deed_number, search_certificate, folio_registry_number, parcel_coordinates)
                VALUES ('$owner_name', '$phone_number', '$title_deed_number', '$search_certificate', '$folio_registry_number', '$parcel_coordinates')";

        if ($conn->query($sql) === TRUE) {
            echo "Land listing successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid folio registry number!";
    }
}

$conn->close();

function verifyFolioRegistryNumber($folio_registry_number) {
    // Mock verification function
    // In real implementation, this should query the Ardhisasa government registry database
    return true;
}
?>
