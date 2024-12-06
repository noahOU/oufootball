<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OU Football Fans</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="images/helmet.png">
</head>
<body>
    <?php require 'navbar.php'; ?>


    <main class="container my-5">
        <h2 class="text-center">Join the Conversation</h2>
        <form action="fans.php" method="POST" class="mb-5">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h3 class="text-center">Fan Comments</h3>
        <div class="comments">
            <?php
            require 'util-db.php';
            $conn = get_db_connection();

            if ($conn) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $conn->real_escape_string($_POST['name']);
                    $email = $conn->real_escape_string($_POST['email']);
                    $comment = $conn->real_escape_string($_POST['comment']);

                    $sql = "INSERT INTO fans (name, email, comment) VALUES ('$name', '$email', '$comment')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<p class='text-success'>Comment added successfully!</p>";
                    } else {
                        echo "<p class='text-danger'>Error: " . $conn->error . "</p>";
                    }
                }

                $sql = "SELECT * FROM fans ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <div class='mb-4'>
                            <h5>{$row['name']} <small class='text-muted'>on " . date("F j, Y, g:i a", strtotime($row['created_at'])) . "</small></h5>
                            <p>{$row['comment']}</p>
                            <hr>
                        </div>
                        ";
                    }
                } else {
                    echo "<p>No comments yet. Be the first!</p>";
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

