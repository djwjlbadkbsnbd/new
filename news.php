<?php
session_start(); 

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

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO blogs (title, content, created_date, author) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $content, $date, $author);
    $stmt->execute();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: news.php");
    exit();
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];

    $sql = "UPDATE blogs SET title = ?, content = ?, author = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $content, $author, $id);
    $stmt->execute();
    header("Location:   news_update.php");
    exit();
}

// Fetch all blog posts
$sql = "SELECT id, title, content, created_date, author FROM blogs ORDER BY created_date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kadeřnictví LMK - Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Kadeřnictví Láska logo">
        </div>
        <nav>
            <ul>
                <li><a href="login.html">login</a></li>
                <li><a href="main.html">Homepage</a></li>
                <li><a href="galery.html">Galerie</a></li>
                <li><a href="index.php">Rezervace</a></li>
                <li><?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) { ?>
    <div class="admin-controls">
        <a href="news_create.php" class="button-create">Create New Post</a>
    </div>
<?php } ?></li>
            </ul>
        </nav>
    </header>

    <main class="blog-main">
        <div class="blog-container">
            <h2>Blog Management</h2>
            <h3>Blog Posts</h3>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="blog-post">
                    <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($row['created_date']); ?> | <strong>Author:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
                    <p class="news_text"> <?php echo htmlspecialchars($row['content']); ?> </p>

                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) { ?>
                        <div class="admin-controls">
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="update"><a href="news_update.php?id=<?php echo $row['id']; ?>">Edit</a></button>
                                <button type="submit" name="delete"><a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a></button>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Kadeřnictví Láska. Všechna práva vyhrazena.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
