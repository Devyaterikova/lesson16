<?php
$lat = $_GET['lat'];
$long = $_GET['long'];
$addr = $_GET['addr'];
$name = $_GET['name'];

?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$addr?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <style>
        html, body, #map {
            width: 80%; height: 80%; padding: 0; margin: 50px auto;
        }
    </style>
</head>
<body>
<script>
    ymaps.ready(init);

    function init () {
        var myMap = new ymaps.Map("map", {
                center: [<?=$lat?>, <?=$long?>],
                zoom: 5
            }, {
                searchControlProvider: 'yandex#search'
            }),
            myPlacemark = new ymaps.Placemark([<?=$lat?>, <?=$long?>], {
                // Чтобы балун и хинт открывались на метке, необходимо задать ей определенные свойства.
                balloonContentHeader: "<?=$addr?>",
                balloonContentBody: "<a href='https://ru.wikipedia.org/wiki/<?=$name?>'><?=$addr?></a>",
                balloonContentFooter: "<?=$lat?><br><?=$long?>",
                hintContent: "<?=$addr?>"
            });

        myMap.geoObjects.add(myPlacemark);
    }
</script>
<div id="map"></div>

</body>
</html>
