<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'rezerver');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get the day parameter from the request
$day = isset($_GET['day']) ? $_GET['day'] : null;
if ($day === null) {
    echo json_encode(['error' => 'No day specified']);
    exit();
}

// Assuming your hours are from 9 AM to 5 PM with 30-minute intervals
$startTime = '09:00';
$endTime = '17:00';
$interval = 30; // In minutes

// Prepare an array to store the time slots
$timeSlots = [];

// Generate time slots for the selected day
$currentTime = strtotime($startTime);
$endTimeStamp = strtotime($endTime);

while ($currentTime < $endTimeStamp) {
    $start = date('H:i', $currentTime);
    $end = date('H:i', $currentTime + $interval * 60);

    // Check if this time slot is available in the database
    $sql = "SELECT COUNT(*) FROM timeslot WHERE date = ? AND start_time = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $day, $start);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // If no booking exists for this time slot, it is available
    $isAvailable = $count == 0 ? 1 : 0;

    $timeSlots[] = [
        'start_time' => $start,
        'end_time' => $end,
        'is_available' => $isAvailable
    ];

    // Move to the next time slot
    $currentTime = strtotime("+$interval minutes", $currentTime);
}

// Return the time slots as a JSON response
echo json_encode(['times' => $timeSlots]);

$conn->close();
?>
