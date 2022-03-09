
<?php
require './modules/MySql.php';
require './modules/User.php';
require './modules/Content.php';
    
if ($_POST['currentPos'])
{
    if (IsCorrectAnswer($_POST['startPos'], $_POST['currentPos']))
    {
        echo "<h1>Задача решена!<h1>";
        
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
        echo "<h1>Неверно!<h1>";
    }
} 
?>