<?php

function MySqlConnect()
{
    $host = 'localhost';
    $user = 'f0586911_Socoban';
    $pass = 'cube3x3';
    $db_name = 'f0586911_Socoban';
    return mysqli_connect($host, $user, $pass, $db_name);
}