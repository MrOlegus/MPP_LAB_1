<?php>
    require './modules/MySql.php';
    require './modules/User.php';
    require './modules/Content.php';
    
    CreateUserSession();
    
    $link = MySqlConnect();
    AddVisiting($link, "registration.php");
?>

<form class="enterForm">
	<div class="login">
		<div>Логин:</div>
		<div><input id="editLogin" class="loginInput" name="login" maxlength="20" size="20" value=""></div>
	</div>
	<div class="password">
		<div>Пароль:</div>
		<div><input id="editPassword" class="passwordInput" name="password" type="password" maxlength="20" size="20" value=""></div>
	</div>
	<div class="enterAndRegistration">
		<input id="btnEnter" class="enterInput" name="enter" value="Войти" type="button" onclick="btnEnterOnClick()">
		<input id="btnRegistration" class="registrationInput" name="registration" value="Зарегестрироваться" type="button" onclick="btnRegistrationOnClick()">
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
                //header("Location: http://f0586911.xsph.ru");
                echo "<script>window.location.href = \"http://f0586911.xsph.ru\";</script>";
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
            //header("Location: http://f0586911.xsph.ru");
            echo "<script>window.location.href = \"http://f0586911.xsph.ru\";</script>";
        } else
        {
            $errorText = GetWrongPasswordOrLoginMessage();
        }
    }
?>

<div><span class="errorText"><?php echo $errorText; ?></span></div>

<br><br><br><br><br><br><br><br><br><br><br><br>