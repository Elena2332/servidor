<?php
    /// socios.txt
    function autentica($usu,$pass) // 1:=correcto __.__  0:=incorrecto
    {
        $fich = fopen('/doc/socios.txt','r');
        while (!feof($fich)) 
        {
            $linea = fgets($fich); 
            $linea = explode(' ',$linea);
            if($usu==trim($linea[0]) && $pass==trim($linea[1]))
            {
                fclose($fich);
                return 1;
            }
        }
        fclose($fich);
        return 0;
    }

    function dameDcto($usu)  // devuelve el decuento de usu o 0 si no encuentra
    {
        $fich = fopen('/doc/socios.txt','r');
        while (!feof($fich)) 
        {
            $linea = fgets($fich); 
            $linea = explode(' ',$linea);
            if($usu==trim($linea[0]))
            {
                fclose($fich);
                return trim($linea[2]);
            }
        }
        fclose($fich);
        return 0;
    }

    /// platos.txt
    function damePlatos($tipo)  // devuelve array plato-precio
    {
        $platos = [];
        $fich = fopen('/doc/platos.txt','r');
        while (!feof($fich)) 
        {
            $linea = fgets($fich); 
            $linea = explode(' ',$linea);
            if($tipo==trim($linea[1]))           
                $platos[trim($linea[0])] = trim($linea[2]);            
        }
        fclose($fich);
        return $platos;
    }

    function damePrecio($plato)  // devuelve precio o -1 si no encuentra
    {
        $fich = fopen('/doc/platos.txt','r');
        while (!feof($fich)) 
        {
            $linea = fgets($fich); 
            $linea = explode(' ',$linea);
            if($plato==trim($linea[0]))
            {
                fclose($fich);
                return trim($linea[2]);
            }
        }
        fclose($fich);
        return -1;
    }

?>