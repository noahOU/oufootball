<?php
require 'util-db.php';

$conn = get_db_connection();

if ($conn && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);
    $number = intval($_POST['number']);
    $height = $conn->real_escape_string($_POST['height']);
    $weight = $conn->real_escape_string($_POST['weight']);
    $year = $conn->real_escape_string($_POST['year']);
    $photo_url = $conn->real_escape_string($_POST['photo_url']);

    $sql = "UPDATE players
            SET name = '$name', position = '$position', number = $number,
                height = '$height', weight = '$weight', year = '$year',
                photo_url = '$photo_url'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: roster.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request or database connection failed.";
}
?>
