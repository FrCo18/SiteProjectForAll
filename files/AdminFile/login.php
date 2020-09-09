<?php
//Регистрация
if(isset($_POST["registrButton"])){
    $link = mysqli_connect("localhost", "root", "", "dbtest");
    if($_POST['loginr']!=""&&$_POST['passwordr1']!=""&&$_POST['passwordr2']!=""){
        if($_POST['passwordr1']==$_POST['passwordr2']){
            $login = $_POST['loginr'];
            $password = $_POST['passwordr2'];
            $query = "INSERT INTO users (login, password, type) VALUES ('$login', '$password', 'user')";
            $result = mysqli_query($link, $query);
            mysqli_close($link);
        }
    }
    else{
        echo "<script>alert(\"Вы заполнили не все поля!\");</script>";
    }
}
if(isset($_POST["loginButton"])){
    $link = mysqli_connect("localhost", "root", "", "dbtest");
    if($_POST['login1']!=""&&$_POST['password']!=""){
        $login = $_POST['login1'];
        $password = $_POST['password'];
        
        $queryLogin = "SELECT login FROM users WHERE login = '$login'";
        $queryPassword = "SELECT password FROM users WHERE login = '$login'";
        
        $resultLogin = mysqli_query($link, $queryLogin);
        $rowLogin = mysqli_fetch_row($resultLogin);
        
        $resultPassword = mysqli_query($link, $queryPassword);
        $rowPassword = mysqli_fetch_row($resultPassword);
        if($rowPassword[0]==$password){
            $queryType = "SELECT type FROM users WHERE login = '$login'";
            $resultType = mysqli_query($link, $queryType);
            $rowType = mysqli_fetch_row($resultType);
            session_start();
            $_SESSION['login']=$rowLogin;
            $_SESSION['type']=$rowType;
            header("Location: http://siteproject/");
        }
        else{
            echo "<script>alert(\"Не верны имя пользователя или пароль!\");</script>";
        }
        mysqli_close($link);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <?php require_once "../header.php";
         echo "<script>
         var ac = document.getElementsByClassName(\"account\");
             ac[0].style.visibility = \"visible\";
             var vihod = document.getElementsByClassName(\"vihod\");
                vihod[0].style.visibility = \"hidden\";
             </script>";
             ?>
    <div class="registerORlogin">
        <button class="login">Вход</button>
        <button class="login">Регистрация</button>
        <script>
            var login = document.getElementsByClassName("login");
            var loginform = document.getElementsByClassName("loginform");
            var regb = document.getElementsByClassName("regButton");
            var logb = document.getElementsByClassName("logButton");
            login[0].addEventListener("click", showAuthorization);
            login[1].addEventListener("click", showRegister);
            function showAuthorization(){
                loginform[0].style.opacity="1";
                loginform[0].style.zIndex="1";
                loginform[1].style.opacity="0";
                loginform[1].style.zIndex="0";
                regb[0].disabled=true;
                logb[0].disabled=false;
                loginform[0].style.visibility = "visible";
                loginform[1].style.visibility = "hidden";
            }
            function showRegister(){
                loginform[1].style.opacity="1";
                loginform[1].style.zIndex="1";
                regb[0].disabled=false;
                loginform[0].style.opacity="0";
                loginform[0].style.zIndex="0";
                logb[0].disabled=true;
                loginform[1].style.visibility = "visible";
                loginform[0].style.visibility = "hidden";
            }
        </script>
    </div>
    <div class="form">
        <form action="" method="post">
            <section class="loginform">
                <p>Вход</p>
                    <label for="login1">Логин: </label><br><input type="text" name="login1" id="login1" maxlength="20"><br>
                    <label for="password">Пароль:</label><br><input type="password" name="password" id="password" maxlength="20"><br>
                    <input type="submit" value="Вход" name="loginButton" class="button logButton">
                    
            </section>
            <section class="loginform">
                <p>Регистрация</p>
                    <label for="loginr">Логин:</label><br><input type="text" name="loginr" id="login" maxlength="20"><br>
                    <label for="passwordr1">Пароль:</label><br><input type="password" name="passwordr1" id="passwordr1" maxlength="20"><br>
                    <label for="passwordr2">Повторите пароль:</label><br><input type="password" name="passwordr2" id="passwordr2" maxlength="20"><br>
                    <input type="submit" value="Зарегистрироваться" name="registrButton" class="button regbutton">
            </section>
        </form>
    </div>
    <?php require_once "../footer.php";?>
</body>
</html>