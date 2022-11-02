<h1>Registro de usuario</h1>
  
<form method="post" action="<?php echo site_url("cinicio/verificarRegistro"); ?>">
  <div class="card p-3 my-3" style="">
  <div class="form-group text-left">
    <!-- El usuario será el correo electrónico -->
      <label>* Usuario:</label> 
      <input type="text" name="usuario" id="usuario" 
      value="<?php echo set_value("usuario"); ?>" 
      class="form-control" 
      placeholder="Escribe tu correo electrónico">
      <?php echo form_error("usuario"); ?>
   </div>
   <div class="form-group text-left">
      <label>* Clave de acceso:</label>
      <input type="password" name="clave" id="clave" 
      value="<?php echo set_value("clave"); ?>" 
      class="form-control" 
      placeholder="Escribe tu clave de acceso">
      <?php echo form_error("clave"); ?>
    </div>
  <div class="form-group text-left">
      <label>* Verificar clave de acceso:</label>
      <input type="password" name="clave2" id="clave2" 
      value="<?php echo set_value("clave2"); ?>" 
      class="form-control" 
      placeholder="Repite tu clave de acceso">
      <?php echo form_error("clave2"); ?>
    </div>
  <div class="form-group text-left">
      <label>* Nombre:</label> 
      <input type="text" name="nombre" id="nombre" 
      value="<?php print set_value("nombre"); ?>" 
      class="form-control" 
      placeholder="Escribe tu nombre completo">
      <?php echo form_error("nombre"); ?>
   </div>
   </div>
    <div class="form-group text-left">
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php echo site_url('cinicio/index/'); ?>" class="btn btn-info">Regresar</a>
    </div>
</form>