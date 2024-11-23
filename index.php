<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>METEO</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="js/app.js"></script>
</head>

<?php
require_once('CityWeather.php');
require_once('CityPrevision.php');
if (!isset($_POST['city'])) {
    $city = $_POST['city'] = "Bucaramanga"; // Ciudad predeterminada
} else {
    $city = ucfirst($_POST['city']);
}

// Clima actual
$dw = curl_init("http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&APPID=b9f2c3284d886b97fdbe265ca73b2a4c");
if ($dw) {
    curl_setopt($dw, CURLOPT_RETURNTRANSFER, true); 
    $dataWeather = curl_exec($dw);
    curl_close($dw);

    $weather = json_decode($dataWeather); 
    $cityWeather = new CityWeather($weather);
    $iconId =  $cityWeather->getIconId();
    $measureDate = $cityWeather->getMeasureDate();
    $sunrise = $cityWeather->getSunriseHourFR();
    $sunset = $cityWeather->getSunsetHourFR();
    $humidity = $cityWeather->getHumidity();
    $pressure = $cityWeather->getPressure();
    $wind = $cityWeather->getWindSpeedFR();
    $temp = $cityWeather->getTempC();
    $lat = $cityWeather->getLat();
    $lon = $cityWeather->getLon();
}

// Pronóstico
$fw = curl_init("http://api.openweathermap.org/data/2.5/forecast/daily?q=" . $city . "&cnt=6&APPID=b9f2c3284d886b97fdbe265ca73b2a4c");
if ($fw) {
    curl_setopt($fw, CURLOPT_RETURNTRANSFER, true); 
    $dataForecast = curl_exec($fw);
    curl_close($fw);

    $forecast = json_decode($dataForecast);
    $cityPrevision = new CityPrevision($forecast);
    $listDays = $cityPrevision->getList();
}
?>

<body>
    <div id="station">
        <h1>ESTACIÓN METEOROLÓGICA</h1>
        <div id="search">
            <h3>Buscar una ciudad</h3>
            <form method="POST" id="cityForm" class="cityForm">
                <input type="text" id="city" class="cityForm" name="city" placeholder="Ej: Nantes">
                <input id="submit" class="cityForm" type="submit" value="Buscar" />
            </form>
        </div>
        <h3 id="title">Clima del <?= $cityWeather->getDateFR() ?> en <?= $city ?></h3>
        <span id="cityWeather">

            <span id="info">
                <ul>
                    <li>Hora de medición: <?= $measureDate ?></li>
                    <li>Amanecer: <?= $sunrise ?></li>
                    <li>Anochecer: <?= $sunset ?></li>
                    <li>Humedad: <?= $humidity ?>%</li>
                    <li>Presión: <?= $pressure ?> hPa</li>
                    <li>Viento: <?= $wind ?></li>
                </ul>
            </span>
            <span id="icon"><img class="iconImg" src="img/<?= $iconId ?>.png" /></span>
            <span id="temp"><?= $temp ?>°C</span>
        </span>
        <span id="btn_forecast"><i id="arrowPrev" class="fa fa-arrow-circle-down fa-2x pointer"></i>
            <legend id="prev">Ver previsiones</legend>
        </span>

        <span id="forecast">
            <?php
            for ($ii = 1; $ii < count($listDays); $ii++) {
                $icon = $cityPrevision->getIconDay($ii);
                $temp = $cityPrevision->getTempC($ii);
                $day = $cityPrevision->getDay($ii);
            ?>
                <span><img class="iconImg" src="img/<?= $icon ?>.png" />
                    <p><?= $temp ?>°C<br><?= $day ?></p>
                </span>
            <?php
            }
            ?>
        </span>
    </div>
</body>
</html>