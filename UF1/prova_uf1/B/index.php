<?php
session_start();
if(isset($_POST["login"])){
    $mail=$_POST["mail"];
    $pass=md5($_POST["pass"]);
    $conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_db_proba');
    $sql = "SELECT * FROM usuaris_examen WHERE username = '$mail' and password = '$pass'";
    $result = $conn->prepare($sql);
    $result->execute();
    $result->bind_result( $tid, $tnom, $tmail, $tpass);
    while($result->fetch()){
        if($mail==$tmail and $pass==$tpass){
            $_SESSION["user"]=$mail;
            $_SESSION["pass"]=$pass;
            header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/prova_uf1/B/home.php");
        }
    }
    
}else if(isset($_POST["recovery"])){
    header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/prova_uf1/B/recovery.php");
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
    <form action="index.php" method="post">
        <label>Email</label><input type="text" name="mail">
        <label>Password</label><input type="password" name="pass">
        <input type="submit" name="login" value="login">
    </form>
    <form action="index.php" method="post">
        <label>Si no recordes la contrassenya prem aqui per a tenir una de nova</label><input type="submit" name="recovery" value="recovery">
    </form>
</body>
</html>