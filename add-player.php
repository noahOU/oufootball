<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php require 'navbar.php'; ?>

    <main class="container my-5">
        <h2 class="text-center">Add New Player</h2>
        <form action="save-player.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">Number</label>
                <input type="number" class="form-control" id="number" name="number" required>
            </div>
            <div class="mb-3">
                <label for="height" class="form-label">Height</label>
                <input type="text" class="form-control" id="height" name="height" required>
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="text" class="form-control" id="weight" name="weight" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="text" class="form-control" id="year" name="year" required>
            </div>
            <div class="mb-3">
                <label for="photo_url" class="form-label">Photo URL</label>
                <input type="url" class="form-control" id="photo_url" name="photo_url" required>
            </div>
            <button type="submit" class="btn btn-success">Save Player</button>
        </form>
    </main>

    <?php require 'footer.php'; ?>
</body>
</html>
