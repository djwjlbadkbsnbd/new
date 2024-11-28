<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'rezerver');

// Check if the connection is successful
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

// Check if the required data is provided
if (isset($data['timeSlotId'])) {
    $timeSlotId = $data['timeSlotId'];

    // Query to update the time slot availability
    $sql = "UPDATE timeslot SET is_available = 0 WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the time slot ID to the query
        $stmt->bind_param("i", $timeSlotId);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Time slot updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error updating time slot']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error preparing statement']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Time slot ID not provided']);
}

// Close the database connection
$conn->close();
?>
