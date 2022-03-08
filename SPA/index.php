<?php>
    require './modules/MySql.php';
    require './modules/User.php';
    require './modules/Content.php';
    
    DeleteOldSessions(60 * 30);
    CreateUserSession();
    
    
    $link = MySqlConnect();
    AddVisiting($link, "index.php");

    $enterHeaderWord = $_SESSION['login'];
    $enterHeaderWordRef = "profile.php";
    if ($enterHeaderWord == "") 
    {
        $enterHeaderWord = "войти";
        $enterHeaderWordRef = "registration.php";
    }
?>

<p class = mainText>
    На этом сайте вы сможете решать головоломки сокобан онлайн! 
    Наша база задач сокобан очень велика, так что найдутся задачи любой сложности и на любой вкус.
    Чем больше задач вы решите - тем больше желтых квадратиков появится в вашем профиле :).
    Следите за новостями, чтобы не пропустить турниры. Желаем удачи!
</p>

<h1>Новости</h1>

<?php
    PrintNews($link, 10, "ru");
?>

<?php
    $onlineUsers = "Пользователей онлайн";
    echo "<br><span class=\"online\">" . $onlineUsers . ": " . OnlineUsers(180) . "</span><br>";
    //                                                          время последней активности
?>