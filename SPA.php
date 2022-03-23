<?php

require_once('./modules/SPA.php');

include_once './JWT/Server/BeforeValidException.php';
include_once './JWT/Server/ExpiredException.php';
include_once './JWT/Server/SignatureInvalidException.php';
include_once './JWT/Server/src/JWT.php';
use \Firebase\JWT\JWT;

class Resp //Создаём класс, который будем возвращать
{
    public $body;
    public $login;
    
    public function __construct($body)
    {
   	    $this->body = $body;
    }
}

//Указываем в заголовках, что страница возвращает данные в формате JSON
header("Content-type: application/json; charset=utf-8");

$resp = new Resp('<h1>oops<h1>');

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

foreach(array_keys($data) as $key)
    $_POST[$key] = $data[$key];

if ($_GET['page'] == 'play')
{
    http_response_code(401);
    return;
}

if (isset($_POST['exit'])) // выход из профиля
{
    $resp = new Resp(GetPage('./SPA/profile.php'));
}
else
if (isset($_POST['registration'])) // регистрация
{
    $resp = new Resp(GetPage('./SPA/enter.php'));
}
else
if (isset($_POST['enter'])) // вход
{
    $resp = new Resp(GetPage('./SPA/enter.php'));
}
else
if (isset($_POST['review'])) // новый отзыв
{
    $resp = new Resp(GetPage('./SPA/review.php'));
}
else
if (isset($_POST['sort'])) // сортировка отзывов
{
    $resp = new Resp(GetPage('./SPA/review.php'));
}
else
if (isset($_POST['currentPos'])) // клиент прислал ответ на задачу
{
    $resp = new Resp(GetPage('./SPA/taskAnswer.php'));
}
else
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
        case 'enter': $resp = new Resp(GetPage('./SPA/enter.php')); break;
        case 'profile': $resp = new Resp(GetPage('./SPA/profile.php')); break;
    }
}

$resp->login = $_SESSION['login'];

//echo $resp->body;
die(json_encode($resp)); //Возвращаем страницу
?>