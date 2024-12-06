<?php
require 'util-db.php';
session_start();

$conn = get_db_connection();
if ($conn && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM players WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = 'Player deleted successfully!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error deleting player: ' . $conn->error;
        $_SESSION['message_type'] = 'danger';
    }

    $conn->close();
    header('Location: roster.php');
    exit();
} else {
    echo "Failed to connect to the database or invalid request.";
}
?>
