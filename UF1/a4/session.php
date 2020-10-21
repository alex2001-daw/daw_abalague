<?php
    session_start();
    require "llibreria.php";

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (isset($_POST["accept"])){
            if ($_POST["accept"] == "si"){
                setcookie('galleta',6, time() + 365 * 24 * 60 * 60); 
            }else if ($_POST["accept"] == "no"){
                header ("Location: https://www.google.com/?hl=ca");
            }
        }else {
            $_SESSION["newses"]=$_REQUEST["user"];
            $_SESSION["newpass"]=$_REQUEST["pass"];
            $comprovaciomail = validacio($_SESSION["newses"]);
            $comprovaciopass = validaciopass($_SESSION["newpass"]);
            if ($comprovaciomail == TRUE and $comprovaciopass == TRUE){ 
                if ($_REQUEST["user"]=="alex@gmail.com" and $_REQUEST["pass"]=="abcd"){
                    header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/a4/privada.php");
                }else {
                    echo "Usuari o contrasenya incorrecte.";
                }
            }else {
                echo "Contrasenya o mail sense el format indicat.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <?php
    if (!isset($_COOKIE['galleta'])){
    ?>
    <form action="session.php" method="post">
        <p>Aquest lloc utilitza cookies</p>
        <input type="submit" name="accept" value="si">
        <input type="submit" name="accept" value="no">
    </form>
    <?php
    }
    ?>



    <form action="session.php" method="post">
        <p>User: </p><input type="text" name="user"><br>
        <p>Password: </p><input type="password" name="pass"><br>
        <input type="submit" value="Accedir">
    </form>
</body>
</html>