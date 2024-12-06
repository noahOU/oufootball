<?php
require 'util-db.php';

$conn = get_db_connection();
if ($conn) {
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);
    $number = intval($_POST['number']);
    $height = $conn->real_escape_string($_POST['height']);
    $weight = $conn->real_escape_string($_POST['weight']);
    $year = $conn->real_escape_string($_POST['year']);
    $photo_url = $conn->real_escape_string($_POST['photo_url']);

    $sql = "INSERT INTO players (name, position, number, height, weight, year, photo_url)
            VALUES ('$name', '$position', $number, '$height', '$weight', '$year', '$photo_url')";

    if ($conn->query($sql) === TRUE) {
        header('Location: roster.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Failed to connect to the database.";
}
?>
