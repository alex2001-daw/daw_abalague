<?php
    function validacio($comprovaciomail){
        if (!filter_var($comprovaciomail, FILTER_VALIDATE_EMAIL)) {
            return FALSE;
        }else {
            return TRUE;
        }
    }
    function validaciopass($comprovaciopass){
        if (!preg_match("/^[a-zA-Z-' ]*$/", $comprovaciopass)) {
            return FALSE;
        }else {
            return TRUE;
        }
    }
    function closeS(){
        session_destroy();
        header ("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/a7/session.php");
    }
    function consultaUsers($conn ,$user){
        $sql = "SELECT * FROM users WHERE user = '$user'";
            
        $resultat = $conn->prepare($sql);
        $resultat->execute();
        $resultat->bind_result($tuser, $tpass, $role);
        echo "<table border=1><tr><th  colspan ='3'><p><b>Aqui son les teves dades</b></p></th></tr>";
        echo "<tr><td><b>Mail</b></td><td><b>Password</b></td><td><b>Role</b></td></tr>";
        while($resultat->fetch()){
            echo "<tr><td> $tuser </td><td> $tpass </td><td> $role </td></tr>";
        }
        echo "</table><br>";
    }

    function contRol($conn, $user){
        $sqlr = "SELECT role FROM users WHERE user = '$user'";
        $resultat = $conn->prepare($sqlr);
        $resultat->execute();
        $resultat->bind_result($roler);
        while($resultat->fetch()){
            $roler;
        }
        return $roler;
    }

    function consultaTotal ($conn){
        $sqlt = "SELECT * FROM users";
        $resultat = $conn->prepare($sqlt);
        $resultat->execute();
        $resultat->bind_result($tuser, $tpass, $trole);
        echo "<h1>Aqui son les dades de tots els usuaris: </h1><br>";
        echo "<table border=1>";
        echo "<tr><th><b>users</b></th><th><b>password</b></th><th><b>role</b></th></tr>";
        while($resultat->fetch()){
            echo "<tr><td>$tuser</td><td>$tpass</td><td>$trole</td></tr>";
        }
        echo "</table>";
    }
    function adminMod($conn, $user, $newuser, $newpass, $newrole){
        $sqla = "UPDATE users SET user = '$newuser' , password = '$newpass', role = '$newrole' WHERE user='$user'";
        $resultat = (mysqli_query($conn, $sqla) or die("Error". mysqli_error($conn)));
        echo "Tot ha anat bé torna a carregar la página per veure els canvis";
    }
    function usersUpdate($conn , $user, $newuser, $newpass){
        $sqlup = "UPDATE users SET user = '$newuser' , password = '$newpass', role = 'user' WHERE user='$user'";
        $resultat = (mysqli_query($conn, $sqlup) or die("Error". mysqli_error($conn)));
        echo "Tot ha anat bé torna a session i entra de nou amb la teva nova info.";
    }

    function eliminarUsuari($conn, $deluser){
        $sqld = "DELETE FROM users WHERE user = '$deluser'";
        $resultat = mysqli_query($conn, $sqld) or die('Consulta fallida: ' . mysqli_error($conn));
        echo "<br>Recarrega la página per veure els canvis.";
    }

    function createUserA($conn, $newuser, $newpass, $newrole){
        $sql = "INSERT INTO users (user , password, role) VALUES ('$newuser', '$newpass', '$newrole')";
        $result = (mysqli_query($conn, $sql) or die("Error: ". mysqli_error($conn)));
    }

    function addProductUser($conn, $newnom, $newdes, $newpreu, $user){
        
        $sql = "INSERT INTO productes (nom, descripcio, preu, id_user) VALUES ('$newnom', '$newdes', $newpreu, '$user')";
        $result = (mysqli_query($conn, $sql) or die("Error: ". mysqli_error($conn)));
            
    }

    function addProdCat($conn, $idp, $idcat){
        $sql = "INSERT INTO prod_cat VALUES ($idp, $idcat)";
        $result = (mysqli_query($conn, $sql) or die("Error: ". mysqli_error($conn)));
    }

    function addImageProduct($conn, $imgName, $imgTmp, $idp){
        $target_path = "images/";  
        $target_path = $target_path.basename($imgName);  
        
        if(move_uploaded_file($imgTmp, $target_path)) {  
            echo "File uploaded successfully!";  

            $sqlim = "INSERT INTO imatges (nom, ruta, id_producte) values ('$imgName', '$target_path', $idp)";
            $result = (mysqli_query($conn, $sqlim) or die("Error: ". mysqli_error($conn)));
        }else{  
            echo "Sorry, file not uploaded, please try again!";  
        }  
    }

    function conProUser($conn, $user){
        $sql = "SELECT id, nom, descripcio, preu FROM productes WHERE id_user = '$user'";
        
        $resultat = $conn->prepare($sql);
        $resultat->execute();
        $resultat->bind_result($tid, $tnom, $tdes, $tpreu);


        echo "<table border=1><tr><th  colspan ='4'><p><b>Els teus productes</b></p></th></tr>";
        echo "<tr><td><b>Id</b></td><td><b>Nom</b></td><td><b>Descripcio</b></td><td><b>Preu</b></td></tr>";
        while($resultat->fetch()){
            echo "<tr><td> $tid </td><td> $tnom </td><td> $tdes </td><td> $tpreu </td></tr>";
        }
        echo "</table><br>";
    }

    function delUserProd($conn, $id, $user){
        $sql = "DELETE FROM productes WHERE id_user = '$user' and id = $id";
        $result = (mysqli_query($conn, $sql) or die("Error: ". mysqli_error($conn)));
    }

    function verimg($conn, $idp){
        $sql="SELECT ruta FROM imatges WHERE id_producte =$idp";
        $resultat = $conn->prepare($sql);
        $resultat->execute();
        $resultat->bind_result($truta);
        echo "<h2>Galeria</h2>";
        while($resultat->fetch()){
            echo "<img src='$truta' width='100px' height='50px'>";
        }
    }

    function conProAdm($conn){
        $sql="SELECT * FROM productes";
        $resultat=$conn->prepare($sql);
        $resultat->execute();
        $resultat->bind_result($tid, $tnom, $tdes, $tpreu, $tid_cat, $tid_user);
        echo "<table border=1><tr><th colspan='6'><h3>Productes dels usuaris</h3></th></td>";
        echo "<tr><td><b>ID</b></td><td><b>Nom</b></td><td><b>Descripcio</b></td><td><b>Preu</b></td><td><b>ID_catecoria</b></td><td><b>Usuari</b></td></tr>";
        while($resultat->fetch()){
            echo "<tr><td>$tid</td><td>$tnom</td><td>$tdes</td><td>$tpreu €</td><td>$tid_cat</td><td>$tid_user</td>";
        }
    }

    function visualSess($conn){
        $sql = "SELECT id, nom, descripcio, preu FROM productes";
        
        $resultat = $conn->prepare($sql);
        $resultat->execute();
        $resultat->bind_result($tid, $tnom, $tdes, $tpreu);


        echo "<table border=1><tr><th  colspan ='4'><p><b>Els teus productes</b></p></th></tr>";
        echo "<tr><td><b>Id</b></td><td><b>Nom</b></td><td><b>Descripcio</b></td><td><b>Preu</b></td></tr>";
        while($resultat->fetch()){
            echo "<tr><td> $tid </td><td> $tnom </td><td> $tdes </td><td> $tpreu </td></tr>";
        }
        echo "</table><br>";
    }

    function oneProduct($conn, $idp){
        $sql="SELECT nom, descripcio, preu FROM productes where id=$idp";
        $resultat = $conn->prepare($sql);
        $resultat->execute();
        $resultat->bind_result($tnom, $tdes, $tpreu);

        echo "<table border=1><tr><th colspan='4'><h3>Productes dels usuaris</h3></th></td>";
        echo "<tr><td><b>ID</b></td><td><b>Nom</b></td><td><b>Descripcio</b></td><td><b>Preu</b></td></tr>";
        while($resultat->fetch()){
            echo "<tr><td>$idp</td><td>$tnom</td><td>$tdes</td><td>$tpreu €</td></tr>";
        }
        echo "</table>";
    }
?>