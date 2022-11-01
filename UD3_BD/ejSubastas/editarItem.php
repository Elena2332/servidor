<?php
    // EDITAR ITEM 
    include 'config.php';
    session_start();
    $item = obtenerItemId($_GET['id']);
    $errores = "";

    function dibujarImagenes()
    {
        global $item;
        $txtHTML = "";
        $res = obtenerImagenes($item['id']); 
        if(mysqli_num_rows($res) > 0)  // hay imagenes
        {
            while($img = mysqli_fetch_assoc($res))
                $txtHTML = $txtHTML.'<img src="./img/'.$img['imagen'].'" alt="'.$img['imagen'].'" width="170"/>';
        }
        else
            $txtHTML = "No hay imagenes del item.";
        return $txtHTML;
    }
?>
<html>
    <head>
        <title>Editar item</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="./estilos/estilo.css">
    </head>
    <body>
        <?php require_once("./cabecera.php") ?>

        <div id="container">
            <div id="bar">
                <?php require_once("./bar.php") ?>
            </div>
            <div id="main">
                <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h2><?php echo $item['nombre'] ?></h2>
                    <table>
                        <tr> 
                            <td> Precio de salida: <?php echo $item['preciopartida'].MONEDA; ?></td>
                            <td>
                                <input type="text" name="inpPrecio"/> 
                                <button type="submit" name="btnBajar">BAJAR</button>
                                <button type="submit" name="btnSubir">SUBIR</button>
                            </td> 
                        </tr>
                        <tr> 
                            <td> Fecha de fin para pujas:  <?php echo $item['fechafin']; ?></td>
                            <td>
                                <button type="submit" name="btnPosHora">Posponer 1 hora</button>
                                <button type="submit" name="btnPosDia">Posponer 1 dia</button>  
                            </td> 
                        </tr>
                    </table>

                    <h2>Imagenes actuales</h2>
                    <?php dibujarImagenes(); ?>
                    <table>
                        <tr> 
                            <td> Imagen a subir: </td>
                            <td>
                                <input type="file" name="inpImg"/> 
                            </td> 
                        </tr>
                        <tr> 
                            <td colspan="2"><button type="submit" name="btnSubirImg">Subir</button></td>
                        </tr>
                    </table>    
                    <p style="color:red;"><?php echo($errores); ?></p>
                </form>
            </div>
        </div>
    </body>
</html>