<!DOCTYPE html>
<html>
    <head>        
         <meta charset="utf-8">
         <meta name="keywords" content="sokoban, solve, task, online, free, сокобан, решать, задачи, онлайн">
         <meta name="description" content="Сокобан решать и составлять задачи онлайн. База задач сокобан. Турниры сокобан.">
         <title>Sokoban</title>
         <link rel="stylesheet" type="text/css" href="css/play.css">
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
        
        <script src="./modules/Table.js"></script>
        
        <?php 
        $tasks = GetTasks($link, "difficulty");
        foreach ($tasks as &$task)
        {
            $ID = $task['ID'];
            $rowCount = $task['rowCount'];
            $columnCount = $task['columnCount'];
            $pos = $task['pos'];
            $difficulty = $task['difficulty'];
            
            echo "<div class='task'>";
            echo "<div id='task_" . $ID . "'><script> CreateTableAsLink(" . $rowCount . 
            "," . $columnCount . "," . 420 . ",'" . $pos . "','task_" . $ID ."'); </script></div>";
            echo "<div class='description'><div>Сложность: " . $difficulty . "</div></div>";
            echo "</div>";
        }
        ?>

        <footer class="footer">
            <div class="footer">По всем вопросам и пожеланиям обращаться по почте socoban1@yandex.ru</div>
        </footer>

    </body>
</html>
