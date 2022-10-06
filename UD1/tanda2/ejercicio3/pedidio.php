<?php
    $GLOBALS["checkValid_input"]=true;
    $total = 0;
    if(isset($_GET["nuevoTotal"]))
        $total=$_GET["nuevoTotal"];

    if(isset($_POST['btnAniadir']))
    {
        if(empty($_POST['inpNom']) || empty($_POST['inpPrecio']) || !is_numeric($_POST['inpPrecio']))
            $GLOBALS["checkValid_input"]=false;
        else
        {
            //aniadir al fichero
            $_POST['inpPrecio']=str_replace(",",".", $_POST['inpPrecio']);
            $fich = fopen("doc/archivo.txt", "a");
            $linea = $_POST['inpNom'].';'.$_POST['inpPrecio'].PHP_EOL;  //PHP_EOL:=salto de linea
            fwrite($fich, $linea); 
            fclose($fich);

            //fichero detalles
            if(isset($_FILES["btnFile"]))
            {
                $target="doc/descripciones/".$_POST['inpNom'].".txt";
                move_uploaded_file($_FILES["btnFile"]["tmp_name"], $target);  // mueve el archivo a 'target'
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio3</title>
    <style>
        .especial
        {
            background-color: lightgray;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <tr><td colspan="4" class="especial">ELIGE TU PEDIDIO</td></tr>
        <?php
            $fich = fopen("doc/archivo.txt", "r");  
            while (!feof($fich)) 
            {
                $linea = fgets($fich); 
                $linea = explode(';',$linea);
                if(count($linea)==2)
                {
                    $precio = str_replace(",",".",$linea[1]);
                    $nuevoTotal = $total + floatval($precio);  //calcula precio total
                    echo '<tr>
                            <td>'.$linea[0].'</td>
                            <td>'.$linea[1].'</td>
                            <td><a href="?nuevoTotal='.$nuevoTotal.'">Añadir unidad</a></td>';  // pasa el total + el precio del articulo
                    //decripcion
                    $files = scandir('./doc/descripciones');
                    foreach($files as $file)
                    {
                        if(explode('.',$file)[0] == $linea[0])
                            echo '<td><a href="./doc/descripciones/'.$file.'" target="blank">descripcion</a></td>';
                        else
                            echo '<td></td>';
                    }
                    echo '</tr>';
                }
            }
            fclose($fich);   
            // <tr><td colspan="4" class="especial">TOTAL: <?php echo "${total}€"; </td></tr>      
        ?>
        <tr><td colspan="4" class="especial">TOTAL: <?php echo $total; ?>€</td></tr>
    </table>
    <br/>
    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table>
            <tr>
                <td colspan="3" class="especial">AÑADE ARTICULO</td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td colspan="2">Precio(€):</td>
            </tr>
            <tr>
                <td><input type="text" name="inpNom"/></td>
                <td><input type="text" name="inpPrecio"/></td>
                <td><input type="submit" name="btnAniadir" value="AÑADIR"/></td>                
            </tr>
            <tr>
                <td colspan="2"><input type="file" name="btnFile" /></td>
            </tr>
        </table>
    </form>
    <?php
    if(!$GLOBALS["checkValid_input"])
        echo '<p style="color:red;">Introduce articulo y precio</p>';
    ?>
</body>
</html>