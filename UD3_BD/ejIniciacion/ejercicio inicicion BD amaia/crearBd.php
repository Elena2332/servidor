<?php
    //incluir fichero de configuracion y de metodos d gestion de Base de datos
    include_once("config.php");
    include_once("gestionBD.php");

    $mensajeUsuario="";
    $errorNombreAlimento="";
    $errorTipoAlimento="";
    $errorFechaAlimento="";
    $errorPrecioAlimento="";
    $mensajeAlimentosPorTipo="";

    //Crear conexion BD
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);

    //Llamamos al metodo de crear Tabla Alimento si viene del boton
    if(isset($_POST['insertarNuevo'])){

        $arrayInfoAlimento=array();

        // Comprobamos si el campo de nombre está vacio, si no está vacio lo incluimos en el array para pasar al metodo
        if(isset($_POST['nombreAlimento']) ){
            if (!empty($_POST['nombreAlimento'])){
                $arrayInfoAlimento['nombreAlimento']=$_POST['nombreAlimento'];
            }else{
                //Si está vacio mostramos mensaje de error
                $errorNombreAlimento=ERROR_NOMBRE_ALIMENTO;
            }    
        }

         // Comprobamos si el campo de precio está vacio, si no está vacio lo incluimos en el array para pasar al metodo
        if(isset($_POST['precioAlimento']) ){
            if (!empty($_POST['precioAlimento'])){
                $arrayInfoAlimento['precioAlimento']=$_POST['precioAlimento'];
            }else{
                //Si está vacio mostramos mensaje de error
                $errorPrecioAlimento=ERROR_PRECIO_ALIMENTO;
            }    
        }

        // Comprobamos si el campo de precio está vacio, si no está vacio lo incluimos en el array para pasar al metodo
        if(isset($_POST['tipoAlimento']) ){
            if (!empty($_POST['tipoAlimento'])){
                $arrayInfoAlimento['tipoAlimento']=$_POST['tipoAlimento'];
            }else{
                //Si está vacio mostramos mensaje de error
                $errorTipoAlimento=ERROR_TIPO_ALIMENTO;
            }    
        }

        // Comprobamos si el campo de precio está vacio, si no está vacio lo incluimos en el array para pasar al metodo
        // if(isset($_POST['fechaAlimento']) ){
        //     if (!empty($_POST['fechaAlimento'])){
        //         $arrayInfoAlimento['fechaAlimento']=$_POST['fechaAlimento'];
        //     }else{
        //         //Si está vacio mostramos mensaje de error
        //         $errorFechaAlimento=ERROR_FECHA_ALIMENTO;
        //     }    
        // }

        // Si los mensajes de error estan vacios es que tenemos datos para la inserción del nuevo elemento
        if(empty($errorNombreAlimento) && empty($errorTipoAlimento) && empty($errorPrecioAlimento) && empty($errorFechaAlimento)){
            fncInsertarNuevoAlimento($con, DB_TABLA_ALIMENTO, $arrayInfoAlimento);
        }

    }

    //Llamamos al metodo de crear Tabla Alimento si viene del boton
    if(isset($_POST['crearTablaAlimento'])){

        $tabla='ALIMENTOS';

        // Creamos la tabla Alimentos
        $queryCreateTable =  "CREATE TABLE $tabla ( id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NULL,
        precio FLOAT NULL,
        tipo VARCHAR(45) NULL,
        fecha DATE NULL, 
        PRIMARY KEY (id));";

        fncCrearTabla($con, DB_TABLA_ALIMENTO,$queryCreateTable);
    }

    //Llamamos al metodo de crear Tabla Alimento si viene del boton
    if(isset($_POST['actualizarCampoFecha'])){
        fncActualizarCampoFecha($con, DB_TABLA_ALIMENTO);
    }

    //Llamamos al metodo de crear Tabla Alimento si viene del boton
    if(isset($_POST['consultarAlimenetosBaratos'])){
        consultarAlimenetosBaratos($con, DB_TABLA_ALIMENTO);
    }

    //Llamamos al metodo de crear Tabla Alimento si viene del boton
    if(isset($_POST['consultarAlimenetosPorTipo'])){
        $tipo=$_POST['tipoAlimento'];
        fncConsultaAlimentosPorTipo($con, DB_TABLA_ALIMENTO, $tipo);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css" type="text/css"/>
    <title>Creación y gestión de Base de Datos Restaurante</title>
</head>
<body>
    
    <form method="post" action="crearBd.php">
        <h1> Restaurante - Información Alimentos</h1>
        <h3> Nuevo Alimento</h3>
        <table>
            <tr>
                <td>  Nombre:  </td>
                <td >  <input type="text" name=nombreAlimento ></input> <?php echo $errorNombreAlimento;?></td>
            </tr>
            <tr>
                <td>  Precio : </td>
                <td >  <input type="text" name=precioAlimento ></input> <?php echo $errorPrecioAlimento;?></td>
            </tr>
            <tr>
                <td>  Tipo :  </td>
                <td>  
                    <select name="tipoAlimento">
                        <option value="primero">Primero</option>
                        <option value="segundo" selected>Segundo</option>
                        <option value="postre">Postre</option>
                    </select>    
                    <?php echo $errorTipoAlimento;?>
                </td>
            </tr>
            <tr>
                <td>  Fecha :  </td>
                <td >  <input type="text" name=fechaAlimento ></input> <?php echo $errorFechaAlimento;?></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="insertarNuevo" value="Insertar Nuevo"></td>
            </tr>
        </table>
        <?php
            $resultado=fncMostrarDatosTabla($con, DB_TABLA_ALIMENTO);
            if (isset($resultado)){ 
        ?>
            <h3> Datos de tabla de Alimentos</h3>
            <table>
                <tr><td>Nombre</td><td>Precio</td><td>Tipo</td><td>Fecha</td></tr>
            <?php

                while($fila = mysqli_fetch_assoc($resultado)){ 
                    echo "<tr><td>".$fila['nombre']."</td><td>".$fila['precio']."</td><td>".$fila['tipo']
                    ."</td><td>".$fila['fecha']."</td></tr>";
                }      
          
            ?>
            </table>
        <?php } ?>
        
        <h3> Acciones sobre Base de Datos</h3>
        <table>
            <tr>
                <td colspan="2" class="error"><strong> <?php echo $mensajeUsuario; ?></strong></td>
            </tr>
            <tr>
                <td><input type="submit" name="crearTablaAlimento" value="Crear Tabla Alimento"></td>
                <td><input type="submit" name="actualizarCampoFecha" value="Actualizar Campo Fecha"></td>
            </tr>
        </table>
        <!--Tabla a mostrar cuando se pulsa el boton consultar alimentos baratos -->
        <h3> Consultar alimentos Baratos</h3>
        <table>
            <tr>
                <td><input type="submit" name="consultarAlimentosBaratos" value="Consultar alimentos Baratos"></td>
            </tr>
        </table>
        <?php
            if(isset($_POST['consultarAlimentosBaratos'])){
                
                $resultado=fncConsultaAlimentosBaratos($con, DB_TABLA_ALIMENTO);
                if (isset($resultado)){ 
        ?>
                <h3> Datos de tabla de Alimentos Baratos</h3>
                <table>
                    <tr><td>Nombre</td><td>Precio</td><td>Tipo</td><td>Fecha</td></tr>
                <?php

                    while($fila = mysqli_fetch_assoc($resultado)){ 
                        echo "<tr><td>".$fila['nombre']."</td><td>".$fila['precio']."</td><td>".$fila['tipo']
                        ."</td><td>".$fila['fecha']."</td></tr>";
                    }      
                ?>
                </table>
                <?php }
                
                }?>
        

        <!--Tabla a mostrar cuando se pulsa el boton consultar alimentos por tipo -->
        <h3> Consultar alimentos por tipo</h3>
        <table>
            <tr>
                <td colspan="2" class="error"><strong> <?php echo $mensajeAlimentosPorTipo; ?></strong></td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="consultaTipoAlimento" value="Primero" selected>Primero</input>
                    <input type="radio" name="consultaTipoAlimento" value="Segundo">Segundo</input>
                    <input type="radio" name="consultaTipoAlimento" value="Postre">Postre</input>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="consultarAlimenetosPorTipo" value="Consultar alimentos Por Tipo"></td>
            </tr>
        </table>
        <?php
            if(isset($_POST['consultaTipoAlimento'])){
                
                $resultado=fncConsultaAlimentosPorTipo($con, DB_TABLA_ALIMENTO, $_POST['consultaTipoAlimento']);
                if (isset($resultado)){ 
        ?>
                <h3> Datos de tabla de Alimentos</h3>
                <table>
                    <tr><td>Nombre</td><td>Precio</td><td>Tipo</td><td>Fecha</td></tr>
                <?php

                    while($fila = mysqli_fetch_assoc($resultado)){ 
                        echo "<tr><td>".$fila['nombre']."</td><td>".$fila['precio']."</td><td>".$fila['tipo']
                        ."</td><td>".$fila['fecha']."</td></tr>";
                    }      
                ?>
                </table>
                <?php }
                
                }?>
    </form>
</body>
</html>