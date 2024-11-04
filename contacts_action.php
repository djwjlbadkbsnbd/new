<?php
session_start();

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

  
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $note = $_POST['note'];

    // Prepare an SQL statement to insert the data
    $sql = "INSERT INTO contacts (name, email, number, note) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind the parameters as strings
    $stmt->bind_param("ssss", $name, $email, $number, $note);

    // Execute and check for success
    if ($stmt->execute()) {
        $_SESSION['message'] = "Rezervace úspěšně uložena!";
        header("Location: main.html");
        exit();
    } else {
        $_SESSION['message'] = "Chyba při ukládání rezervace: " . $stmt->error;
        header("Location: main.html"); 
        exit();
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();


?>
