<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    require "llibreria.php";
    

    if (isset($_SESSION["newses"]) or isset($_SESSION["newpass"])){
        $user = $_SESSION["newses"];
        
        $conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_login2');
    
        $roles = contRol($conn, $user);

        if ($roles == "admin"){
            consultaTotal($conn);
            conProAdm($conn);
            ?>
            <article>
                <div class="privadadd">
                    <h4>Modificar Usuari</h4>
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
                    </form><br>
                </div>
                <div class="privadadd">
                    <h4>Eliminar Usuari</h4>
                    <form action="privada.php" method="post">
                        <p>Si vols eliminar un usuari escriu el seu mail</p> 
                        <input type="text" name="deluser">
                        <input type="submit" value="eliminar">
                        <p>Tots els canvis que executarás, tindrás que refrescar la página per a poder veure aquests canvis reflexats a la taula que apareix adalt.</p>
                    </form><br>
                </div>
                <div class="privadadd">
                    <h4>Crear Usuari</h4>
                    <form action="privada.php" method="post">
                        <p>Escriu el correu que vols utilitzar per el nou usuari</p>
                        <input type="text" name="newuser">
                        <p>Escriu la contrassenya del nou usuari</p>
                        <input type="password" name="newpass">
                        <p>Escriu el rol de l'usuari</p>
                        <input type="text" name="newrole">
                        <input type="submit" name="create" value="registra">
                    <form>
                </div>
            </article>
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
                }else if(isset($_POST["deluser"])){
                    $deluser = $_POST["deluser"];
                    eliminarUsuari($conn ,$deluser);
                }else if(isset($_POST["create"])){
                    $newuser = $_POST["newuser"];
                    $newpass = $_POST["newpass"];
                    $newrole = $_POST["newrole"];
                    createUserA($conn, $newuser, $newpass, $newrole);
                }
            }
        }else if($roles == 'user'){

            consultaUsers($conn ,$user);
            echo "<br>";
            conProUser($conn, $user);


?>
                <article>
                    <div class="privadadd">
                        <form action="privada.php" method="post">
                            <h3>Modificar User</h3><br>
                            <p>Escriu el nou usuari: </p><input type="text" name="newuser"><br>
                            <p>Escriu la nova contrasenya: </p><input type="password" name="newpass"><br>
                            <input type="submit" name="update" value="OK">
                        </form><br><br>
                        <form action="privada.php" method="post">
                            <input type="submit" name="logout" value="Tornar a session.php">
                        </form>
                    </div>
                    <div class="privadadd">
                        <form action="privada.php" method="post" enctype="multipart/form-data">
                            <h3>Afegir producte</h3><br>
                            <p>Nom del producte: </p><input type="text" name="nom"><br>
                            <p>Descripcio del producte: </p><input type="text" name="descripcio"><br>
                            <p>Preu del producte: </p><input type="number" name="preu"><br>
                            <input type="submit" name="addproduct" value="Afegeix">
                        </form>
                    </div>
                    <div class="privadadd">
                        <form action="privada.php" method="post" enctype="multipart/form-data">
                            <h3>Afegir foto</h3><br>
                            <p>Id del producte per posar la foto: </p><input type="number" name="idp"><br>
                            <p>Selecciona una foto: </p><input type="file" name="fichero_usuario"><br>
                            <input type="submit" name="addfoto" value="Afegir">
                        </form>
                        <br>
                        <form action="privada.php" method="post">
                            <h3>Eliminar producte</h3><br>
                            <p>Id del producte a eliminar</p><input type="number" name="id"><br>
                            <input type="submit" value="Elimina" name="delprod">
                        </form>
                    </div>
                </article>
                <article>
                    <div class="privadd">
                        <form action="privada.php" method="post">
                            <h3>Fotos del producte</h3>
                            <p>Id del producte a mostrar: </p><input type="number" name="idp2"><br>
                            <input type="submit" value="Visualitza" name="verimg">
                        </form>
                    </div>
                    <div class="privadd">
                        <form action="privada.php" method="post">
                            <h3>Afegir categoria: </h3>
                            <p>Id del producte: </p><input type="number" name="idp">
                            <p>Id categoria: </p><input type="number" name="idcat">
                            <input type="submit" value="Afegeix" name="addcatprod">
                        </form>
                    </div>
                    <div class="privadd">
                        <form action="objectprivada.php" method="post">
                            <h3>Comprar productes</h3><br>
                            <input type="submit" value="comprar" name="comprar">
                        </form>
                    </div>
                </article>

<?php
                $resultat = null;
                if ($_SERVER['REQUEST_METHOD']=='POST'){
                    if (isset($_POST["logout"])){
                        closeS();
                    }else if (isset($_POST["newuser"]) and isset($_POST["newpass"])){
                        $newuser = $_POST["newuser"];
                        $newpass = $_POST["newpass"];
                        usersUpdate($conn , $user, $newuser, $newpass);
                    }else if(isset($_POST["addproduct"])){
                        $newnom = $_POST["nom"];
                        $newdes = $_POST["descripcio"];
                        $newpreu = $_POST["preu"];
                        
                        addProductUser($conn, $newnom, $newdes, $newpreu, $user);
                    }else if(isset($_POST["delprod"])){
                        $id = $_POST["id"];
                        delUserProd($conn, $id, $user);
                    }else if(isset($_POST["addfoto"])){
                        $imgName = $_FILES['fichero_usuario']['name'];
                        $imgTmp = $_FILES['fichero_usuario']['tmp_name'];
                        $idp = $_POST["idp"];
                        addImageProduct($conn, $imgName, $imgTmp, $idp);
                    }else if(isset($_POST["verimg"])){
                        $idp= $_POST["idp2"];
                        verimg($conn, $idp);
                    }else if(isset($_POST["addcatprod"])){
                        $idp = $_POST["idp"];
                        $idcat = $_POST["idcat"];
                        addProdCat($conn, $idp, $idcat);
                    }
                }
        }
    }else{
        header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/a7/session.php");
    }
?>
</body>
</html>

