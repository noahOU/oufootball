<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="images/helmet.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php require 'navbar.php'; ?>

    <main class="container my-5">
        <h2 class="text-center">Transfer Portal</h2>

        <!-- Add Player Form -->
        <form action="add-transfer-player.php" method="POST" class="mb-5">
            <div class="mb-3">
                <label for="name" class="form-label">Player Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter player name" required>
            </div>
            <button type="submit" class="btn btn-success">Add Player</button>
        </form>

        <!-- Leaderboard -->
        <h3 class="text-center">Player Leaderboard</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Player Name</th>
                    <th>Likes</th>
                    <th>Dislikes</th>
                    <th>Vote</th>
                </tr>
            </thead>
            <tbody id="leaderboard">
                <?php
                require 'util-db.php';
                $conn = get_db_connection();

                $sql = "SELECT * FROM transfer_portal ORDER BY likes DESC, dislikes ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $rank = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>$rank</td>
                            <td>{$row['name']}</td>
                            <td id='likes-{$row['id']}'>{$row['likes']}</td>
                            <td id='dislikes-{$row['id']}'>{$row['dislikes']}</td>
                            <td>
                                <button class='btn btn-sm btn-success' onclick='vote({$row['id']}, \"like\")'>👍</button>
                                <button class='btn btn-sm btn-danger' onclick='vote({$row['id']}, \"dislike\")'>👎</button>
                            </td>
                        </tr>
                        ";
                        $rank++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No players in the transfer portal yet.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <?php require 'footer.php'; ?>

    <script>
    function vote(playerId, type) {
        fetch(`vote-transfer-player.php?id=${playerId}&type=${type}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`${type}s-${playerId}`).textContent = data[type];
                } else {
                    alert('Failed to register vote.');
                }
            })
            .catch(error => console.error('Error:', error));
    }
    </script>
</body>
</html>

