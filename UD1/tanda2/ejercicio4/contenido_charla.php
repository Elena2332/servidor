<?php 
    function conversacion()
    {
        $conver = "";
        //sacar conversacion del fichero
        $fich = fopen('./doc/conversacion.txt','r');
        while(!feof($fich))
        {
            $linea = fgets($fich);
            $linea = explode(';SEPAR;',$linea);
            if(count($linea)==2)
                $conver = $conver.'<p><strong>'.$linea[0].'</strong>: '.filtrar($linea[1]).'</p>';
        }
        fclose($fich);
        return $conver;
    }
    function filtrar($msg)
    {
        $reemplazables = [];
        $reemplazos = [];
        //palabras ofensivas
        $fich = fopen('./doc/palabrasOfensivas.txt','r');
        while(!feof($fich))
        {
            $linea = fgets($fich);
            $reemplazables[] = trim($linea);
            $str = "";
            for($i=0; $i<strlen(trim($linea)) ;$i++)
                $str = $str.'*';
            $reemplazos[] = $str;
        }
        fclose($fich);
        //emoticonos
        $reemplazables[] = ":)";
        $reemplazos[] = '<img src="./img/feliz.png" width="15"/>';
        $reemplazables[] = ":(";
        $reemplazos[] = '<img src="./img/triste.png" width="15"/>';
        return str_ireplace($reemplazables, $reemplazos, $msg);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10">  <!-- recarga cada x segundos -->
    <title></title>
</head>
<body>
    <?php echo conversacion();?>
</body>
</html>
<script type="text/javascript">
    window.onload
    {
        window.scrollTo(0, document.body.scrollHeight);  // scrollea pa bajo hasta el final
    }
</script>