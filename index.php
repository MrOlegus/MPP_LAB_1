
<!DOCTYPE html>
<html>
    <head>      
         <meta name="keywords" content="sokoban, solve, task, online, free, сокобан, решать, задачи, онлайн">
         <meta name="description" content="Сокобан решать и составлять задачи онлайн. База задач сокобан. Турниры сокобан.">
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Sokoban</title>
         <link rel="stylesheet" type="text/css" href="css/index.css">
         <link rel="stylesheet" type="text/css" href="css/header.css">
         <link rel="stylesheet" type="text/css" href="css/footer.css">
         <link rel="icon" href="http://f0586911.xsph.ru/pics/favicon.png" type="image/png">
    </head>
    <body>
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
                if ($_GET['ln'] == 'en')
                $enterHeaderWord = "enter"; else
                $enterHeaderWord = "войти";
                $enterHeaderWordRef = "registration.php";
            }
        ?>
        
        
        <?php
        $home = "главная"; $play = "играть"; $create = "создать"; $reviews = "отзывы";
        if ($_GET['ln'] == 'en')
        {
            $home = "home"; $play = "play"; $create = "create"; $reviews = "reviews";
        }
        ?>
        <header class="header">   
            <div class="headerBlock"><a class="headerWord" href="index.php"><?php echo $home;?></a></div>
            <div class="headerBlock"><a class="headerWord" href="play.php"><?php echo $play;?></a></div>
            <div class="headerBlock"><a class="headerWord" href="1"><?php echo $create;?></a></div>
            <div class="headerBlock"><a class="headerWord" href="review.php"><?php echo $reviews;?></a></div>
            <div class="headerBlock"><a class="headerWord" href=<?php echo $enterHeaderWordRef;?>><?php echo $enterHeaderWord?></a></div>
        </header>
        
        <?php
        $mainText = "На этом сайте вы сможете решать головоломки сокобан онлайн! 
            Наша база задач сокобан очень велика, так что найдутся задачи любой сложности и на любой вкус.
            Чем больше задач вы решите - тем больше желтых квадратиков появится в вашем профиле :).
            Следите за новостями, чтобы не пропустить турниры. Желаем удачи!";
        if ($_GET['ln'] == 'en')
        $mainText = "On this site you will be able to solve sokoban puzzles online and completely free of charge!
            Our database of sokoban tasks is very large, so there will be tasks of any complexity and for every taste.
            The more tasks you solve, the higher you will rise in the ranking.
            Follow the news so as not to miss the tournaments. Good luck!";
        ?>
        <p class = mainText>
            <?php echo $mainText;?>
        </p>
        
        <h1>Новости</h1>
        
        <?php
            if ($_GET['ln'] == 'en')
            PrintNews($link, 10, "en"); else
            PrintNews($link, 10, "ru");
        ?>
        
        <?php
            $onlineUsers = "Пользователей онлайн";
            if ($_GET['ln'] == 'en')
            $onlineUsers = "Оnline users";
            echo "<br><span class=\"online\">" . $onlineUsers . ": " . OnlineUsers(180) . "</span><br>";
        ?>
        
        <footer class="footer">
            <div class="footer">По всем вопросам и пожеланиям обращаться по почте socoban1@yandex.ru</div>
        </footer>

    </body>
</html>
