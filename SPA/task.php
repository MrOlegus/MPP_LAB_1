<script src="./modules/Table.js"></script>
<?php>
    require './modules/MySql.php';
    require './modules/User.php';
    require './modules/Content.php';
    
    CreateUserSession();
    
    $link = MySqlConnect();
    AddVisiting($link, "task.php");
?>

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
    if ($_POST['currentPos'])
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