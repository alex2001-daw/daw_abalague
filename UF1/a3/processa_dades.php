<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        print_r ($_REQUEST["mytext"]);
        echo "<br>";
        echo "<br>";
        print_r ($_REQUEST["myselect"]);
        echo "<br>";
        print_r ($_REQUEST["mytextarea"]);

        foreach ($_REQUEST as $calu => $valor){
            echo "$calu </br>";
            $array = (gettype($valor) == "array");
            if ($array){
                foreach($valor as $v) {
                    echo "$v </br>";
                }
            }else{
                echo "$valor </br>";
            }
        }
    ?>
</body>
</html>