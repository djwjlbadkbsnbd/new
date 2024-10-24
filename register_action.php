<?php

$conn = new mysqli('localhost', 'root', '', 'rezerver');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $checkUser = "SELECT * FROM user WHERE name = '$name' OR email = '$email'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        echo "Username or email already taken.";
    } else {
        $query = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($query) === TRUE) {
            echo "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $conn->error;
            
        }
    }
}

$conn->close();
?>
