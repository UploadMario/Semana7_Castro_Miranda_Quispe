<h3>Nueva Carpeta</h3>

<form method="POST" action="index.php?action=guardar">
<input name="nro_carpeta" class="form-control mb-2">
<input name="denunciante" class="form-control mb-2">
<input name="agraviado" class="form-control mb-2">
<input name="delito" class="form-control mb-2">
<input type="date" name="fecha_hecho" class="form-control mb-2">
<input name="fiscal_responsable" class="form-control mb-2">
<input name="fiscalia" class="form-control mb-2">

<select name="estado" class="form-control mb-2">
<option>archivado</option>
<option>formalizado</option>
</select>

<button class="btn btn-success">Guardar</button>
</form>