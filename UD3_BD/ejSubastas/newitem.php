<?php
    // NUEVO ITEM 
    include 'config.php';
    session_start();
    $hoy = explode(',',date('d,m,Y,H,i'));   // [dia,mes,anio,hora,min]
    $errores = "";

    if(isset($_POST['btnEnviar']))
    {
        global $errores;
        if(validarFecha())
        {
            if(empty($_POST['inpNom']) || empty($_POST['inpDes']) || empty($_POST['inpPrecio']))
                $errores = "rellena todos los campos";
            else
            {
                if(!isset($_SESSION['id']))
                {
                    session_start();
                    $_SESSION['ultimaPag'] = 'newitem.php';
                    header('Location: login.php');
                }
                else
                {
                    $fecha = $_POST['selAnio'].'-'. $_POST['selMes'].'-'. $_POST['selDia'].' '.dosDigitos($_POST['selHora']).':'. dosDigitos($_POST['selMin']).':00';
                    insertItem($_POST['selCategorias'],$_SESSION['id'],$_POST['inpNom'], $_POST['inpDes'], $fecha, $_POST['inpPrecio']);
                    $id = obtenerItem($_POST['selCategorias'],$_SESSION['id'],$_POST['inpNom'], $fecha, $_POST['inpPrecio']);
                    $errores = $id['id'];
                    header('Location: editarItem.php?id='.$id['id']);
                   exit();
                }
            }
        }
        else
            $errores = 'fecha no valida';
    }


    function llenarCategorias()
    {
        $categorias = obtenerCategorias();
        while($catrow = mysqli_fetch_assoc($categorias)) 
            echo "<option value='".$catrow['id']."'>".$catrow['categoria']."</option>";  //<option value='1'>flores</option>
    }

    function dibujarMins()
    {
        for($i=0; $i<60 ; $i++)
            echo '<option value="'.$i.'">'.$i.'</option>';
    }
    function dibujarHora()
    {
        for($i=0; $i<24 ; $i++)
            echo '<option value="'.$i.'">'.$i.'</option>';
    }
    function dibujarMes()
    {
        for($i=1; $i<=12 ; $i++)
            echo '<option value="'.$i.'">'.$i.'</option>';
    }
    function dibujarDias()
    {
        $dias = 31;
        for($i=1; $i<=$dias ; $i++)
            echo '<option value="'.$i.'">'.$i.'</option>';
    }
    function dibujarAnios()
    {
        global $hoy;
        $anios = intval($hoy[2])+5;
        for($i=$hoy[2]; $i<=$anios ; $i++)
            echo '<option value="'.$i.'">'.$i.'</option>';
    }

    function validarFecha()
    {
        global $hoy;   // [dia,mes,anio,hora,min]
        $anio = intval($_POST['selAnio']);
        $mes = intval($_POST['selMes']);
        $dia = intval($_POST['selDia']);
        $hora = intval($_POST['selHora']);
        $min = intval($_POST['selMin']);
        if(checkdate($mes,$dia,$anio))   //comprueba que la fecha es valida. Tiene en cuenta bisiestos
        {
            $fechaNueva = mktime($hora,$min,0,$mes,$dia,$anio);
            $fechaHoy = mktime($hoy[3],$hoy[4],0,$hoy[1],$hoy[0],$hoy[2]);
            if($fechaNueva-$fechaHoy < 0)
                return false;
            else
                return true;
        }
        else
            return false;
    }

    function dosDigitos($num)
    {
        if(strlen($num)==1)
            return '0'.$num;
        else
            return $num;
    }
?>
<html>
    <head>
        <title>Nuevo item</title>
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
                    <table>
                        <tr> 
                            <td> Categoria </td> 
                            <td>
                                <select name="selCategorias">
                                    <?php llenarCategorias(); ?>
                                </select> 
                            </td> 
                        </tr>
                        <tr> 
                            <td> Nombre </td>
                            <td><input type="text" name="inpNom" <?php if(isset($_POST['inpNom'])) echo 'value="'.$_POST['inpNom'].'"'; ?>/> </td> 
                        </tr>
                        <tr> 
                            <td> Descripcion </td>
                            <td><textarea type="text" name="inpDes"> <?php if(isset($_POST['inpDes'])) echo $_POST['inpDes']; ?></textarea> </td> 
                        </tr>
                        <tr> 
                            <td> Fecha de fin para pujas </td>
                            <td>
                                <?php if(isset($_POST['btnEnviar'])) 
                                    validarFecha();?>
                                <table>
                                    <tr>
                                        <td>Dia</td>
                                        <td>Mes</td>
                                        <td>Año</td>
                                        <td>Hora</td>
                                        <td>Minutos</td>
                                    </tr>                                    
                                    <tr>
                                        <td> <select name="selDia"> <?php dibujarDias(); ?> </select></td>
                                        <td> <select name="selMes"> <?php dibujarMes(); ?> </select></td>
                                        <td> <select name="selAnio"> <?php dibujarAnios(); ?> </select></td>
                                        <td> <select name="selHora"> <?php dibujarHora(); ?> </select></td>
                                        <td> <select name="selMin"> <?php dibujarMins(); ?> </select></td>
                                    </tr>
                                </table>    
                            </td> 
                        </tr>
                        <tr>
                            <td>Precio</td> 
                            <td><input type="number" name="inpPrecio" <?php if(isset($_POST['inpPrecio'])) echo 'value="'.$_POST['inpPrecio'].'"'; ?>/><?php MONEDA?> </td> 
                        </tr>
                        <tr>
                            <td colspan="2"> <input type="submit" name="btnEnviar" value="Enviar"/> </td>
                        </tr>
                    </table>
                    <p style="color:red;"><?php var_dump($errores); ?></p>
                </form>
            </div>
        </div>
    </body>
</html>