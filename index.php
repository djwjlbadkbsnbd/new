<?php
// Start session at the beginning of the script
session_start();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kadeřnictví Lmk - Výběr služby</title>
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
                <li><a href="main.html">Homepage</a></li>
                <li><a href="#">galerie</a></li>
                <li><a href="news.php">Novinky</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="" method="post">
            <div class="services">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "rezerver";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, name, price FROM services";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="service-item">';
                        echo '<label class="service-label">';
                        echo '<input type="radio" name="service_id" value="' . htmlspecialchars($row['id']) . '">';
                        echo '<span class="service-name">' . htmlspecialchars($row['name']) . '</span>';
                        echo '<span class="service-price">' . htmlspecialchars($row['price']) . ' Kč</span>';
                        echo '</label>';
                        echo '</div><hr>';
                    }
                } else {
                    echo "<p>Žádné služby nejsou dostupné.</p>";
                }

                $conn->close();
                ?>
                <button type="submit">Vybrat službu</button>
            </div>
        </form>

        <aside class="summary">
            <div class="summary-logo">
                <img src="img/logo.png" alt="Kadeřnictví logo">
            </div>
            <h3>Souhrn</h3>
            <div class="summary-details">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_id'])) {
                    // Reconnect to the database
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $service_id = intval($_POST['service_id']);
                    $sql = "SELECT name, price FROM services WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $service_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        
                        $_SESSION['service'] = [
                            'id' => $service_id,
                            'name' => $row['name'],
                            'price' => $row['price']
                        ];

                        echo '<p>' . htmlspecialchars($row['name']) . ' <span>' . htmlspecialchars($row['price']) . ' Kč</span></p>';
                        echo '<p>Termín <span>Vyberte čas</span></p>';
                        echo '<p>Údaje <span>-</span></p>';
                    } else {
                        echo "<p>Vyberte </p>";
                        echo '<p>Termín <span>Vyberte čas</span></p>';
                        echo '<p>Údaje <span>-</span></p>';
                    }

                    $stmt->close();
                    $conn->close();
                } elseif (isset($_SESSION['service'])) {
                    echo '<p>' . htmlspecialchars($_SESSION['service']['name']) . ' <span>' . htmlspecialchars($_SESSION['service']['price']) . ' Kč</span></p>';
                    echo '<p>Termín <span>Vyberte čas</span></p>';
                    echo '<p>Údaje <span>-</span></p>';
                } else {
                    echo "<p>Vyberte službu</p>";
                    echo '<p>Termín <span>Vyberte čas</span></p>';
                    echo '<p>Údaje <span>-</span></p>';
                }
                ?>
            </div>
            <button class="confirm-button"><a href="term.php">Potvrdit službu</a></button>
        </aside>
    </main>
</body>
</html>
