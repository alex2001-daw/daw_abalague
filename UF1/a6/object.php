<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    require "llibreria.php";
    $conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_login2');

    if (isset($_POST["veure"])){
        $idproducte = $_POST["veure"];
        oneProduct($conn, $idproducte);
        verimg($conn, $idproducte);
    }else{
        header ("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/a6/register.php");
    }
    ?>
</body>
</html>

