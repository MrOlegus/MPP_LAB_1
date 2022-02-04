
<!DOCTYPE html>
<html>
    <head>      
         <meta name="keywords" content="sokoban, solve, task, online, free, сокобан, решать, задачи, онлайн">
         <meta name="description" content="Сокобан решать и составлять задачи онлайн. База задач сокобан. Турниры сокобан.">
         <meta charset="utf-8">
         <title>Sokoban</title>
         <link rel="stylesheet" type="text/css" href="css/registration.css">
         <link rel="stylesheet" type="text/css" href="css/header.css">
         <link rel="stylesheet" type="text/css" href="css/footer.css">
         <link rel="icon" href="http://f0586911.xsph.ru/pics/favicon.png" type="image/png">
    </head>
    <body>
        <?php>
            require './modules/MySql.php';
            require './modules/User.php';
            require './modules/Content.php';
            
            CreateUserSession();
            
            $link = MySqlConnect();
            AddVisiting($link, "registration.php");
            
            $enterHeaderWord = $_SESSION['login'];
            $enterHeaderWordRef = "profile.php";
            if ($enterHeaderWord == "") 
            {
                $enterHeaderWord = "войти";
                $enterHeaderWordRef = "registration.php";
            }
        ?>
        
        <header class="header">   
            <div class="headerBlock"><a class="headerWord" href="index.php">главная</a></div>
            <div class="headerBlock"><a class="headerWord" href="play.php">играть</a></div>
            <div class="headerBlock"><a class="headerWord" href="1">создать</a></div>
            <div class="headerBlock"><a class="headerWord" href="review.php">отзывы</a></div>
            <div class="headerBlock"><a class="headerWord" href=<?php echo $enterHeaderWordRef;?>><?php echo $enterHeaderWord?></a></div>
        </header>
        
        <form action="" class="enterForm" method="post">
			<div class="login">
				<div>Логин:</div>
				<div><input class="loginInput" name="login" maxlength="20" size="20" value=""></div>
			</div>
			<div class="password">
				<div>Пароль:</div>
				<div><input class="passwordInput" name="password" type="password" maxlength="20" size="20" value=""></div>
			</div>
			<div class="enterAndRegistration">
				<input class="enterInput" name="enter" value="Войти" type="submit">
				<input class="registrationInput" name="registration" value="Зарегестрироваться" type="submit">
			</div>
		</form>
        
        <?php
            if (isset($_POST['registration']))
            {
                if (!LoginIsInBase($link, $_POST['login']))
                {
                    if (!IsValidLogin($_POST['login']))
                    {
                        $errorText = GetNotValidLoginMessage();
                    } else
                    if (!IsValidPassword($_POST['password']))
                    {
                        $errorText = GetNotValidPasswordMessage();
                    } else
                    {
                        RegisterUser($link, $_POST['login'], $_POST['password']);
                        EnterUser($_POST['login']);
                        header("Location: http://f0586911.xsph.ru");
                    }
                } else
                {
                    $errorText = GetRepeatedLoginMessage();
                }
            }
            
            if (isset($_POST['enter']))
            {
                if (PasswordIsCorrect($link, $_POST['login'], $_POST['password']))
                {
                    EnterUser($_POST['login']);
                    header("Location: http://f0586911.xsph.ru");
                } else
                {
                    $errorText = GetWrongPasswordOrLoginMessage();
                }
            }
        ?>
        
        <div><span class="errorText"><?php echo $errorText; ?></span></div>
		
		<br><br><br><br><br><br><br><br><br><br><br><br>
		
        <footer class="footer">
            <div class="footer">По всем вопросам и пожеланиям обращаться по почте socoban1@yandex.ru</div>
        </footer>

    </body>
</html>
