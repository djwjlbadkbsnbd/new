<?php
session_start();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kadeřnictví Láska - Kontaktní údaje</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Retrieve selected date and time from localStorage
        const selectedDate = localStorage.getItem("selectedDate");
        const selectedTime = localStorage.getItem("selectedTime");
    
        // Display the selected date and time in the summary and hidden inputs
        if (selectedDate && selectedTime) {
            document.getElementById("selectedDate").textContent = selectedDate;
            document.getElementById("selectedTime").textContent = selectedTime;
    
            // Set the hidden input values to be sent with the form
            document.getElementById("hiddenDate").value = selectedDate;
            document.getElementById("hiddenTime").value = selectedTime;
        } else {
            document.getElementById("selectedDate").textContent = "Není vybrán termín";
            document.getElementById("selectedTime").textContent = "Není vybrán čas";
        }
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Kadeřnictví Láska logo">
        </div>
        <nav>
            <ul>
                <li><a href="login.html">login</a></li>
                <li><a href="main.html">Novinky</a></li>
                <li><a href="#">Galerie</a></li>
                <li><a href="index.html">Rezervace</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="contact-info">
            <h2>Kontaktní údaje</h2>
            <div class="contact-form" >
        <form action="contacts_action.php" method="post">
                <input type="text" name="name" class="input-field" placeholder="Jméno a příjmení" required>
                <input type="email" name="email" class="input-field" placeholder="E-mail" required>
                <input type="number" name="number" class="input-field" placeholder="Telefonní číslo" required>
                <input type="text" name="note" class="input-field" placeholder="Poznámka (volitelné)">
                <input type="hidden" name="selected_date" id="hiddenDate">
                <input type="hidden" name="selected_time" id="hiddenTime">
            </div>
        </section>
        <aside class="summary">
            <div class="summary-logo">
                <img src="img/logo.png" alt="Kadeřnictví Láska logo">
            </div>
            <h3>Souhrn</h3>
            <div class="summary-details">
                <p>Pánský střih <span>000 Kč</span></p>
                <p>Termín: <span id="selectedDate"></span></p>
                <p>Čas: <span id="selectedTime"></span></p>
                <p>Údaje <span>-</span></p>
            </div>
            <button  type="submit" style="margin-left: 0px;" class="confirm-button"> rezervaci</button>
        </form>
        </aside>
    </main>
</body>
</html>
