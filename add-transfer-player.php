<?php
require 'util-db.php';
session_start();

$conn = get_db_connection();
if ($conn && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);

    $sql = "INSERT INTO transfer_portal (name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = 'Player added successfully!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error adding player: ' . $conn->error;
        $_SESSION['message_type'] = 'danger';
    }

    $conn->close();
    header('Location: transfer-portal.php');
    exit();
} else {
    echo "Invalid request or failed to connect to the database.";
}
?>
