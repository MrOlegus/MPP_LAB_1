<?php

function PrintNews($link, $newsCount, $language)
{
    $newsResource = mysqli_query($link, "SELECT * FROM `News` ORDER BY `Time` DESC LIMIT " . $newsCount);

    while ($news= mysqli_fetch_assoc($newsResource))
    {
        echo "<div class=\"news\">";
        echo $news['Content_' . $language] . " <span class=\"time\">[".$news['Time']."]</span><br><br>";
        echo "</div>";
    }
}

function PrintReviews($link, $sortOrder)
{
    $reviewsResource = mysqli_query($link, "SELECT * FROM `Reviews` ORDER BY `$sortOrder` DESC");

    while ($reviews = mysqli_fetch_assoc($reviewsResource))
    {
        if ($reviews['AuthorID'] == -1)
        $author = "Anonymous";
        else
        {
            $authorResource = mysqli_query($link, "SELECT * FROM `Users` WHERE `ID`=" . $reviews['AuthorID']);
            $author = mysqli_fetch_assoc($authorResource)["login"];
        }
        echo "<div class=\"reviews\">";
        echo    "<div class=\"author_and_mark\">";
        echo        "<div class=\"author\">" . $author . "</div>";
        echo        "<div class=\"mark\" style=\"width:" . $reviews['Mark'] * 20 . "px\"></div>";
        echo    "</div>";
        
        echo    "<div>" . $reviews['Text'] . " ";
        echo    "<span class=\"time\">[".$reviews['Time']."]</span></div>";
        
        if ($reviews['picPath'] != null)
        {
            echo "<div style=\"margin-top: 10px;\"><img width=\"400\" src=\"" . $reviews['picPath'] . "\" alt=\"Простите, картинки не будет\"></div>";
        }
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