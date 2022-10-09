<?php
include './libmenu.php';
    if(isset($_POST['btnSocio']))   // socio
    {
        if(strlen(trim($_POST['inpNom']))==0 || strlen(trim($_POST['inpPass']))==0) //nombre o contrasena vacios 
        {
            header('Location: entrada.php?err=0');
            exit();
        }
        else
        {
            $nom = trim($_POST['inpNom']);
            if(autentica($nom,trim($_POST['inpPass'])) == 1)  // correcto
            {
                session_start();
                $_SESSION['usuario'] = [$nom, dameDcto($nom)];  // usuario y su descuento
                header('Location: pedido.php');
                exit();
            }
            else  // incorrecto
            {
                header('Location: entrada.php?err=1');
                exit();
            }
        }
    }
    else
    {
        if(isset($_POST['btnInvitado']))   // invitado
        {
            session_start();
            $_SESSION['usuario'] = ['invitado', 0];  // invitado y su descuento 0
            header('Location: pedido.php');
                exit();
        }
        else  
        {
            header('Location: entrada.php');  // tipo random que no deberia estar aqui
            exit();
        }
    }
?>