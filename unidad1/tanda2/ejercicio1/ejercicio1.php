<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
    <style>
        p{ color:red; }
    </style>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div>
            <!-- <input name="inpTexto" type="text"/> -->
            <?php
                echo '<label>Texto a cifrar: </label>';
                if(isset($_POST["btnRad"]))
                {
                        // input texto
                    if(strlen($_POST["inpTexto"]."")!=0)
                        echo '<input type="text" name="inpTexto" value="'.$_POST["inpTexto"].'"/>';
                    else
                        echo '<input type="text" name="inpTexto" />';
                }
                else
                {
                    if(isset($_POST["btnFich"]))
                    {
                        if(strlen($_POST["inpTexto"]."")!=0)
                            echo '<input type="text" name="inpTexto" value="'.$_POST["inpTexto"].'"/>';
                        else
                            echo '<input type="text" name="inpTexto" />';
                    }                        
                    else
                        echo '<input type="text" name="inpTexto" />';
                }
            ?>
        </div>
        <div>
            <label>Desplazamiento:</label>
            <?php 
                if(isset($_POST['btnRad']))
                {
                    if(isset($_POST['numDes']))
                    {
                        $seleccionado = $_POST['numDes'];
                        if($seleccionado == '3')
                            echo'<input type="radio" name="numDes" value="3" checked/>  <label>3</label>
                                <input type="radio" name="numDes" value="5"/>  <label>5</label>
                                <input type="radio" name="numDes" value="10"/> <label>10</label>';
                        else
                        {
                            if($seleccionado == '5')
                                echo'<input type="radio" name="numDes" value="3"/>  <label>3</label>
                                    <input type="radio" name="numDes" value="5" checked/>  <label>5</label>
                                    <input type="radio" name="numDes" value="10"/> <label>10</label>';
                            else
                                echo'<input type="radio" name="numDes" value="3"/>  <label>3</label>
                                    <input type="radio" name="numDes" value="5"/>  <label>5</label>
                                    <input type="radio" name="numDes" value="10" checked/> <label>10</label>';
                        }
                    }
                    else  
                    {
                        echo'<input type="radio" name="numDes" value="3"/>  <label>3</label>
                            <input type="radio" name="numDes" value="5"/>  <label>5</label>
                            <input type="radio" name="numDes" value="10"/> <label>10</label>';
                    }
                }
                else  //primera vez que entra
                {
                    echo'<input type="radio" name="numDes" value="3"/>  <label>3</label>
                        <input type="radio" name="numDes" value="5"/>  <label>5</label>
                        <input type="radio" name="numDes" value="10"/> <label>10</label>';
                }
            ?>
            <button type="submit" name="btnRad">Cifrado Cesar</button>
        </div>
        <div>
            <label>Fichero de clave:</label>
            <select name="selFich">
                <option value="./doc/cifrado1.txt">cifrado elena</option>
                <option value="./doc/cifrado2.txt">cifrado enunciado</option>
            </select>
            <button type="submit" name="btnFich">Cifrado por sustitucion</button>
        </div>
    </form>

    <?php
        if(isset($_POST['btnRad']))  //cifrado cesar
        {
            if(empty($_POST['inpTexto']))
                echo '<p>Introduce texto</p>';  
            else
            {
                if(!isset($_POST['numDes']))  //no ha seleccionado un radio
                    echo '<p>selecciona un radio</p>';
                else  
                {   //CIFRAR
                    $str = $_POST['inpTexto'];  
                    $desplazamiento = $_POST['numDes'];
                    $cadena = "";
                    for($i=0; $i<strlen($str) ;$i++)
                        $cadena = $cadena. chr(ord(substr($str,$i,1))+$desplazamiento);
                    $cadena = strtoupper($cadena);
                    echo '<br><h2>Texto cifrado: '.$cadena.'</h2>';     //mostrar RESULTADO               
                }
            }
        }
        if(isset($_POST['btnFich']))  //cifrado por sustitucion
        {
            if(empty($_POST['inpTexto']))   // no hay texto
                echo '<p>Introduce texto</p>';
            else
            {   
                //leer fichero
                $clave;
                $handle = fopen($_POST['selFich'], "r");
                $clave = fgets($handle);                 
                fclose($handle);
                
                //CIFRAR
                $letras = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
                $str = strtoupper($_POST['inpTexto']); 
                $cadena = "";
                for($i=0; $i<strlen($str) ;$i++)  //recorre la palabra a cifrar
                {
                    $car = substr($str,$i,1);  //letra actual
                    for($j=0, $seguir=true;  $j<=count($letras) && $seguir==true ;$j++)  //busca la posicion de la letra
                    {
                        if($car == $letras[$j])
                        {
                            $cadena = $cadena.substr($clave,$j,1);   //letra que corresponde de la clave
                            $seguir = false;
                        }
                    }
                }
                echo '<br><h2>Texto cifrado: '.$cadena.'</h2>';   //mostrar RESULTADO
            }        
        }
    ?>
</body>
</html>