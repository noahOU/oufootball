<?php
require 'util-db.php';

header('Content-Type: application/json');
$response = ['success' => false];

$conn = get_db_connection();
if ($conn && isset($_GET['id']) && isset($_GET['type'])) {
    $id = intval($_GET['id']);
    $type = ($_GET['type'] === 'like') ? 'likes' : 'dislikes';

    // Increment likes or dislikes
    $sql = "UPDATE transfer_portal SET $type = $type + 1 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Fetch updated count
        $result = $conn->query("SELECT $type FROM transfer_portal WHERE id = $id");
        if ($result->num_rows > 0) {
            $new_count = $result->fetch_assoc()[$type];
            $response['success'] = true;
            $response[$type] = $new_count;
        }
    }

    $conn->close();
}

echo json_encode($response);
?>
