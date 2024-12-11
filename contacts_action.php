<?php
// Start session to access session variables
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=rezerver', 'root', '');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and session variables
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_NUMBER_INT);
    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);

    
    $timeslot_id = isset($_POST['timeslot_id']) ? intval($_POST['timeslot_id']) : null;
    $service_id = isset($_POST['service_id']) ? intval($_POST['service_id']) : null;
    $contact_id = isset($_POST['contact_id']) ? intval($_POST['contact_id']) : null;

    // Validate required fields
    if (!$name || !$email || !$number || !$timeslot_id || !$service_id) {
        die('Missing required fields. Please try again.');
    }

    // Prepare and execute the SQL statement
    try {
        $stmt = $pdo->prepare("INSERT INTO booking (timeslot_id, service_id, contacts_id) VALUES (?, ?, ?)");
        $stmt->execute([$timeslot_id, $service_id, $contact_id]);

        // Confirm booking success
        echo "<p>Booking successfully created! Thank you, $name.</p>";
        echo '<a href="main.html">Return to homepage</a>';
    } catch (PDOException $e) {
        die("Error inserting booking: " . $e->getMessage());
    }
} else {
    echo "Invalid request method.";
}

?>