<?php
session_start();
header('Content-Type: application/json');


$data = json_decode(file_get_contents('php://input'), true);


if (isset($data['selectedDate'])) {
    $_SESSION['selected_date'] = $data['selectedDate'];
}

if (isset($data['selectedTime'])) {
    $_SESSION['selected_time'] = $data['selectedTime'];
}

if (!isset($_SESSION['selected_date']) || !isset($_SESSION['selected_time'])) {
    echo json_encode(['success' => false, 'message' => 'Missing data']);
    exit();
}

echo json_encode(['success' => true]);
?>
