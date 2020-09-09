<header>
    <div class="SiteProject">
        <div class="account">
        <a href="http://siteproject/files/adminfile/login.php">Авторизоваться</a>
    <form action="../index.php" method='post' class="vihod">
<input type="submit" value="Выйти" name="vihod" class="button">
</form><style type="text/css">
.vihod{display: inline; visibility: hidden;}
.account a{right: 0px; position: absolute;}</style></div>
        <div class="sitebar">
            <!--Здесь вложено изображение-->
        </div>
        <a class='HeadNameSite' href="http://siteproject/">ProjectsVyatSU</a>
        <?php
        if(isset($_SESSION['login'])){
            $name = $_SESSION['login'][0];
        echo "<text style='color: white;'>$name</text>";
        }
        ?>
        </div>
</header>
        <script>
             var el = document.getElementsByTagName("nav");
             var el2 = document.getElementsByClassName("sitebar");
             el2[0].addEventListener("click", openNav);
             cl=0;
             function openNav(){
                 if(cl==0){
                 el[0].style.left="0px";
                 el[0].style.transitionDuration="0.3s";
                 cl=1;
                 }
                 else{
                    el[0].style.left="-450px";
                 el[0].style.transitionDuration="0.3s";
                 cl=0;
                 }
             }
         </script>
<nav>
    <ul>
        <li><a href="http://siteproject/files/pages/projects.php">Посмотреть проекты</a></li>
        <li><a href="http://siteproject/files/adminfile/UploadCheck.php">Отправить проект на рассмотрение</a></li>
        <?php 
        //$g=$_SESSION['type'][0];
        //echo "<script>alert(\"$g\");</script>";
        if($_SESSION['type'][0]=='admin'){
        echo "
        <li><a href='http://siteproject/files/AdminFile/edit.php' class='edit'>Добавить проект</a></li>";
        }
        ?>
    </ul>
</nav>
<?php
        if(!isset($_SESSION['type'])){
            echo "<script>
            var ac = document.getElementsByClassName(\"account\");
                ac[0].style.visibility = \"visible\";
                </script>";
        }
        else{
            echo "<script>
            var vihod = document.getElementsByClassName(\"vihod\");
                vihod[0].style.visibility = \"visible\";
                </script>";
            }
    ?>