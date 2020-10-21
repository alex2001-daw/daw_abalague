<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="xat.css">
    <title>Document</title>
</head>
<body>
    <h1>Xat</h1>
    <div class="lectura">
    <?php
        $filew = fopen("xat.txt", "a");
        $filer = fopen("xat.txt", "r");
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $usuari = $_REQUEST["Nom"];
            $text = $_REQUEST["text"];
            fwrite($filew, "$usuari: $text".PHP_EOL);
            fclose($filew);
            while(!feof($filer)){
                echo fgets($filer)."<br>";
            }
        }else{
            while(!feof($filer)){
                echo fgets($filer)."<br>";
            }
        }
    ?>
    </div>
    <div class="escritura">
        <form action="xat.php" method="post" id="myform" name="myform">
            <label>Nom:</label> <input type="text" value="" size="30" maxlength="100" name="Nom" id="" /><br/><br/>
            <label>Text:</label><textarea name="text" id="" rows="3" cols="30"></textarea>
            <button id="mysubmit" type="submit">Envia</button><br /><br />
        </form>
    </div>
</body>
</html>