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
                <!-- Calendar will be dynamically generated here -->
            </div>
            <div class="time-buttons">
                
            </div>
            <div class="time-slots" id="timeSlots">
                <!-- Time slots will be populated here -->
            </div>
        </div>

        <aside class="summary">
            <div class="summary-logo">
                <img src="img/logo.png" alt="Kadeřnictví Láska logo">
            </div>
            <h3>Souhrn</h3>
            <div class="summary-details">
            <?php echo '<p>' . htmlspecialchars($row['name']) . ' <span>' . htmlspecialchars($row['price']) . ' Kč</span></p>';
                ?><p>Termín:<span id="selectedDate">Vyberte datum</span></p>
                <p>Čas:<span id="selectedTime">Vyberte čas</span></p>
                <p>Údaje <span>-</span></p>
            </div>
            <button class="confirm-button" id="confirmBooking"><a href="contacts.php">Potvrdit termin</a></button>
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
            selectedDateElement.textContent = `Září ${day}, 2024`;
            document.querySelectorAll('.calendar-date').forEach(el => el.classList.remove('selected'));
            document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));
            selectedTimeElement.textContent = 'Vyberte čas';

            const selectedDate = document.querySelector(`.calendar-date:nth-child(${day})`);
            selectedDate.classList.add('selected');

            // Fetch available times for the selected day
            fetchAvailableTimes(day);
        }

        function fetchAvailableTimes(day) {
            fetch(`get_times.php?day=${day}`)
                .then(response => response.json())
                .then(data => {
                    if (data.times) {
                        updateTimeSlots(data.times);
                    } else {
                        console.error('No times data found');
                        timeSlotsElement.innerHTML = 'Žádné dostupné termíny pro tento den';
                    }
                })
                .catch(error => console.error('Error fetching times:', error));
        }

        // Function to update the time slot display on the page
        function updateTimeSlots(times) {
            timeSlotsElement.innerHTML = ''; // Clear the previous time slots

            // Check if there are any available times
            if (times.length === 0) {
                timeSlotsElement.innerHTML = 'Žádné dostupné termíny pro tento den';
                return;
            }

            // Loop through the times and create time slot elements
            times.forEach(time => {
                const timeSlotElement = document.createElement('div');
                timeSlotElement.className = 'time-slot';
                timeSlotElement.textContent = `${time.start_time} - ${time.end_time}`;

                // Check if the time slot is available or not
                if (time.is_available === 0) {
                    timeSlotElement.classList.add('unavailable'); // Add unavailable class
                    timeSlotElement.onclick = () => alert('Tento termín již byl rezervován');
                } else {
                    // Mark the slot as selectable
                    timeSlotElement.onclick = () => selectTime(time);
                }

                timeSlotsElement.appendChild(timeSlotElement);
            });
        }

        // Function to handle the selection of a time slot
        function selectTime(time) {
            selectedTimeElement.textContent = `${time.start_time} - ${time.end_time}`;
            document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));
            const selectedTimeSlot = Array.from(document.querySelectorAll('.time-slot')).find(el => el.textContent === `${time.start_time} - ${time.end_time}`);
            if (selectedTimeSlot) {
                selectedTimeSlot.classList.add('selected');
            }

            // Update the availability status of the selected time slot in the database
            updateTimeSlotAvailability(time.id);
        }

        // Function to update the availability of the time slot
        function updateTimeSlotAvailability(timeSlotId) {
            fetch(`timeslot.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ timeSlotId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Time slot updated successfully');
                    // Re-fetch available times to reflect the change
                    fetchAvailableTimes(selectedDay);
                } else {
                    console.error('Failed to update time slot');
                }
            })
            .catch(error => console.error('Error updating time slot:', error));
        }

        function changeMonth(direction) {
            // Logic for changing months (not implemented in this simple version)
            alert('Month change not yet implemented.');
        }

        generateCalendar();
        document.getElementById("confirmBooking").addEventListener("click", function() {
            // Get selected date and time
            const selectedDate = document.getElementById("date").value;
            const selectedTime = document.getElementById("time").value;

            // Store the selected data in localStorage
            localStorage.setItem("selectedDate", selectedDate);
            localStorage.setItem("selectedTime", selectedTime);

            // Redirect to the contact page
            window.location.href = "contacts.html";
        });
    </script>
</body>
</html>
