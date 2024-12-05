<?php
session_start();
header('Content-Type: application/json');

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

// Check if data is valid
if (isset($data['selectedDate'])) {
    $_SESSION['selected_date'] = $data['selectedDate'];
}

if (isset($data['selectedTime'])) {
    $_SESSION['selected_time'] = $data['selectedTime'];
}

// Check if both data have been set (if not, you could provide a default value or return an error)
if (!isset($_SESSION['selected_date']) || !isset($_SESSION['selected_time'])) {
    echo json_encode(['success' => false, 'message' => 'Missing data']);
    exit();
}

// If everything is fine, return a success message
echo json_encode(['success' => true]);
?>
