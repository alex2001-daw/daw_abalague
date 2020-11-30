<?php
$zero=0;
$hactual=date("H");
$mactual=date("i");
$sactual=date("s");
$hora=0;
echo "<table border=1><tr><th>Hora</th></tr>";
while ($hora<24){
    if ($hora<10){
        $hora2=$zero.$hora;
        if($hora2==$hactual){
            echo "<tr><td><b>$hora2</b></td></tr>";
        }else{
            echo "<tr><td>$hora2</td></tr>";
        }
    }else {
        if($hora==$hactual){
            echo "<tr><td><b>$hora</b></td></tr>";
        }else {
            echo "<tr><td>$hora</td></tr>";
        }
    }
    $hora ++;
}
echo "</table>";
$minut=0;
echo "<table border=1><tr><th>Minut</th></tr>";
while ($minut<69){
    if ($minut<10){
        $minut2=$zero.$minut;
        if($minut2==$mactual){
            echo "<tr><td><b>$minut2</b></td></tr>";
        }else{
            echo "<tr><td>$minut2</td></tr>";
        }
    }else {
        if($minut==$mactual){
            echo "<tr><td><b>$minut</b></td></tr>";
        }else {
            echo "<tr><td>$minut</td></tr>";
        }
    } 
    $minut ++;
}
echo "</table>";

$segons=0;
echo "<table border=1><tr><th>Segons</tr></th>";
while ($segons<59){
    if($segons<10){
        $segons2=$zero.$segons;
        if($segons2==$sactual){
            echo "<tr><td><b>$segons2</b></td></tr>";
        }else {
            echo "<tr><td>$segons2</td></tr>";
        }
    }else {
        if($segons==$sactual){
            echo "<tr><td><b>$segons</b></td></tr>";
        }else {
            echo "<tr><td>$segons</td></tr>";
        }
    }
    $segons ++;
}
echo "</table>";

?>