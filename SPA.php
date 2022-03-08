<?php

require_once('./modules/SPA.php');

//Указываем в заголовках, что страница возвращает данные в формате JSON
header("Content-type: application/json; charset=utf-8");

//Создаём класс, который будем возвращать
class Resp
{
    public $body;

    public function __construct($body)
    {
   	    $this->body = $body;
    }
}

$resp = new Resp('ooooooooooooooooops');

if (isset($_GET['page'])) // клиент просит страничку
{
    $page = $_GET['page'];
    switch ($page)
    {
        case '':
        case 'index': $resp = new Resp(GetPage('./SPA/index.php')); break;
        case 'play': $resp = new Resp(GetPage('./SPA/play.php')); break;
        case 'review': $resp = new Resp(GetPage('./SPA/review.php')); break;
        case 'task': $resp = new Resp(GetPage('./SPA/task.php')); break;
    }
}

//echo $resp->body;
die(json_encode($resp)); //Возвращаем страницу
?>