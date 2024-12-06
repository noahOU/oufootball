<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OU Football Schedule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="images/helmet.png">
</head>
<body>
    <?php require 'navbar.php'; ?>


    <main class="container my-5">
        <h2 class="text-center">Game Schedule</h2>
        <table class="table table-striped table-bordered">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Date</th>
                    <th>Opponent</th>
                    <th>Location</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'util-db.php';
                $conn = get_db_connection();

                if ($conn) {
                    $sql = "SELECT * FROM games ORDER BY date ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>" . date("F j, Y", strtotime($row['date'])) . "</td>
                                <td>{$row['opponent']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['result']}</td>
                            </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No games scheduled!</td></tr>";
                    }

                    $conn->close();
                } else {
                    echo "<tr><td colspan='4' class='text-center text-danger'>Failed to connect to the database.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 OU Football Team Hub | All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
