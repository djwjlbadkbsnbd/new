<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=rezerver', 'root', '');

// Set the current date and handle selected date
$currentYear = 2024;
$currentMonth = 9; // September
$selectedDay = isset($_GET['day']) ? (int)$_GET['day'] : null;
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

// Generate calendar function
function generateCalendar($daysInMonth, $selectedDay)
{
    $calendar = '';
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $class = ($i === $selectedDay) ? 'calendar-date selected' : 'calendar-date';
        $calendar .= "<a href='?day=$i'><div class='$class'>$i</div></a>";
    }
    return $calendar;
}

// Fetch available time slots for the selected day
$timeSlots = [];
if ($selectedDay) {
    $date = "$currentYear-$currentMonth-" . str_pad($selectedDay, 2, '0', STR_PAD_LEFT);
    $stmt = $pdo->prepare("SELECT * FROM timeslot WHERE date = :date ORDER BY start_time");
    $stmt->execute(['date' => $date]);
    $timeSlots = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Save selected date and time
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['selected_date'] = $_POST['selected_date'];
    $_SESSION['selected_time'] = $_POST['selected_time'];
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kadeřnictví Láska - Výběr termínu</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Kadeřnictví Láska logo">
        </div>
        <nav>
            <ul>
                <li><a href="login.html">Login</a></li>
                <li><a href="news.html">Novinky</a></li>
                <li><a href="galery.html">Galerie</a></li>
                <li><a href="index.php">Rezervace</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Calendar Section -->
        <div class="calendar-container">
            <h2>Výběr termínu</h2>
            <div class="calendar-header">
                <div id="currentMonth">Září 2024</div>
            </div>
            <div class="calendar">
                <?= generateCalendar($daysInMonth, $selectedDay) ?>
            </div>¨
        <div class="timeslot_container">
            <div class="time-slots">
                <div id="calendar-timeslots">
                    <?php foreach ($timeSlots as $slot): ?>
                        <?php if ($slot['is_available']): ?>
                            <div class="time-slot">
                                <label>
                                    <input type="radio" name="time_slot_id" value="<?= $slot['id'] ?>"> <!-- Use the slot ID -->
                                    <?= $slot['start_time'] ?> 
                                </label>
                            </div>
                        <?php else: ?>
                            <div class="time-slot unavailable">
                                <?= $slot['start_time'] ?> - <?= $slot['end_time'] ?> (Obsazeno)
                            </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Slot Section -->

        <!-- Summary Section -->
        <aside class="summary">
            <div class="summary-logo">
                <img src="img/logo.png" alt="Kadeřnictví Láska logo">
            </div>
            <h3>Souhrn</h3>
            <div class="summary-details">
                <?php
                if (isset($_SESSION['service'])) {
                    echo '<p>' . htmlspecialchars($_SESSION['service']['name']) . ' <span>' . htmlspecialchars($_SESSION['service']['price']) . ' Kč</span></p>';
                } else {
                    echo '<p>Služba: Vyberte službu</p>';
                }

                // Display selected date and time from session
                $selectedDate = isset($_SESSION['selected_date']) ? htmlspecialchars($_SESSION['selected_date']) : 'Není vybrán termín';
                $selectedTime = isset($_SESSION['selected_time']) ? htmlspecialchars($_SESSION['selected_time']) : 'Není vybrán čas';

                echo '<p>Termín: <span>' . $selectedDate . '</span></p>';
                echo '<p>Čas: <span>' . $selectedTime . '</span></p>';
                ?>
                <p>Údaje: <span>-</span></p>
                <button class="confirm-button"><a href="contacts.php">Potvrdit rezervaci</a></button>
            </div>
        </aside>
    </main>
</body>

</html>