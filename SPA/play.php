<?php 
require './modules/MySql.php';
require './modules/User.php';
require './modules/Content.php';
    
$link = MySqlConnect();
AddVisiting($link, "play.php");
            
$tasks = GetTasks($link, "difficulty");
foreach ($tasks as $task)
{
    $ID = $task['ID'];
    $rowCount = $task['rowCount'];
    $columnCount = $task['columnCount'];
    $pos = $task['pos'];
    $difficulty = $task['difficulty'];
    
    echo "<div class='task'>";
    echo "<div id='task_" . $ID . "'>
    <script type=\"text\\javascript\"> 
        CreateTableAsLink(" . $rowCount . "," . $columnCount . "," . 420 . ",'" . $pos . "','task_" . $ID ."')      ;
    </script>
    </div>";
    echo "<div class='description'><div>Сложность: " . $difficulty . "</div></div>";
    echo "</div>";
}
?>