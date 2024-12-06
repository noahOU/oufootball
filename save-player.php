<?php
require 'util-db.php';
session_start();

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
        $_SESSION['message'] = 'Player added successfully!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error adding player: ' . $conn->error;
        $_SESSION['message_type'] = 'danger';
    }

    $conn->close();
    header('Location: roster.php');
    exit();
} else {
    echo "Failed to connect to the database.";
}
?>
