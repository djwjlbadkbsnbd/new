<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "rezerver";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve post to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();
    
    if (!$blog) {
        echo "Post not found.";
        exit;
    }
} else {
    header("Location:news.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
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
            <h2>Edit Blog Post</h2>
            
            <form action="news.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">

                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>

                <label for="content">Content:</label>
                <textarea name="content" id="content" rows="6" required><?php echo htmlspecialchars($blog['content']); ?></textarea>

                <label for="author">Author:</label>
                <input type="text" name="author" id="author" value="<?php echo htmlspecialchars($blog['author']); ?>" required>

                <button type="submit" name="update">Update Post</button>
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
