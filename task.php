
<!DOCTYPE html>
<html>
    <head>        
         <meta charset="utf-8">
         <meta name="keywords" content="sokoban, solve, task, online, free, сокобан, решать, задачи, онлайн">
         <meta name="description" content="Сокобан решать и составлять задачи онлайн. База задач сокобан. Турниры сокобан.">
         <title>Sokoban</title>
         <link rel="stylesheet" type="text/css" href="css/task.css">
         <link rel="stylesheet" type="text/css" href="css/header.css">
         <link rel="stylesheet" type="text/css" href="css/footer.css">
         <link rel="icon" href="http://f0586911.xsph.ru/pics/favicon.png" type="image/png">
    </head>
    <body>
        <script src="./modules/Table.js"></script>
        <?php
            require './modules\MySql.php';
            require './modules\User.php';
            require './modules\Content.php';
            
            CreateUserSession();
            
            $link = MySqlConnect();
            AddVisiting($link, "task.php");

            if (isset($_SESSION['login']))
            {
            $enterHeaderWord = $_SESSION['login'];
            $enterHeaderWordRef = "profile.php";
            }
            else
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
        
        <div class="taskAndRows">
            <?php 
                $pos = $_GET['task'];
                $rowCount = $_GET['rowCount'];
                $columnCount = $_GET['columnCount'];
                
                echo "<div class='task'>";
                echo "<div id='task_" . $pos . "'><script> CreateTable(" . $rowCount . 
                "," . $columnCount . "," . 420 . ",'" . $pos . "','task_" . $pos ."'); </script></div>";
                echo "</div>";
                
                
            ?>
            <div class="rows">
                <form>
                    <input class="up" name="up" id="up" type="button">
                    <br>
                    <input class="left" name="left" id="left" type="button">
                    <input class="right" name="right" id="right" type="button">
                    <br>
                    <input class="down" name="down" id="down" type="button">
                </form>
            </div>
        </div>
        
        <form action="" class="checkForm" method="post">
			<input id="currentPos" name="currentPos" value="" type="hidden">
			<input class="checkInput" name="check" value="Проверить" type="submit">
        </form>
        
        <?php
        echo "<script> updateCycle(" . $rowCount . "," . $columnCount . ",'" . $pos . "');</script>";
        ?>
        
        <?php
            if (@$_POST['currentPos'])
            {
                if (IsCorrectAnswer($_GET['task'], $_POST['currentPos']))
                {
                    echo "<span class='winText'>Задача решена!</span>";
                    
                    if (isset($_SESSION['login']))
                    {
                        $task = GetTaskByPos($link, $_GET['task'], $_GET['columnCount']);
                        if ($task)
                        {
                            AddTaskToUser($link, $_SESSION['login'], $task['ID']);
                        }
                    }
                } else
                {
                    echo "<span class='loseText'>Неверно!</span>";
                }
            } 
            
            
        ?>
        
        <footer class="footer">
            <div class="footer">По всем вопросам и пожеланиям обращаться по почте socoban1@yandex.ru</div>
        </footer>

    </body>
</html>
