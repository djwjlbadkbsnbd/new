<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'rezerver');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE name = '$name'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['name'] = $user['name'];
            header('Location: admin.php');
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that username.";
    }
}

$conn->close();
?>
