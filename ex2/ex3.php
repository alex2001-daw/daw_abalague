<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function ultimdia($mes,$any){
        $ultimDia = 28;
        while (checkdate($mes,$ultimDia +1,$any)){
            $ultimDia++;
        }
        return $ultimDia;
    }
    $primer = date('w', mktime(0,0,0,1,$mes,$any));
    $diaActual = 1;
    $mes = date("F");
    $any = date("Y");
    $numeroDia = date('w', mktime(0,0,0,$diaActual,$mes,$any));
    $ultimDia = ultimdia($mes,$any);
    echo "<table border=1><tr><th colspan =7>$any</th></tr>";
    echo "<tr><th colspan =7>$mes</th></tr>";
    echo "<tr><th>Domingo</th><th>Lunes</th><th>Martres</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th><th>Sabado</th></tr>";
    echo "<tr>";
    for ($i=0; $i<7; $i ++){
        if ($i < $prim){
            echo "<td></td>";
        } else{
            echo "<td>$diaActual</td>";
        }
        $diaActual++;
    }
    echo "</tr>";
    echo "</table>";
    ?>
</body>
</html>


