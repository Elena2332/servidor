<?php
session_start();
include 'libmenu.php';
    function dibujar()
    {
        if(isset($_SESSION['platos']))
        {
            $total = 0;
            $txtHtml = "SU ELECCION: <br/>";
            if(isset($_SESSION['platos']['Primero']))
            {
                $precio = damePrecio($_SESSION['platos']['Primero']);
                $total = $total + $precio;
                $txtHtml = $txtHtml.'<br/>Primer plato: '.$_SESSION['platos']['Primero'].'---------'.$precio;
            }
            if(isset($_SESSION['platos']['Segundo']))
            {
                $precio = damePrecio($_SESSION['platos']['Segundo']);
                $total = $total + $precio;
                $txtHtml = $txtHtml.'<br/>Segundo plato: '.$_SESSION['platos']['Segundo'].'---------'.$precio;

            }
            if(isset($_SESSION['platos']['Postre']))
            {
                $precio = damePrecio($_SESSION['platos']['Postre']);
                $total = $total + $precio;
                $txtHtml = $txtHtml.'<br/>Postre: '.$_SESSION['platos']['Postre'].'---------'.$precio;
            }
            if(isset($_SESSION['platos']['Bebida']))
            {
                $precio = damePrecio($_SESSION['platos']['Bebida']);
                $total = $total + $precio;
                $txtHtml = $txtHtml.'<br/>Bebida: '.$_SESSION['platos']['Bebida'].'---------'.$precio;
            }
            $descuento = $_SESSION['usuario'][1];
            $total = $total-($total*($descuento/100));
            $txtHtml = $txtHtml.'<br/>TOTAL: ---------'.$total;
            return $txtHtml;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinPedido</title>
</head>
<body>
    <?php echo dibujar();?><br/>
    <a href="entrada.php?cerrar=true">Otro pedido</a>
</body>
</html>