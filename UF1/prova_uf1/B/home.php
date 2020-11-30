<?php
session_start();
if(isset($_SESSION["user"]) and isset($_SESSION["pass"])){
    $user=$_SESSION["user"];
    $pass=$_SESSION["pass"];
    echo "Estas dins<br>";
    echo "hola: ";
    echo $user;
    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/prova_uf1/B/index.php");
    }
}else{
    header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/prova_uf1/B/index.php");
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
    <form action="home.php" method="post">
        <input type="submit" name="logout" value="logout">
    </form>
</body>
</html>