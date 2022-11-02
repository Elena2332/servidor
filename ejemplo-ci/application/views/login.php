<h1>Acceso al sitio</h1>
<form method="post" action="<?php echo site_url("cinicio/validaUsuario"); ?>">
    <?php 
    //Se muestra un error en caso de que haya habido algún problema al hacer login
    if (!empty($error)) {
      echo '<div class="alert alert-danger" role="alert">';
      echo $error;
      echo '</div>';
    }
    ?>
    <div class="card p-3 my-3" style="">
    <div class="form-group text-left">
      <label>* Usuario:</label> 
      <!-- Con set values rellenamos el campo con el valor guardado anteriormente -->
      <input type="text" name="usuario" id="usuario" value="<?php echo set_value("usuario"); ?>" class="form-control"  placeholder="Correo electrónico">
   </div>
   <div class="form-group text-left">
      <label>* Clave de acceso:</label>
      <input type="password" name="clave" id="clave" value="" class="form-control">
    </div>
  </div>
    <div class="form-group text-left">
      <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
      <a href="<?php echo site_url('cinicio/registro/'); ?>" class="btn btn-info">Registro usuario</a>
    </div>
</form>
