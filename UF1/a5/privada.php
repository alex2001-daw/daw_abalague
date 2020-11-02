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

    if (isset($_SESSION["newses"]) or isset($_SESSION["newpass"])){
        $user = $_SESSION["newses"];
        
        $conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_login');
    
        $roles = contRol($conn, $user);

        if ($roles == "admin"){
            consultaTotal($conn);
            ?>
            <form action="privada.php" method="post">
                <p>Correu de l'usuari a modificar: </p>
                <input type="text" name="user"><br><br>

                <p>Escriu el nou correu</p>
                <input type="text" name="newname"><br>

                <p>Escriu la nova contrassenya</p>
                <input type="password" name="newpass"><br>

                <p>Escriu el rol</p>
                <input type="text" name="newrole"><br>

                <input type="submit" value="modificar">
            </form>
            <form action="privada.php" method="post">
                <input type="submit" name="logout" value="logout">
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                if (isset($_POST["user"]) and isset($_POST["newname"]) and isset($_POST["newpass"]) and isset($_POST["newrole"])){
                    $user = $_POST["user"];
                    $newuser = $_POST["newname"];
                    $newpass = $_POST["newpass"];
                    $newrole = $_POST["newrole"];
                    adminMod($conn, $user, $newuser, $newpass, $newrole);
                }else if(isset($_POST["logout"])){
                    closeS();
                }
            }
        }else if($roles == 'user'){

            consultaUsers($conn ,$user);
?>
                <form action="privada.php" method="post">
                    <input type="submit" name="logout" value="Tornar a session.php">
                </form>
                <form action="privada.php" method="post">
                    <p>Escriu el nou usuari: </p><input type="text" name="newuser"><br>
                    <p>Escriu la nova contrasenya: </p><input type="password" name="newpass"><br>
                    <input type="submit" name="update" value="OK">
                </form>
<?php
                $resultat = null;
                if ($_SERVER['REQUEST_METHOD']=='POST'){
                    if (isset($_POST["logout"])){
                        closeS();
                    }else if (isset($_POST["newuser"]) and isset($_POST["newpass"])){
                        $newuser = $_POST["newuser"];
                        $newpass = $_POST["newpass"];
                        $sqlup = "UPDATE users SET user = '$newuser' , password = '$newpass', role = 'user' WHERE user='$user' and password = '$pass'";
                        $resultat = (mysqli_query($conn, $sqlup) or die("Error". mysqli_error($conn)));
                        echo "Tot ha anat bé torna a session i entra de nou amb la teva nova info";
                    }
                }
            }
    
        }else{
            header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/a5/session.php");
            }
?>
</body>
</html>

