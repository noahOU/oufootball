<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ou_football";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM players";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='col-md-4'>
            <div class='card shadow-sm mb-4'>
                <img src='{$row['photo_url']}' class='card-img-top' alt='{$row['name']}'>
                <div class='card-body'>
                    <h5 class='card-title'>{$row['name']}</h5>
                    <p class='card-text'>Position: {$row['position']}<br>Number: {$row['number']}<br>Year: {$row['year']}</p>
                </div>
            </div>
        </div>
        ";
    }
} else {
    echo "<p>No players found!</p>";
}

$conn->close();
?>
