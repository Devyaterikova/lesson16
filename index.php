<?php
require __DIR__."/vendor/autoload.php";

?>
<!doctype html>
<html lang="ru">
<head>
    <title>Домашнее задание к лекции 5.1 «Менеджер зависимостей Composer»</title>
</head>
<body>
<form method="post">
    <input type="text" name="address" placeholder="Адрес">
    <input type="submit" value="Найти">
</form>
<?php

$api = new \Yandex\Geo\Api();

// Можно искать по точке
$api->setPoint(30.5166187, 50.4452705);
if(isset($_POST['address']))
{
    $address = strip_tags(htmlspecialchars($_POST['address']));

// Или можно икать по адресу
$api->setQuery("$address");

// Настройка фильтров
$api
    ->setLimit(100) // кол-во результатов
    ->setLang(\Yandex\Geo\Api::LANG_RU) // локаль ответа
    ->load();

$response = $api->getResponse();
$response->getFoundCount(); // кол-во найденных адресов
$response->getQuery(); // исходный запрос
$response->getLatitude(); // широта для исходного запроса
$response->getLongitude(); // долгота для исходного запроса

// Список найденных точек
$collection = $response->getList();
$arr_data = [];
foreach ($collection as $item) {
    $item->getAddress(); // вернет адрес
    $item->getLatitude(); // широта
    $item->getLongitude(); // долгота
    $arr_data = $item->getData(); // необработанные данные
    $address_get = $arr_data['Address'];
    $long_get = $arr_data['Longitude'];
    $lat_get = $arr_data['Latitude'];
    if(isset($arr_data['LocalityName']))
    {
        $name = $arr_data['LocalityName'];
    }
    else
    {
        $name = $address;
    }
?>
    <a href="map.php?lat=<?=$lat_get?>&long=<?=$long_get?>&addr=<?=$address_get?>&name=<?=$name?>"><?=$address_get?></a><br>
<?php }} ?>
</body>
</html>
