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
            <div class="contact-form">
                <form action="contacts_action.php" method="post">
                    <input type="text" name="name" class="input-field" placeholder="Jméno a příjmení" required>
                    <input type="email" name="email" class="input-field" placeholder="E-mail" required>
                    <input type="number" name="number" class="input-field" placeholder="Telefonní číslo" required>
                    <input type="text" name="note" class="input-field" placeholder="Poznámka (volitelné)">
                    
                    <!-- Hidden inputs to pass date and time to the server -->
                    <input type="hidden" name="selected_date" value="<?php echo isset($_SESSION['selected_date']) ? htmlspecialchars($_SESSION['selected_date']) : ''; ?>">
                    <input type="hidden" name="selected_time" value="<?php echo isset($_SESSION['selected_time']) ? htmlspecialchars($_SESSION['selected_time']) : ''; ?>">
                </form>
            </div>
        </section>
        <aside class="summary">
            <div class="summary-logo">
                <img src="img/logo.png" alt="Kadeřnictví Láska logo">
            </div>
            <h3>Souhrn</h3>
            <div class="summary-details">
                <?php
                // Display selected service details from session
                if (isset($_SESSION['service'])) {
                    echo '<p> ' . htmlspecialchars($_SESSION['service']['name']) . ' <span>' . htmlspecialchars($_SESSION['service']['price']) . ' Kč</span></p>';
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
            </div>
            <button type="submit" style="margin-left: 0px;" class="confirm-button">Potvrdit rezervaci</button>
        </aside>
    </main>
</body>
</html>
