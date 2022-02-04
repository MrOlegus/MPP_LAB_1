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
        <?php>
            require './modules/MySql.php';
            require './modules/User.php';
            require './modules/Content.php';
            
            CreateUserSession();
            
            $link = MySqlConnect();
            AddVisiting($link, "play.php");

            $enterHeaderWord = $_SESSION['login'];
            $enterHeaderWordRef = "profile.php";
            if ($enterHeaderWord == "") 
            {
                $enterHeaderWord = "войти";
                $enterHeaderWordRef = "registration.php";
            }
        ?>
        
        <header class="header">   
            <div class="headerBlock"><a class="headerWord" href="index.php">главная</a></div>
            <div class="headerBlock"><a class="headerWord" href="play.php">играть</a></div>
            <div class="headerBlock"><a class="headerWord" href="1">создать</a></div>
            <div class="headerBlock"><a class="headerWord" href="review.php">отзывы</a></div>
            <div class="headerBlock"><a class="headerWord" href=<?php echo $enterHeaderWordRef;?>><?php echo $enterHeaderWord?></a></div>
        </header>
    
        <p class = mainText>
            Здесь вы можете посмотреть отзывы наших пользователей, а также оставить свой собственый. Мы Вам доверяем, поэтому публикуем отзывы без проверки. Пожалуйста, пишите грамотно.
        </p>
        
        <form class="reviewForm" enctype="multipart/form-data" method="POST">
            <p class="mainText">Напишите свой отзыв здесь:</p>
            <textarea type="text" class="reviewArea" name="review" rows="5" cols="100"></textarea>
            
            <p class="radioMarks">
                <span><input class="radioMark" name="mark" type="radio" value="1">1</span>
                <span><input class="radioMark" name="mark" type="radio" value="2">2</span>
                <span><input class="radioMark" name="mark" type="radio" value="3">3</span>
                <span><input class="radioMark" name="mark" type="radio" value="4">4</span>
                <span><input class="radioMark" name="mark" type="radio" value="5" checked>5</span>
            </p>
    
            <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
            <p class="mainText">Прикрепить картинку:
                <input name="reviewPic" type="file" accept="image/*"/>
            </p>
            
            <p><input class="sendButton" type="submit" value="Отправить"></p>
        </form>
        
        <?php
            if (isset($_POST['review']))
            {
                if (isset($_FILES['reviewPic']))
                {
                    $uploadDir = './pics/review_pics/';
                    $tmpFileName = basename($_FILES['reviewPic']['name']);
                    $uploadFile = $uploadDir . date('Y-m-d_H-i-s_') . $tmpFileName;

                    if (!move_uploaded_file($_FILES['reviewPic']['tmp_name'], $uploadFile))
                        $uploadFile = null;
                }
                
                $id = -1;
                if (isset($_SESSION['login']))
                {
                    $name=$_SESSION['login'];
                    $authorResource =  mysqli_query($link, "SELECT * FROM `Users` WHERE `login`=\"" . $name . "\"");
                    $id = mysqli_fetch_assoc($authorResource)["ID"];
                }
                mysqli_query($link,
                "INSERT INTO `Reviews`(`AuthorID`, `Time`, `Text`, `Mark`, `picPath`) VALUES (" . $id . ", \"" . date("Y-m-d H:i:s") . "\", \"" . $_POST['review'] . "\", " . $_POST['mark'] . ", \"" . $uploadFile . "\")");
            }
        ?>
        
        <h1>Отзывы</h1>
    
        <?php
            if (isset($_POST['sort']) && ($_POST['sort'] == "Time")) $checked1 = "checked";
            else $checked1 = "";
            if (isset($_POST['sort']) && ($_POST['sort'] == "Mark")) $checked2 = "checked";
            else $checked2 = "";
        ?>
        
        <form class="sortForm" method="POST">
            <p class="mainText">Сортировать по:
                <span><input class="radioMark" name="sort" type="radio" value="Time" <?php echo $checked1 ?> >дате</span>
                <span><input class="radioMark" name="sort" type="radio" value="Mark" <?php echo $checked2 ?> >оценке</span>
                <input class="sendSortButton" type="submit" value="Показать">
            </p>
        </form>
        
        <?php
            if (isset($_POST['sort'])) $sortOrder = $_POST["sort"];
            else $sortOrder = "Time";
            PrintReviews($link, $sortOrder);
        ?>

        <footer class="footer">
            <div class="footer">По всем вопросам и пожеланиям обращаться по почте socoban1@yandex.ru</div>
        </footer>

    </body>
</html>
