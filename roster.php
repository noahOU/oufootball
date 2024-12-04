<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OU Football Roster</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php require 'navbar.php'; ?>

    <main class="container my-5">
        <h2 class="text-center">Team Roster</h2>
        <div class="row" id="roster">
            <?php
            require 'util-db.php';
            $conn = get_db_connection();

            if ($conn) {
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
                    echo "<p class='text-center'>No players found!</p>";
                }

                $conn->close();
            } else {
                echo "<p class='text-center text-danger'>Failed to connect to the database.</p>";
            }
            ?>
        </div>
    </main>
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 OU Football Team Hub | All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>