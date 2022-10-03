<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagenes</title>
    <style>
        body
        {
            diplay: flex;
        }
    </style>
</head>
<body>
    <?php
        if(!isset($_POST['btnEnviar']))
        {
    ?>
        <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
            $arr = [];
            $extensiones = ["jpg","png","jfif","gif"];
            $imagenes = scandir('./img/');
            foreach($imagenes as $img)
            {
                $ext = explode('.',$img)[1];
                if(in_array($ext, $extensiones))  // para evitar los dos ficheros que cuenta de mas
                    $arr[]=$img;          
            }

            $txt = "";
            for ($i = 0; $i< $_POST['selNum']; $i++)
            {
                $txt = $txt. "<img width = '200' height ='120'  src='./img/".$arr[$i]."'/>";
                $txt =$txt. "<input type='checkbox' name='chMeGusta[]' value='".$arr[$i]."'>
                             <label>Me gusta</label> <br>";
            }
            echo $txt;
            //IP: gethostbyname(gethostname())
        ?>
        <input type="submit" name="btnEnviar" value="ENVIAR VALORACIONES"/>
        <?php
            }  // if(!isset($_POST['btnEnviar'])
            else
            {
                echo '<h2>Gracias por tu envio</h2>';
                if(isset($_POST['chMeGusta']))
                {
                    $seleccionados = $_POST['chMeGusta'];
                    $ip = gethostbyname(gethostname());
                    $fich = fopen("doc/valoraciones.txt", "a");
                    $linea = $ip.': '.join(" ",$seleccionados).PHP_EOL;  //PHP_EOL:=salto de linea
                    fwrite($fich, $linea); 
                    fclose($fich);
                }
                else
                {
                    echo '<p>Sentimos que no le haya gustado ninguna. Fastidiate :)</p>';
                }
                echo '<a href="selec_cantidad.php">VOLVER</a>';
            }
        ?>
    </form>
</body>
</html>