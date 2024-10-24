
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kadeřnictví</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
</head>
<body>
<header>
        <div class="logo">
            <img src="img/logo.png" alt="Kadeřnictví Láska logo">
        </div>
        <nav>
            <ul>
                <li><a href="main.php">Homepage</a></li>
                <li><a href="#">Galerie</a></li>
                <li><a href="index.php">Rezervace</a></li>
            </ul>
        </nav>
    </header>
    <div class="form-container" id="loginForm">
        <h2>Přihlášení</h2>
        <form action="login_action.php" method="post">
            <div class="form-group">
                <label for="username">Uživatelské jméno:</label>
                <hr>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="password">Heslo:</label>
                <hr>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Přihlásit se</button>
            </div>
            <p>Nemáte účet? <span class="toggle-link" ><a href="register.php">Zaregistrujte se</a></span></p>
        </form>
    </div>

</body>
</html>
