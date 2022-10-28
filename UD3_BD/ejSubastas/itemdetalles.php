<?php 
    //DETALLES PUJAS DEL ITEM
    include 'config.php';
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

    $item = obtenerItemId($idSeleccionado);
    
    if(isset($_POST['btnPuja']))  // pujar
    {
        $puja = $_POST['inpPuja'];
        if(!empty($puja)  &&  floatval($puja) <= pujaMayor($idSeleccionado))
            insertPuja($idUser, $idSeleccionado, $puja);
        header('Location: '.$_SESSION['ultimaPag']);  // actualizar historial
    }


    function dibujarTabla()
    {
        global $idSeleccionado;
        $txtHTML = '<form  enctype="multipart/form-data" method="POST" action="'.$_SERVER['PHP_SELF'].'"';
        $txtHTML = $txtHTML.'<table><tr> <td><input type="number" name="inpPuja"/></td> <td><input type="submit" name="btnPujar"/>';
        if(!isset($_POST['btnPuja']))
            $txtHTML = $txtHTML.'</td>';
        else
        {
            if(pujasDia($_SESSION['id'],$idSeleccionado) >= 3)
                $txtHTML = $txtHTML.'<p style="color:red;"> Limite de 3 pujas por dia </p></td>';
            else
            {
                $puja = $_POST['inpPuja'];
                if(!empty($puja) && floatval($puja) <= pujaMayor($idSeleccionado))
                    $txtHTML = $txtHTML.'<p style="color:red;"> Puja muy baja </p></td>';
            }
        }
        $txtHTML = $txtHTML.'</tr></table></form>';
        return $txtHTML;
    }

    function dibujarHistorial()
    {
        global $idSeleccionado, $item;
        $txtHTML = '<h2>Historial de la puja</h2> <ul>';
        $pujas = pujasPorItemDatos($idSeleccionado);
        while($puja = mysqli_fetch_assoc($pujas));
        {
            if($puja != null)
                $txtHTML = $txtHTML.'<li>'.$puja[0].' - '.$puja[1].MONEDA.'</li>';
            else
                $txtHTML = $txtHTML.'<li>Precio partida - '.$item['preciopartida'].MONEDA.'</li>';
        }
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
    <link rel="stylesheet" type="text/css" href="./estilos/estilo.css"/>
    <title><?php echo TITULO; ?></title>
</head>
<body>
<?php require_once("./cabecera.php") ?>

    <div id="container">
        <div id="bar">
            <?php require_once("./bar.php") ?>
        </div>
        <div id="main">
            <h2><?php echo $item['nombre']; ?></h2>
            <p>
                <?php 
                    echo 'Numero de pujas:'.pujasPorItemNum($idSeleccionado);
                    $pujaMax = pujaMayor($idSeleccionado);
                    if(is_null($pujaMax))
                        echo ' - Precio actual:'.$item['preciopartida'].MONEDA;
                    else
                        echo ' - Precio actual:'.$pujaMax.MONEDA;
                    echo ' - Fecha fin para pujar:'.$item['fechafin'];
                ?>
            </p>
            <?php
                $res = obtenerImagenes($idSeleccionado); 
                if(mysqli_num_rows($res) > 0)  // hay imagenes
                {
                    $imagenes = '';
                    while($img = mysqli_fetch_assoc($res))
                        $imagenes = $imagenes.'<img src="./img/'.$img['imagen'].'" alt="'.$img['imagen'].'" width="170"/>';
                    echo $imagenes;
                }
            ?> 
            <p> <?php echo $item['descripcion'] ?> </p>
            
            <h2>Puja por este item</h2>
            <?php
                if(!isset($_SESSION['id']))
                    echo 'Para pujar, debes autenticarte <a href="login.php"><strong>aqui</strong></a>';
                else
                {
                    echo 'Añade tu puja en el cuadro inferior:';
                    echo dibujarTabla();
                }
                echo dibujarHistorial();
            ?>
        </div>
    </div>
</body>
</html>
