<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kadeřnictví Láska - Web Design</title>
    <link rel="stylesheet" href="style.css">
    <style>
  
        main {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Kadeřnictví Láska logo">
        </div>
        <nav>
            <ul>
            <li><a href="login.php">login</a></li>
                <li><a href="#">Novinky</a></li>
                <li><a href="#section2">Služby</a></li>
                <li><a href="index.php">Rezervace</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="section1" class="section">
            <div class="opening-hours">
                <h2>Otevírací doba</h2>
                <div class="hours-list">
                    <p>PONDĚLÍ: 8-12:30 / 13-17:30</p><br>
                    <p>ÚTERÝ: 8-12:30 / 13-17:30</p><br>
                    <p>STŘEDA: 8-12:30 / 13-17:30</p><br>
                    <p>ČTVRTEK: 8-12:30 / 13-17:30</p><br>
                    <p>PÁTEK: 8-12:30 / 13-17:30</p><br>
                    <p>SOBOTA: 8-11:30</p><br>
                    <p>NEDĚLE: ZAVŘENO</p><br>
                </div>
            </div>
            <div class="image-container">
                <img  alt="Kadeřnictví Image">
            </div>
        </section>
    </main>
        <div class="block"></div>
    <div class="divmain">

        <section id="section2" class="section">
            <div class="services1">
                <h2>Ceník Služeb</h2>
                <div class="service-list">
                    <div class="service">
                        <div class="service-title">Pánský střih</div>
                        <div class="service-description">000 Kč - Střih vlasů, stínování (fade), podle fotky</div>
                    </div>
                    <div class="service">
                        <div class="service-title">Dětský střih</div>
                        <div class="service-description">000 Kč - Střih vlasů, stínování (fade), do 10 let</div>
                    </div>
                    <div class="service">
                        <div class="service-title">Střih vousů</div>
                        <div class="service-description">000 Kč - Úprava vousů, zaholeni kontur, úprava kníru</div>
                    </div>
                    <div class="service">
                        <div class="service-title">Exclusive servis</div>
                        <div class="service-description">000 Kč - Střih vlasů, stínování (fade), mytí, foukání, styling, úprava vousů, úprava kníru</div>
                    </div>
                    <div class="service">
                        <div class="service-title">Dámský střih</div>
                        <div class="service-description">000 Kč - Střih vlasů</div>
                    </div>
                </div>
                <div class="reservation">
                    <button>REZERVACE</button>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
