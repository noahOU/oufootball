<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OU Football Roster</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="images/helmet.png">
</head>
<body>
    <?php require 'navbar.php'; ?>

    <main class="container my-5">
        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-{$_SESSION['message_type']} alert-dismissible fade show' role='alert'>
                     {$_SESSION['message']}
                     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>";
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center">Team Roster</h2>
            <a href="add-player.php" class="btn btn-success">Add Player</a>
        </div>
        <div class="row">
            <?php
            require 'util-db.php';
            $conn = get_db_connection();

            $limit = 6; // Players per page
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $offset = ($page - 1) * $limit;

            $sql = "SELECT * FROM players LIMIT $limit OFFSET $offset";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='col-md-4'>
                        <div class='card shadow-sm player-card mb-4' data-player-id='{$row['id']}'>
                            <img src='{$row['photo_url']}' class='card-img-top' alt='{$row['name']}'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['name']}</h5>
                                <p class='card-text'>
                                    Position: {$row['position']}<br>
                                    Height: {$row['height']}<br>
                                    Weight: {$row['weight']}
                                </p>
                                <a href='edit-player.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete-player.php?id={$row['id']}' 
                                   class='btn btn-danger btn-sm'
                                   onclick=\"return confirm('Are you sure you want to delete {$row['name']}?');\">
                                   Delete
                                </a>
                            </div>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<p class='text-center'>No players found!</p>";
            }

            // Pagination
            $result = $conn->query("SELECT COUNT(*) AS total FROM players");
            $total = $result->fetch_assoc()['total'];
            $total_pages = ceil($total / $limit);

            echo '<nav><ul class="pagination justify-content-center">';
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = $i == $page ? 'active' : '';
                echo "<li class='page-item $active'><a class='page-link' href='roster.php?page=$i'>$i</a></li>";
            }
            echo '</ul></nav>';

            $conn->close();
            ?>
        </div>
    </main>

    <?php require 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
