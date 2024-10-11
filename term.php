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
                <li><a href="#news">Novinky</a></li>
                <li><a href="#gallery">Galerie</a></li>
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
                <button onclick="showMorningTimes()">Dopoledne</button>
                <button onclick="showAfternoonTimes()">Odpoledne</button>
                <button onclick="showEveningTimes()">Večer</button>
            </div>
            <div class="time-slots" id="timeSlots">
                <!-- Time slots will be generated here -->
            </div>
        </div>

        <!-- Summary and Confirmation -->
        <aside class="summary">
            <div class="summary-logo">
                <img src="img/logo.png" alt="Kadeřnictví Láska logo">
            </div>
            <h3>Souhrn</h3>
            <div class="summary-details">
                <p>Pánský střih <span>000 Kč</span></p>
                <p>Termín:<span id="selectedDate">Vyberte datum</span></p>
                <p>Čas:<span id="selectedTime">Vyberte čas</span></p>
                <p>Údaje <span>-</span></p>
            </div>
            <button class="confirm-button"><a href="contacts.php" >Potvrdit termin</a></button>
        </aside>
    </div>

    <script>
        const calendarElement = document.getElementById('calendar');
        const selectedDateElement = document.getElementById('selectedDate');
        const timeSlotsElement = document.getElementById('timeSlots');
        const selectedTimeElement = document.getElementById('selectedTime');
        const daysInMonth = 30; // Adjust based on the month

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
            selectedDateElement.textContent = `Září ${day}, 2024`;
            document.querySelectorAll('.calendar-date').forEach(el => el.classList.remove('selected'));
            document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));
            selectedTimeElement.textContent = 'Vyberte čas';

            const selectedDate = document.querySelector(`.calendar-date:nth-child(${day})`);
            selectedDate.classList.add('selected');

            showMorningTimes();
        }

        function showMorningTimes() {
            const morningTimes = ['8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30'];
            updateTimeSlots(morningTimes);
        }

        function showAfternoonTimes() {
            const afternoonTimes = ['12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30'];
            updateTimeSlots(afternoonTimes);
        }

        function showEveningTimes() {
            const eveningTimes = ['16:00', '16:30', '17:00', '17:30', '18:00'];
            updateTimeSlots(eveningTimes);
        }

        function updateTimeSlots(times) {
            timeSlotsElement.innerHTML = '';
            times.forEach(time => {
                const timeSlotElement = document.createElement('div');
                timeSlotElement.className = 'time-slot';
                timeSlotElement.textContent = time;
                timeSlotElement.onclick = () => selectTime(time);
                timeSlotsElement.appendChild(timeSlotElement);
            });
        }

        function selectTime(time) {
            selectedTimeElement.textContent = time;
            document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));
            const selectedTimeSlot = Array.from(document.querySelectorAll('.time-slot')).find(el => el.textContent === time);
            if (selectedTimeSlot) {
                selectedTimeSlot.classList.add('selected');
            }
        }

        function changeMonth(direction) {
            // Logic for changing months (not implemented in this simple version)
            alert('Month change not yet implemented.');
        }

        generateCalendar();
    </script>
</body>
</html>
