<?php
require 'util-db.php';

$conn = get_db_connection();

if ($conn && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM players WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: roster.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Failed to connect to the database or invalid request.";
}
?>
