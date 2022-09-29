<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio5</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Cantidad:</label>
        <input type="text" name="txtNum"/>
        <?php
            if(!isset($_POST["btnC"]) || $_POST["radUni"]=="1")
                echo '<input type="radio" name="radUni" value="1" checked />';
            else
                echo '<input type="radio" name="radUni" value="1" />';
            echo '<label>Euros a dolares</label>';

            if(isset($_POST["btnC"]) && $_POST["radUni"]=="0")
                echo '<input type="radio" name="radUni" value="0" checked />';
            else
                echo '<input type="radio" name="radUni" value="0" />';
            echo '<label>Dolares a euros</label>';
        ?>
        
        <button type="submit" name="btnC">CONVERTIR</button>
    </form>
    <?php
        if(isset($_POST['btnC']))
        {
            if(empty($_POST['txtNum']))
                echo 'ERROR: Introduce numero';
            else
            {
                $num = $_POST['txtNum'];
                if(!is_numeric($num))
                    echo 'ERROR: No es numerico';
                else
                {
                    $conv;
                    $handle = fopen("doc/conversion.txt", "r");
                    while (!feof($handle)) 
                    {
                        $conv = fgets($handle); 
                    }
                    fclose($handle);
                    
                    $unidad = $_POST['radUni']; // 1€ = 0.97$
                    if($unidad == '1')
                    {
                        echo ($num*$conv).'$';   // € -> $
                    }
                    else
                    {
                        echo ($num/$conv).'€';   // $ -> €
                    }
                }
            }
        }
    ?>
</body>
</html>