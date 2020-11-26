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
            $conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_login2');
            ?>
            <h1>Buscador de productes per a comprar</h1>
            <form action="objectprivada.php" method="post">
                <p>Nom del producte: </p><input type="text" name="buscaN">
                <input type="submit" name="buscar" value="buscar">
            </form>
            <form action="objectprivada.php" method="post">
                <p>Id del producte per afegir a la cistella: </p><input type="number" name="idcar">
                <input type="submit" value="Afegir" name="car">
            </form>
            <form action="car.php" method="post">
                <p>Comprovar cistella</p><br>
                <input type="submit" name="cistella" value="cistella">
            </form>
            <?php
            if(isset($_POST["buscar"])){
                $buscar = $_POST["buscaN"];
                buscaCompra($conn, $buscar);
            }if(isset($_POST["car"])){
                $idp=$_POST["idcar"];
                echo "$idp";
                addCarrito($conn, $idp);
            }
        }else{
            header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/a8/session.php");
        }
    ?>

</body>
</html>