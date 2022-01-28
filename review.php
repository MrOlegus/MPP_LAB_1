
<!DOCTYPE html>
<html>
    <head>        
         <meta charset="utf-8">
         <meta name="keywords" content="sokoban, solve, task, online, free, сокобан, решать, задачи, онлайн">
         <meta name="description" content="Сокобан решать и составлять задачи онлайн. База задач сокобан. Турниры сокобан.">
         <title>Sokoban</title>
         <link rel="stylesheet" type="text/css" href="css/reviews.css">
         <link rel="stylesheet" type="text/css" href="css/header.css">
         <link rel="stylesheet" type="text/css" href="css/footer.css">
         <link rel="icon" href="http://f0586911.xsph.ru/pics/favicon.png" type="image/png">
    </head>
    <body>
        
        
        
        <?php
            require './modules/MySql.php';
            require './modules/User.php';
            require './modules/Content.php';
            
            CreateUserSession();
            
            $link = MySqlConnect();
            AddVisiting($link, "play.php");

            if (isset($_SESSION['login'])) $enterHeaderWord = $_SESSION['login'];
			else $enterHeaderWord="";
			
            $enterHeaderWordRef = "profile.php";
            if ($enterHeaderWord == "") 
            {
                $enterHeaderWord = "войти";
                $enterHeaderWordRef = "registration.php";
            }
        ?>
        
        <?php
        $home = "главная"; $play = "играть"; $create = "создать"; $reviews = "отзывы";
        ?>
        <header class="header">   
            <div class="headerBlock"><a class="headerWord" href="index.php"><?php echo $home;?></a></div>
            <div class="headerBlock"><a class="headerWord" href="play.php"><?php echo $play;?></a></div>
            <div class="headerBlock"><a class="headerWord" href="1"><?php echo $create;?></a></div>
            <div class="headerBlock"><a class="headerWord" href="review.php"><?php echo $reviews;?></a></div>
            <div class="headerBlock"><a class="headerWord" href=<?php echo $enterHeaderWordRef;?>><?php echo $enterHeaderWord?></a></div>
        </header>
    
        <p class = mainText>
            Здесь вы можете посмотреть отзывы наших пользователей, а также оставить свой собственый. Мы Вам доверяем, поэтому публикуем отзывы без проверки. Пожалуйста, пишите грамотно.
        </p>
        
        <form class="reviewForm" method="POST">
            <p class="mainText">Напишите свой отзыв здесь:</p>
            <textarea type="text" class="reviewArea" name="review" rows="5" cols="100"></textarea>
            
            <p class="radioMarks">
                <span><input class="radioMark" name="mark" type="radio" value="1">1</span>
                <span><input class="radioMark" name="mark" type="radio" value="2">2</span>
                <span><input class="radioMark" name="mark" type="radio" value="3">3</span>
                <span><input class="radioMark" name="mark" type="radio" value="4">4</span>
                <span><input class="radioMark" name="mark" type="radio" value="5" checked>5</span>
            </p>
    
            <p><input class="sendButton" type="submit" value="Отправить"></p>
        </form>
        
        <?php
            if (isset($_POST['review']))
            {
                $id = -1;
                if (isset($_SESSION['login']))
                {
                    $name=$_SESSION['login'];
                    $authorResource =  mysqli_query($link, "SELECT * FROM `Users` WHERE `login`=\"" . $name . "\"");
                    $id = mysqli_fetch_assoc($authorResource)["ID"];
                }
                mysqli_query($link,
                "INSERT INTO `Reviews`(`AuthorID`, `Time`, `Text`, `Mark`) VALUES (" . $id . ", \"" . date("Y-m-d") . "\", \"" . $_POST['review'] . "\", " . $_POST['mark'] . ")");
            }
        ?>
        
        <h1>Отзывы</h1>
    
        <?php
            PrintReviews($link);
        ?>

        <footer class="footer">
            <div class="footer">По всем вопросам и пожеланиям обращаться по почте socoban1@yandex.ru</div>
        </footer>

    </body>
</html>
