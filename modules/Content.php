<?php

function PrintNews($link, $newsCount, $language)
{
    $newsResource = mysqli_query($link, "SELECT * FROM `News` ORDER BY `Time` DESC LIMIT " . $newsCount);

    while ($news= mysqli_fetch_assoc($newsResource))
    {
        echo "<div class=\"news\">";
        echo $news['Content_' . $language]." <span class=\"time\">[".$news['Time']."]</span><br><br>";
        echo "</div>";
    }
}

function GetTasks($link, $param)
{
    $tasksResource = mysqli_query($link, "SELECT * FROM `Tasks` ORDER BY `" . $param . "` ASC");
    $tasks;
    $i = 0;
    while ($task= mysqli_fetch_assoc($tasksResource))
    {
        $i++;
        $tasks[$i] = $task;
    }
    
    return $tasks;
}