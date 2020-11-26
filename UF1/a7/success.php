<?php
session_start();
require "llibreria.php";

if($_GET["clau"] == $_SESSION["seguretat"]){
    $conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_login2');
    $user = $_SESSION["newses"];
    finalitzarTran($conn, $user);
    compraRealitzada($conn);
    delSess();
    echo "eureka";
}else {
    header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/a7/cancel.php");
}

