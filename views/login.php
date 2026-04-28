<?php include "layout/header.php"; ?>

<h3>Login</h3>
<form method="POST" action="index.php?action=login">
<input name="usuario" class="form-control mb-2">
<input type="password" name="clave" class="form-control mb-2">
<button class="btn btn-primary">Ingresar</button>
</form>

<?php include "layout/footer.php"; ?>