<?php
    session_start();
    $pag = $_SESSION['ultimaPag'];
    session_destroy();
    header('Location: '.$pag);
    exit();
?>