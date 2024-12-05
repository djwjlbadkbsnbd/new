<?php
session_start();
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
                <li><a href="login.html">login</a></li>
                <li><a href="news.html">Novinky</a></li>
                <li><a href="galery.html">Galerie</a></li>
                <li><a href="#reservation">Rezervace</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Calendar and Time Slots -->
        <div class="calendar-container">
            <h2>Výběr termínu</h2>
            <div class="calendar-header">
                <button onclick="changeMonth(-1)">&#60;</button>
                <div id="currentMonth">Září 2024</div>
                <button onclick="changeMonth(1)">&#62;</button>
            </div>
            <div class="calendar" id="calendar">
            </div>
            <div class="time-buttons">
            </div>
            <div class="time-slots" id="timeSlots">
            </div>
        </div>

        <aside class="summary">
            <div class="summary-logo">
                <img src="img/logo.png" alt="Kadeřnictví Láska logo">
            </div>
            <h3>Souhrn</h3>
            <div class="summary-details">
                <?php
                if (isset($_SESSION['service'])) {
                    echo '<p> ' . htmlspecialchars($_SESSION['service']['name']) . ' <span>' . htmlspecialchars($_SESSION['service']['price']) . ' Kč</span></p>';
                } else {
                    echo '<p>Služba: Vyberte službu</p>';
                }
                ?>
                <p>Termín: 
                    <span id="selectedDate">
                        <?php echo isset($_SESSION['selected_date']) ? htmlspecialchars($_SESSION['selected_date']) : 'Vyberte datum'; ?>
                    </span>
                </p>
                <p>Čas: 
                    <span id="selectedTime">
                        <?php echo isset($_SESSION['selected_time']) ? htmlspecialchars($_SESSION['selected_time']) : 'Vyberte čas'; ?>
                    </span>
                </p>
                <p>Údaje: <span>-</span></p>
            </div>
            <button class="confirm-button"><a href="contacts.php">Potvrdit rezervaci</a></button>
        </aside>
    </div>

    <script>


    const calendarElement = document.getElementById('calendar');
    const selectedDateElement = document.getElementById('selectedDate');
    const timeSlotsElement = document.getElementById('timeSlots');
    const selectedTimeElement = document.getElementById('selectedTime');
    const daysInMonth = 30; // Adjust based on the month
    let selectedDay = null;

    function generateCalendar() {
        calendarElement.innerHTML = '';
        for (let i = 1; i <= daysInMonth; i++) {
            const dateElement = document.createElement('div');
            dateElement.className = 'calendar-date';
            dateElement.textContent = i;
            dateElement.onclick = () => selectDate(i);
            calendarElement.appendChild(dateElement);
        }
    }

    function selectDate(day) {
        selectedDay = day;
        const formattedDate = `Září ${day}, 2024`;
        selectedDateElement.textContent = formattedDate;

        // Clear previous selections
        document.querySelectorAll('.calendar-date').forEach(el => el.classList.remove('selected'));
        document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));
        selectedTimeElement.textContent = 'Vyberte čas';

        const selectedDate = document.querySelector(`.calendar-date:nth-child(${day})`);
        selectedDate.classList.add('selected');

        // Save selected date in the session
        saveToSession({ selectedDate: formattedDate, selectedTime: null });

        fetchAvailableTimes(day);
    }

    function fetchAvailableTimes(day) {
        fetch(`get_times.php?day=${day}`)
            .then(response => response.json())
            .then(data => {
                if (data.times) {
                    updateTimeSlots(data.times);
                } else {
                    timeSlotsElement.innerHTML = 'Žádné dostupné termíny pro tento den';
                }
            })
            .catch(error => console.error('Error fetching times:', error));
    }

    function updateTimeSlots(times) {
        timeSlotsElement.innerHTML = ''; // Clear previous slots

        if (times.length === 0) {
            timeSlotsElement.innerHTML = 'Žádné dostupné termíny pro tento den';
            return;
        }

        times.forEach(time => {
            const timeSlotElement = document.createElement('div');
            timeSlotElement.className = 'time-slot';
            timeSlotElement.textContent = `${time.start_time} - ${time.end_time}`;

            if (time.is_available === 0) {
                timeSlotElement.classList.add('unavailable');
                timeSlotElement.onclick = () => alert('Tento termín již byl rezervován');
            } else {
                timeSlotElement.onclick = () => selectTime(time);
            }

            timeSlotsElement.appendChild(timeSlotElement);
        });
    }
    
    function saveToSession(data) {
    // If selectedTime is null, replace it with an empty string
    if (data.selectedTime === null) {
        data.selectedTime = ''; // Ensure it's not null
    }

    console.log("Sending data to PHP:", data);  // Log to check

    fetch('save_datetime.php', {
        method: 'POST', // Ensure it's a POST request
        headers: { 
            'Content-Type': 'application/json' // Set content type to JSON
        },
        body: JSON.stringify(data), // Convert the data to JSON
    })
    .then(response => response.json()) // Parse the response as JSON
    .then(result => {
        if (!result.success) {
            console.error('Failed to save data to session:', result.message);
        } else {
            console.log('Data saved successfully');
        }
    })
    .catch(error => {
        console.error('Error saving to session:', error);
    });
}

    function selectTime(time) {
        const formattedTime = `${time.start_time} - ${time.end_time}`;
        selectedTimeElement.textContent = formattedTime;

        document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));

        const selectedTimeSlot = Array.from(document.querySelectorAll('.time-slot')).find(
            el => el.textContent === formattedTime
        );
        if (selectedTimeSlot) {
            selectedTimeSlot.classList.add('selected');
        }

        saveToSession({ selectedDate: selectedDateElement.textContent, selectedTime: formattedTime });
    }


    function changeMonth(direction) {
        alert('Month change not yet implemented.');
    }

    generateCalendar();


    </script>
</body>
</html>
