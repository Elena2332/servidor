<?php
    session_start();
    if(isset($_SESSION['usuario']))
        logout($_SESSION['usuario']['id']);
    session_destroy();
?>