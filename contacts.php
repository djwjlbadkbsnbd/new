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
                <li><a href="login.php">login</a></li>
                <li><a href="main.php">Novinky</a></li>
                <li><a href="#">Galerie</a></li>
                <li><a href="index.php">Rezervace</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="contact-info">
            <h2>Kontaktní údaje</h2>
            <div class="contact-form">
                <input type="text" class="input-field" placeholder="Jméno a příjmení" required>
                <input type="email" class="input-field" placeholder="E-mail" required>
                <input type="tel" class="input-field" placeholder="Telefonní číslo" required>
                <input type="text" class="input-field" placeholder="Poznámka (volitelné)">
            </div>
        </section>
        <aside class="summary">
            <div class="summary-logo">
                <img src="img/logo.png" alt="Kadeřnictví Láska logo">
            </div>
            <h3>Souhrn</h3>
            <div class="summary-details">
                <p>Pánský střih <span>000 Kč</span></p>
                <p>Termín <span>01.01.2025</span></p>
                <p>Údaje <span>-</span></p>
            </div>
            <button class="confirm-button"><a href="confirmation.php">Potvrdit rezervaci</a></button>
        </aside>
    </main>
</body>
</html>
