<?php
session_start();

if (!isset($_SESSION['is_admin']) | $_SESSION['is_admin'] !== true) {
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "rezerver";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Kadeřnictví Láska logo">
        </div>
        <nav>
            <ul>
                <li><a href="login.html">login</a></li>
                <li><a href="main.html">Novinky</a></li>
                <li><a href="#">Galerie</a></li>
                <li><a href="index.html">Rezervace</a></li>
            </ul>
        </nav>
    </header>

    <main class="blog-main">
        <div class="blog-container">
            <h2>Create New Blog Post</h2>
            
            <form action="news.php" method="POST">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="content">Content:</label>
                <textarea name="content" id="content" rows="6" required></textarea>

                <label for="author">Author:</label>
                <input type="text" name="author" id="author" required>

                <button type="submit" name="create">Create Post</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Kadeřnictví Láska. Všechna práva vyhrazena.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
