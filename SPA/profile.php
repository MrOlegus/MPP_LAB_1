<?php>
    require './modules/MySql.php';
    require './modules/User.php';
    require './modules/Content.php';
    
    CreateUserSession();
    
    $link = MySqlConnect();
    AddVisiting($link, "profile.php");
?>

<h1><?php echo $_SESSION['login']; ?></h1>

<?php 
    $tasks = GetTasks($link, 'difficulty');
    $solvedTasks = GetSolvedTasks($link, $_SESSION['login']);
    for ($i = 1; $i <= count($tasks); $i++)
    {
        $addedClass = "";
        if (in_array($tasks[$i]['ID'], $solvedTasks))
            $addedClass = " solvedTask";
        if (($i == 1) || ($tasks[$i - 1]['difficulty'] != $tasks[$i]['difficulty']))
            echo "<div><br><div class='difficulty'>Сложность: " . $tasks[$i]['difficulty'] . "</div><br>";
        $taskRef = "task?task=" . $tasks[$i]['pos'] . "&columnCount=" . $tasks[$i]['columnCount'] . "&rowCount=" . $tasks[$i]['rowCount'];
        echo "<div class='taskRefDiv" . $addedClass . "'><a class='taskRef link_internal' href=" . $taskRef . ">" . $tasks[$i]['ID'] . "</a></div>";
        if (($i == count($tasks)) || ($tasks[$i + 1]['difficulty'] != $tasks[$i]['difficulty']))
        echo "</div>";
    }
?>

<form class="exitForm">
	<input id="btnExit" class="exitInput" name="exit" value="Выйти" type="button" onclick="btnExitOnClick()">
</form>

<?php
if (isset($_POST['exit']))
{
    session_destroy();
    echo "<script>window.location.href = \"http://f0586911.xsph.ru\";</script>";
}
?>