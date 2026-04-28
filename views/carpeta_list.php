<h3>Listado</h3>

<table class="table table-bordered">
<tr><th>ID</th><th>Carpeta</th><th>Estado</th></tr>

<?php foreach($data as $d){ ?>
<tr>
<td><?= $d['id'] ?></td>
<td><?= $d['nro_carpeta'] ?></td>
<td><?= $d['estado'] ?></td>
</tr>
<?php } ?>

</table>