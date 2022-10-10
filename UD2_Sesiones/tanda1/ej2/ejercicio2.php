<?php
    session_start();   //crea, recarga la session   
        
    if(isset($_GET['destruir']) && $_GET['destruir']==true)   // destruir la session
    {
        session_destroy();
        session_start();
    }

    if(!isset($_SESSION['nombres']))          
        $_SESSION['nombres'] = [];  //crear el array para los nombres dentro de sesion

    function pintarLista()
    {
        $txtHtml = "";
        if(count($_SESSION['nombres'])>0)
        {
            $txtHtml = "<p>Datos introducidos:</p><ul>";
            // sacar nombres de $_SESSION
            foreach($_SESSION['nombres'] as $nom)
                $txtHtml = $txtHtml.'<li>'.$nom.'</li>';
            return $txtHtml.'</ul>';
        }
        else
        {
            $txtHtml = $txtHtml.'<p>Todavia no se han introducido nombres.</p>';
        }
        return $txtHtml;
    }

    function validar()
    {
        if(isset($_POST['btnAniadir']))
        {
            if(strlen(trim($_POST['inpNom']))>0)
            { 
                if(array_search($_POST['inpNom'], $_SESSION['nombres']) === false)  // evitar repes
                    $_SESSION['nombres'][] = $_POST['inpNom'];  //aniadir el nombre
                else
                    return '<p style="color: red;">Ya existe :)</p>';
            }
            else
                return '<p style="color: red;">Esta vacio -_-</p>';
        }
    }

    if(isset($_POST['btnBorrar']) && !empty($_POST['inpNom']))
    {
        $pos = array_search($_POST['inpNom'], $_SESSION['nombres']);
        if($pos !== false)  
        {
            unset($_SESSION['nombres'][$pos]);  //borrar          
            $_SESSION['nombres'] = array_values($_SESSION['nombres']); // evita valores vacios
        }    
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="estilo.css"/>
    <title>Ejercicio1</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php echo validar(); ?>
        <label>Escribe un nombre: </label>
        <input type="text" name="inpNom"/>
        <div>
            <button type="submit" name="btnAniadir">Añadir</button>
            <button type="submit" name="btnBorrar">Borrar</button>
        </div>
    </form>
        <?php echo pintarLista(); ?>
    <a href="ejercicio1.php?destruir=true">Cerrar sesion(se perderan los datos almacenados)</a>
</body>
</html>