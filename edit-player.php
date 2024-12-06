<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php require 'navbar.php'; ?>

    <main class="container my-5">
        <h2 class="text-center">Edit Player</h2>
        <?php
        require 'util-db.php';
        $conn = get_db_connection();

        if ($conn && isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM players WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $player = $result->fetch_assoc();
            } else {
                echo "<p class='text-danger text-center'>Player not found!</p>";
                exit();
            }
            $conn->close();
        } else {
            echo "<p class='text-danger text-center'>Failed to connect to the database or invalid request!</p>";
            exit();
        }
        ?>

        <form action="update-player.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $player['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position" value="<?php echo $player['position']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Number</label>
                <input type="number" class="form-control" id="number" name="number" value="<?php echo $player['number']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="height" class="form-label">Height</label>
                <input type="text" class="form-control" id="height" name="height" value="<?php echo $player['height']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $player['weight']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="text" class="form-control" id="year" name="year" value="<?php echo $player['year']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="photo_url" class="form-label">Photo URL</label>
                <input type="url" class="form-control" id="photo_url" name="photo_url" value="<?php echo $player['photo_url']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Player</button>
        </form>
    </main>

    <?php require 'footer.php'; ?>
</body>
</html>
