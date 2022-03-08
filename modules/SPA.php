<?php

function GetPage($pageName)
{
    ob_start();
    include($pageName);
    $page = ob_get_contents();
    ob_end_clean();
    return $page;
}