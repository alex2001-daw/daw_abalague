<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    #Variables
    $mesL = date('F');
    $mes = date("m");
    $any = date("Y");
    $fila = 1;
    $primer = date('w', mktime(0,0,0,1,$mes,$any));
    $diaActual = 1;
    $numeroDia = date('w', mktime(0,0,0,$diaActual,$mes,$any));
    $ultimDia = date('t');
    echo "<table border=1><tr><th colspan =7>$any</th></tr>";
    echo "<tr><th colspan =7>$mesL</th></tr>";
    echo "<tr><th>Domingo</th><th>Lunes</th><th>Martres</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th><th>Sabado</th></tr>";
    echo "<tr>";
    $numeroDia = $numeroDia -1;
    $primer = $primer -1;

    #Primera fila
    for ($i=0; $i<7; $i ++){
        if ($i < $primer){
            echo "<td></td>";
        } else{
            echo "<td>$diaActual</td>";
            $diaActual++;
        }
    }
    echo "</tr>";

    #Las demas filas
    while ($fila < 6){
        echo "<tr>";
        for ($i=0; $i<7; $i ++){
            if ($diaActual > $ultimDia){
                echo "<td></td>";
            }else {
                echo "<td>$diaActual</td>";
                $diaActual ++;
            }
        }
        $fila ++;
    }
    echo "</table>";

    ?>
</body>
</html>