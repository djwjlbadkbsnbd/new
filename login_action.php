<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rezerver";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$password = $_POST['password'];


$sql = "SELECT id, password, is_admin FROM user WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

   
    if (password_verify($password, $user['password'])) {
        if ($user['is_admin'] == 1) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $name;
            $_SESSION['is_admin'] = true;
            header("Location: main.html"); // Redirect to admin dashboard
            exit();
        } else {
            
            $_SESSION['error'] = "You do not have admin privileges.";
            header("Location: login.html"); 
            exit();
        }
    } else {
       
        $_SESSION['error'] = "Incorrect password.";
        header("Location: login.html");
        exit();
    }
} else {
   
    $_SESSION['error'] = "User not found.";
    header("Location: login.html");
    exit();
}

$stmt->close();
$conn->close();
?>
