<?php
$pdo = new PDO('mysql:host=localhost;dbname=rezerver', 'root', '');

// Configuration for generating timeslots
$currentYear = 2024;
$currentMonth = 9; // September
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
$startTime = "08:00"; // Start of the day
$endTime = "18:00"; // End of the day
$slotDuration = 30; // Duration of each slot in minutes

// Function to generate timeslots for a specific day
function generateTimeSlots($date, $startTime, $endTime, $slotDuration) {
    $slots = [];
    $current = strtotime($date . " " . $startTime);
    $end = strtotime($date . " " . $endTime);

    while ($current < $end) {
        $next = $current + ($slotDuration * 60);
        $slots[] = [
            'date' => $date,
            'start_time' => date('H:i', $current),
            'end_time' => date('H:i', $next),
            'is_available' => 1 // Default availability
        ];
        $current = $next;
    }

    return $slots;
}

// Insert generated timeslots into the database
for ($day = 1; $day <= $daysInMonth; $day++) {
    $date = "$currentYear-$currentMonth-" . str_pad($day, 2, '0', STR_PAD_LEFT);
    $slots = generateTimeSlots($date, $startTime, $endTime, $slotDuration);

    foreach ($slots as $slot) {
        $stmt = $pdo->prepare("
            INSERT INTO timeslot (date, start_time, end_time, is_available) 
            VALUES (:date, :start_time, :end_time, :is_available)
        ");
        $stmt->execute([
            'date' => $slot['date'],
            'start_time' => $slot['start_time'],
            'end_time' => $slot['end_time'],
            'is_available' => $slot['is_available']
        ]);
    }
}

echo "Timeslots for $currentMonth/$currentYear have been generated successfully!";
