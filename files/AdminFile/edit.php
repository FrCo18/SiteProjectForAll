<?php session_start();
if(!isset($_SESSION['login'])||$_SESSION['type'][0]!='admin'){
    header('Location: ..\..\index.php');
}
?>

<?php
if(isset($_POST["Upload"])){
    $video_name = $_FILES["video"]["name"];
    $video_name = str_replace(" ","_",$video_name);
    $video_tmp = $_FILES["video"]["tmp_name"];
    $article = $_POST["textarea"];
            $img_name = $_FILES["img"]["name"];
       $img_tmp = $_FILES["img"]["tmp_name"];
        if(mb_strpos($video_name, ".mp4")!=false&&mb_strpos($img_name, ".png")!=false){//Проверка на расширение
            //Отправление запроса в бд
            $link = mysqli_connect("localhost", "root", "", "dbtest");
            $query = "INSERT INTO testarticles (video, article, img) VALUES ('$video_name', '$article', '$img_name')";
            $result=mysqli_query($link, $query);
            //Отправление файлов на сервер
            try{
        move_uploaded_file($video_tmp, "../../videos/".$video_name);
        move_uploaded_file($img_tmp, "../../images/articles/".$img_name);
        //Создание файлов для выкладывания
        $name_project = mb_substr($video_name, 0, mb_strpos($video_name,".mp4"));
        
            $fd = fopen("../pages/projects/$name_project.php", 'w') or die("не удалось создать файл");
            $str = "<?php session_start(); ?>
            <!DOCTYPE html>
            <html lang=\"ru\">
            <head>
                <meta charset=\"UTF-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <link rel=\"stylesheet\" href=\"../../../css/style.css\" type=\"text/css\">
                <title>SiteProject</title>
            </head>
            <body>
                <?php require_once \"../../header.php\";?>
                <div class='videoP'><video controls=\"controls\"><source src=\"../../../videos/$video_name\"
                 type=\"video/mp4\"></video>
            <br><div class='article'>$article</div></div>
                <?php require_once \"../../footer.php\";?>
            </body>
            </html>";
            
            fwrite($fd, $str);
            fclose($fd);
            }
            catch(Exception $e){
                echo "<script>alert(\"Файлы не загружены!\");</script>";
            }
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
<?php require_once "../../files/header.php";?>
        <div class='form'>
            <form action="" method="post" enctype="multipart/form-data">
            Поддерживаются только MP4 файлы:
            <br><label for="videof" class='button'>Выбрать видео</label><input class="buttonfile" type="file" name="video" id="videof"><br>
            Поддерживаются только PNG файлы:<br>
            <label for="imgf" class='button'>Выбрать заставку</label><input class="buttonfile" type="file" name="img" id="imgf"><br>
            <textarea name="textarea" style="font-family: tahoma; font-size: 20px;" wrap="hard" cols="30" rows="15" static></textarea><br>
            <input class="button" type="submit" value="Выложить" name="Upload">
            </form>
        </div>
        <?php require_once "../../files/footer.php";?>
</body>
</html>