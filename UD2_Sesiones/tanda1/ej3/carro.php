<?php
    define('PRODUCTOS', ['prod1'=>10, 'prod2'=>20, 'prod3'=>10, 'prod4'=>30]);
    session_start();

    if (!isset($_SESSION['pedidos']))   //inicializar pedidos
        $_SESSION['pedidos'] = ['prod1' => 0, 'prod2' => 0, 'prod3' => 0, 'prod4' => 0];

    function dibujarTabla ()
    {
        $txtHtml = '<tr>
                <th> PRODUCTO </th>
                <th> PRECIO </th>
                <th> ELIJA CANTIDAD </th>
                <th> PEDIDO ACTUAL </th>
             </tr>';

        foreach(PRODUCTOS as $nom => $precio)
        {
            $txtHtml = $txtHtml.'<tr><td><input type="checkbox" name="'.$nom.'">'.$nom.'</td>';
            $txtHtml = $txtHtml.'<td>'.$precio.'€</td>';            
            $txtHtml = $txtHtml.'<td><select name="selCant"'.$nom.'">';
            for ($i=0; $i<=10;$i++)
                $txtHtml = $txtHtml.'<option value='.$i.'>'.$i.'</option>';
            $txtHtml = $txtHtml.'</select></td>';
            $txtHtml = $txtHtml.'<td>'.$_SESSION['pedidos'][$nom].' uds pedidas</td></tr>';
        }
        return $txtHtml;
    }

    if(isset($_POST['btnAniadir']))  // aniadir producto
    {
        foreach (PRODUCTOS as $nom => $value) 
        {
            if (isset($_POST[$nom]) && $_POST['selCant'.$nom] != 0)
                $_SESSION['pedidos'][$nom] = $_SESSION['pedidos'][$nom]+$_POST['selCant'.$nom]; // selCantprod2
        }
    }

    if(isset($_POST['btnVaciar']))
    {
        unset($_SESSION['pedidos']);
        $_SESSION['pedidos'] = ['prod1' => 0, 'prod2' => 0, 'prod3' => 0, 'prod4' => 0];
    }

    function sacarErrores()
    {
        if (isset($_POST['btnAniadir']))
        {
            $cont = 0;
            foreach (PRODUCTOS as $nom => $value) 
            {
                if(!isset($_POST[$nom]))
                    $cont++;
                if ($_POST['selCant'.$nom] == 0)
                    echo '<p>Debes seleccionar una cantidad del producto</p>';
            }
            if ($cont == count(PRODUCTOS))
                echo '<p>Debes seleccionar algun producto</p>';
            
        }
    }

    function mostrarPedido()
    {
        if (isset($_POST['btnCompra']))
        {
            echo '<h2>Tu pedido</h2><ul>';
            $total = 0;
            foreach($_SESSION['pedidos'] as $nom => $value)
            {
                if ($value!=0)
                {
                    echo '<li>'.$nom.' - '.$value.' unidades a '.PRODUCTOS[$nom].'€</li>';
                    $total = $total+(PRODUCTOS[$nom] * $value);
                }
            }

            echo '<li>TOTAL '.$total.' EUROS</li></ul>';
            unset($_SESSION['pedidos']);
            $_SESSION['pedidos'] = ['prod1' => 0, 'prod2' => 0, 'prod3' => 0, 'prod4' => 0];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carro</title>
    <style>
        td
        {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">  

        <?php
            sacarErrores();
            mostrarPedido();
        ?>
        <table>
            <?php echo dibujarTabla(); ?>
        </table>

        <input type="submit" name="btnAniadir" value="AÑADIR UNIDADES">
        <input type="submit" name="btnCompra" value="FORMALIZAR COMPRA">
        <input type="submit" name="btnVaciar" value="VACIAR CARRO">
    </form>
</body>
</html>