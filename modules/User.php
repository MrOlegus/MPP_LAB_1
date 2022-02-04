<?php

function AddVisiting($link, $pageName)
{
    $currentDate = date('Y-m-d', time());
    $dateResource = mysqli_query($link, "SELECT Date FROM Visiting WHERE Date = '" . $currentDate . "'");
    $isCurrentDateInTable = mysqli_fetch_assoc($dateResource);
    
    if (!$isCurrentDateInTable)
    {
        mysqli_query($link, "INSERT INTO `Visiting` (`Date`, `" . $pageName . "`) VALUES ('" . $currentDate . "', 0)");
    }
    
    mysqli_query($link, "UPDATE `Visiting` SET `". $pageName ."`=`" . $pageName . "`+1 WHERE `Date`='" . $currentDate . "'");
    
}

function DeleteOldSessions($sessionAge)
{
    session_save_path("/tmp/f0586911");
    
    if ($sessionDir = opendir(session_save_path())) {
        while ($file = readdir($sessionDir))
        {
            if($file != '.' && $file != '..')
            {
                $dTime = time() - filemtime(session_save_path() . "/" . $file);
                if ($dTime > $sessionAge)
                {
                    unlink(session_save_path() . "/" .$file);
                }
            } 
        }
        closedir($sessionDir);
        return true;
    } else 
    {
        return false;
    }
}

function OnlineUsers($activeTime) // $activeTime - время, за которое пользователь должен перейти на страницу
{
    session_save_path("/tmp/f0586911");
    
    if ($sessionDir = opendir(session_save_path()))
    {
        $count = 0;
        while ($file = readdir($sessionDir))
        {
            if($file != '.' && $file != '..')
            {
                //echo $file . " " . (time() - filemtime(session_save_path() . "/" . $file)) . "<br>";
                $dTime = time() - filemtime(session_save_path() . "/" . $file);
                if ($dTime < $activeTime)
                {
                    $count++;
                }
            } 
        }
        closedir($sessionDir);
        return $count;
    } else 
    {
        return false;
    }
}

function CreateUserSession()
{
    //mkdir("/tmp/f0586911");
    session_save_path("/tmp/f0586911");
    session_start();
    touch("/tmp/f0586911/sess_" . session_id());
}

function isValidLogin($login)
{
    if (strlen($login) > 20) return false;
    $pattern = '/[a-z, A-Z][a-z, A-Z, 0-9]*/';
    return preg_match($pattern, $login) == 1;
}

function isValidPassword($password)
{
    if (strlen($password) > 20) return false;
    $pattern = '/[a-z, A-Z, 0-9]{5,}/';
    return preg_match($pattern, $password) == 1;
}

function GetNotValidLoginMessage()
{
    return "Логин может содержать английские буквы и цифры. Логин должен начинаться с буквы.";
}

function GetNotValidPasswordMessage()
{
    return "Пароль может содержать английские буквы и цифры. Минимальная длина пароля - 5 символов.";
}

function GetRepeatedLoginMessage()
{
    return "Данный логин уже занят.";
}

function GetWrongPasswordOrLoginMessage()
{
    return "Неверный логин или пароль.";
}

function RegisterUser($link, $login, $password)
{
    mysqli_query($link, "INSERT INTO `Users`(`login`, `password`) VALUES ('" . $login . "', '" . md5($password) . "')");
}

function EnterUser($login)
{
    CreateUserSession();
    $_SESSION['login'] = $login;
}

function LoginIsInBase($link, $login)
{
    $loginResourse = mysqli_query($link, "SELECT * FROM Users WHERE login = '" . $login . "'");
    $baseLogin = mysqli_fetch_assoc($loginResourse)['login'];
    if ($baseLogin) return true;
    return false;
    
}

function PasswordIsCorrect($link, $login, $password)
{
    $userResourse = mysqli_query($link, "SELECT * FROM Users WHERE login = '" . $login . "'");
    $user = mysqli_fetch_assoc($userResourse);
    if ($user == null)
    {
        return false;
    }
    if ($user['password'] == md5($password)) 
    {
        return true;
    }
    return false;
}

function GetTaskByPos($link, $pos, $columnCount)
{
    $taskResourse = mysqli_query($link, "SELECT * FROM Tasks WHERE `pos`='" . $pos . "' AND `columnCount`='" . $columnCount . "'");
    $task = mysqli_fetch_assoc($taskResourse);
    return $task;
}

function GetSolvedTasks($link, $login)
{
    $userResourse = mysqli_query($link, "SELECT * FROM Users WHERE `login`='" . $login . "'");
    $user = mysqli_fetch_assoc($userResourse);
    $solvedTasks = $user['solvedTasks'];
    $m = preg_split('/\s+/', $solvedTasks, -1, PREG_SPLIT_NO_EMPTY);
    return $m;
}

function AddTaskToUser($link, $login, $ID)
{
    $m = GetSolvedTasks($link, $login);
    if (!in_array($ID, $m))
    {
        $s = "";
        foreach ($m as $elem)
        $s = $s . $elem . " ";
        $s = $s . $ID;
        mysqli_query($link, "UPDATE `Users` SET `solvedTasks`='" . $s . "' WHERE `login`='" . $login . "'");
    }
}

function IsCorrectAnswer($task, $answer)
{
    for ($i = 0; $i < strlen($task); $i++)
    if ((($task[$i] == 'g') || ($task[$i] == 'c') || ($task[$i] == 'q')) && ($answer[$i] != 'c'))
        return false;
    return true;
}