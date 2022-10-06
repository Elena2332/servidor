<?php
    //header('Location: login.php?var=3');
    //exit();
    if(isset($_POST['btnValidar']))
    {
        if(strlen(trim($_POST['inpName']))<3 && strlen(trim($_POST['inpPass']))<3)
        {
            // echo '<p style="color:red;">Los campos deben tener minimo 3 caracteres</p>';
            header('Location: login.php?minCar=3');
            exit();
        }
        else
        {
            $fich = fopen("doc/usuarios.txt", "r");
            $seguir = true;
            $existe = false;
            while (!feof($fich) && $seguir==true) 
            {
                $linea = fgets($fich); 
                $linea = explode(';SEPAR;',$linea);
                if(trim($_POST['inpName'])==$linea[0])
                {   
                    $seguir = false;
                    fclose($fich);
                    $existe = true;

                    if(trim($_POST['inpPass'])==trim($linea[1]))  // usuario y password correctos
                    {
                        header('Location: chat.php?nom='.$_POST['inpName']);
                        exit();
                    }
                    else  //contraseña erronea
                    {
                        header('Location: login.php?invPass='.$_POST['inpName']);
                        exit();
                    }
                }
            }
            if(!$existe)   //ir a alta.php
                header('Location: alta.php');
        }           
    }

?>