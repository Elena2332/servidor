<?php
$html = "";
if ($_POST["elegido"]==1) {
	$html = '
	<option value="1">Primer curso</option>
	<option value="2">Segundo curso</option>
	<option value="3">Tercer curso</option>
	<option value="4">Cuarto curso</option>
	<option value="5">Quinto curso</option>
	<option value="6">Sexto curso</option>
	';	
}
if ($_POST["elegido"]==2) {
	$html = '
	<option value="1">Primer curso</option>
	<option value="2">Segundo curso</option>
	<option value="3">Tercer curso</option>
	<option value="4">Cuarto curso</option>
	';	
}
if ($_POST["elegido"]==3) {
	$html = '
	<option value="1">Primer curso</option>
	<option value="2">Segundo curso</option>
	';	
}
echo $html;	
?>