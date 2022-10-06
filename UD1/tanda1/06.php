<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio6</title>
    <style>
        td
        { 
            border: 1px solid black; 
            padding: 2px;
        }
        .gris
        {
            background-color: ligthgray;
        }
    </style>
</head>
<body>
    <h2>Horario</h2>
    <div>
        <table>
        <?php     
            function horario($dias,$com,$fin,$inc)
            {
                $txt = "<tr><td></td>"; //primera celda vacia
                $tds = "";
                // coloca los dias de la semana
                foreach($dias as $dia)
                {
                    $txt = $txt."<td>".$dia."</td>";
                    $tds = $tds."<td></td>";
                }
                $txt = $txt."</tr>";
                // separar las horas
                $hora = (int)explode(":",$com)[0];
                $min = (int)explode(":",$com)[1];
                $finH = (int)explode(":",$fin)[0];
                $finMin = (int)explode(":",$fin)[1];
                $seguir = true;
                while($seguir)
                {
                    // colocar fila
                    $txt = $txt."<tr><td>".darFormato($hora).":".darFormato($min)."</td>".$tds."</tr>";
                    // aplicar incremento para la siguiente
                    $min = $min+$inc;
                    $incHora = 0;
                    while($min>=60)
                    {
                        $min=$min-60;
                        $incHora++;
                    }
                    $hora = $hora+$incHora;

                    if($hora >= $finH && $min >= $finMin)
                        $seguir = false;
                }
                $txt = $txt."<tr><td>".darFormato($finH).":".darFormato($finMin)."</td>".$tds."</tr>";
                echo $txt;
            }
            function darFormato($num)  // añade el 0 delante si es solo un digito
            {
                $str="";
                if($num<10)
                    $str = '0'.$num;
                else
                    $str = $str.$num;
                return $str;
            }

            horario(["Lun","Mar","Mie","Jue","Vie","Sab","Dom"],"8:00","14:00",120);
        ?>
        </table>
    </div>
</body>
</html>