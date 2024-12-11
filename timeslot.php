<?php
$pdo = new PDO('mysql:host=localhost;dbname=rezerver', 'root', '');

// Define the date range for time slots
$startDate = '2024-09-01';
$endDate = '2024-09-30';

// Define the time range for each day
$startTime = '09:00:00';
$endTime = '17:00:00';
$intervalMinutes = 30; // Interval between time slots

// Helper function to generate time slots
function generateTimeSlots($startTime, $endTime, $intervalMinutes) {
    $slots = [];
    $current = strtotime($startTime);
    $end = strtotime($endTime);

    while ($current < $end) {
        $start = date('H:i:s', $current);
        $current = strtotime("+$intervalMinutes minutes", $current);
        $endSlot = date('H:i:s', $current);
        $slots[] = [$start, $endSlot];
    }
    return $slots;
}

// Generate and insert time slots into the database
$slots = generateTimeSlots($startTime, $endTime, $intervalMinutes);
$currentDate = strtotime($startDate);
$endDate = strtotime($endDate);

while ($currentDate <= $endDate) {
    $date = date('Y-m-d', $currentDate);

    foreach ($slots as $slot) {
        $stmt = $pdo->prepare("INSERT INTO timeslot (date, start_time, end_time, is_available) VALUES (:date, :start_time, :end_time, :is_available)");
        $stmt->execute([
            ':date' => $date,
            ':start_time' => $slot[0],
            ':end_time' => $slot[1],
            ':is_available' => 1 // Mark as available by default
        ]);
    }

    $currentDate = strtotime('+1 day', $currentDate);
}

echo "Time slots successfully generated and inserted into the database!";
?>
