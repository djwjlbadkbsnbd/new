<?php
session_start(); // Start a session to store user information if login is successful

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rezerver";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$name = $_POST['name'];
$password = $_POST['password'];

// Prepare the SQL query
$sql = "SELECT id, password, is_admin FROM user WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

   
    if (password_verify($password, $user['password'])) {
        // Check if the user is an admin
        if ($user['is_admin'] == 1) {
            // Successful login as admin
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $name;
            $_SESSION['is_admin'] = true;
            header("Location: admin.php"); // Redirect to admin dashboard
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
