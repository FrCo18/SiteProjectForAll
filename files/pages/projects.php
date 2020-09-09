<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css" type="text/css">
    <title>SiteProject</title>
</head>
<body>
    <?php require_once "../header.php";?>
    <main>
    <?php 
        $link = mysqli_connect("localhost", "root", "", "dbtest");
        $queryVideo = "SELECT video FROM testarticles ORDER BY id DESC";
        $resultVideo=mysqli_query($link, $queryVideo);
        $queryimg = "SELECT img FROM testarticles ORDER BY id DESC";
        $resultimg=mysqli_query($link, $queryimg);
        while($rowVideo = mysqli_fetch_row($resultVideo) and $rowimg = mysqli_fetch_row($resultimg)){
            $imgOut = "";
            $name_project="";
            for($i=0;$i<mysqli_num_rows($resultVideo);$i++){
                $name_project = mb_substr($rowVideo[$i], 0, mb_strpos($rowVideo[$i],".mp4"));
                echo str_replace("_"," ",$name_project)."<br>"."<a href=\"projects/$name_project.php\">
                <img class='proj_img' src=\"../../images/articles/$rowimg[$i]\"></a><br>";
                if($_SESSION['type'][0]=='admin'){
                    echo"<form method='post' action=''>
                    <input class='button' type='submit' name='$name_project' value='Удалить'>
                </form>";
                }
                if(isset($_POST["$name_project"])){
                        unlink("projects/$name_project.php");
                        unlink("../../images/articles/$rowimg[$i]");
                        unlink("../../videos/$rowVideo[$i]");
                        $queryDel = "DELETE FROM testarticles WHERE video = '$rowVideo[$i]'";
                        $resultDel = mysqli_query($link, $queryDel);
                        echo "<script>
                                location.reload();
                            </script>";
                    }
                break;
            }
        }
        mysqli_free_result($resultVideo);
        mysqli_close($link);
    ?>
    </main>
    <?php require_once "../footer.php";?>
</body>
</html>