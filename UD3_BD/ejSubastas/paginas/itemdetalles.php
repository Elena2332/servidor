<?php 
    //DETALLES PUJAS DEL ITEM
    session_start();
    $idSeleccionado = -1;
    if(!isset($_GET['id']))
    {
        header('Location: '.$_SESSION['ultimaPag']);
        exit();
    }
    else
    {
        $idSeleccionado = $_GET['id'];
        if(isset($_SESSION['id']))
            $_SESSION['ultimaPag'] = 'itemdetalles.php?id='.$idSeleccionado;
    }

    $item = obtenerItemId($id);
    
    function dibujarTabla()
    {
        $txtHTML = '<table><tr> <td><input type="number" name="inpPuja"/></td> <td><input type="submit" name="btnPujar"/>';
        if(!isset($_POST['btnPuja']))
            $txtHTML = $txtHTML.'</td>';
        else
        {
            if(pujasDia() >= 3)
                $txtHTML = $txtHTML.'<p style="color:red;"> Limite de 3 pujas por dia </p></td>';
            else
            {
                $puja = $_POST['inpPuja'];
                if(!empty($puja)(float)$puja <= pujaMayor())
                    $txtHTML = $txtHTML.'<p style="color:red;"> Puja muy baja </p></td>';
            }
        }
        $txtHTML = $txtHTML.'</tr></table>';
        return $txtHTML;
    }

    function dibujarHistorial()
    {
        $txtHTML = '<h2>Historial de la puja</h2> <ul>';
        $pujas = pujasPorItemDatos();
        $txtHTML = $txtHTML.'</ul>';
        return $txtHTML;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITULO; ?></title>
</head>
<body>
    <div>
        <h2><?php echo $item['nombre']; ?></h2>
        <p>
            <?php 
                echo 'Numero de pujas:'.pujasPorItemNum($id);
                if(is_null($pujaMax))
                    echo ' - Precio actual:'.$item['preciopartida'].MONEDA;
                else
                    echo ' - Precio actual:'.$pujaMax.MONEDA;
                echo ' - Fecha fin para pujar:'.$item['fechafin'];
            ?>
        </p>
        <?php echo obtenerImagenes(); ?> 
        <p> <?php echo $item['descripcion'] ?> </p>
    </div>

    <div>
        <h2>Puja por este item</h2>
        <?php
            if(!isset($_SESSION['id']))
                echo 'Para pujar, debes autenticarte <a href="login.php"><strong>aqui</strong></a>';
            else
            {
                echo 'Añade tu puja en el cuadro inferior:';
                echo dibujarTabla();
                echo dibujarHistorial();
            }
        ?>
    </div>
</body>
</html>

