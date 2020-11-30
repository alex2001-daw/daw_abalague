<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="mailrecovery.php" method="post">
        <p>user que vols canviar la contrassenya: </p><input type="text" name="user">
        <p>nova contrassenya: </p><input type="text" name="pass">
        <input type="submit" name="OK" value="OK">
    </form>
    <?php
    if(isset($_POST["OK"])){
        $user = $_POST["user"];
        $pass=$_POST["pass"];
        $conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_login2');
        $sqlup = "UPDATE users SET password = '$pass' WHERE user='$user'";
        $resultat = (mysqli_query($conn, $sqlup) or die("Error". mysqli_error($conn)));
    }
    ?>
</body>
</html>