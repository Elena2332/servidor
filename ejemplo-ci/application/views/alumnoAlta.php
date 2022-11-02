<h1>Alta de un alumno</h1>
  <form action="<?php echo site_url("cinicio/alumnoAltaVerificar"); ?>" method="post">
    <div class="form-group text-left">
      <label for="nombre">Nombre:</label>
      <input type="text" name="nombre" class="form-control"
      value="<?php echo set_value('nombre'); ?>" 
      >
      <?php echo form_error("nombre"); ?>
    </div>
    <div class="form-group text-left">
      <label for="apellidos">Apellidos:</label>
      <input type="text" name="apellidos" class="form-control"
      value="<?php echo set_value('apellidos'); ?>" 
      >
      <?php echo form_error("apellidos"); ?>
    </div>
    <div class="form-group text-left">
      <label for="nacimiento">Fecha de nacimiento:</label>
      <input type="date" name="nacimiento" class="form-control"
      value="<?php echo set_value('nacimiento'); ?>" 
      >
      <?php echo form_error("nacimiento"); ?>
    </div>
    <div class="form-group text-left">
      <label for="sexo">Género:</label>
      <input type="text" name="sexo" class="form-control"
      value="<?php echo set_value('sexo'); ?>" 
      >
      <?php echo form_error("sexo"); ?>
    </div>
    <div class="form-group text-left">
      <label for="promedio">Promedio:</label>
      <input type="text" name="promedio" class="form-control"
      value="<?php echo set_value('promedio'); ?>" 
      >
      <?php echo form_error("promedio"); ?>
    </div>
    <input type="submit" class="btn btn-success" value="Guardar datos">
    <a href="<?php echo site_url('cinicio/alumnos'); ?>" class="btn btn-info">Regresar</a>
  </form>
  
