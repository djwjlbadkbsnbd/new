<?php
header('Content-Type: application/json');
require_once 'config.php'; // Include your database connection

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);
$bookingDate = $data['booking_date'];
$startTime = $data['start_time'];

// Insert the booking into the database
$sql = "INSERT INTO bookings (booking_date, start_time, user_id) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$user_id = 1; // Assuming user ID 1 for now (replace with actual user ID from session)
$stmt->bind_param("ssi", $bookingDate, $startTime, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Could not book the slot']);
}

$stmt->close();
$conn->close();
?>
