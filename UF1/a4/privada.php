<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        session_destroy();
    }
    if (isset($_SESSION["newses"]) or isset($_SESSION["newpass"])){
        echo $_SESSION["newses"];
        echo "<br>";
        echo $_SESSION["newpass"];

    }else{
        header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/a4/session.php");
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
    <form action="privada.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>