<?php

function MySqlConnect()
{
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'f0586911_socoban';
    return mysqli_connect($host, $user, $pass, $db_name);
}