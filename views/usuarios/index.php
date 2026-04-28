<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Usuarios</h2>
        <p class="text-muted mb-0">Creación básica de usuarios del sistema</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h6 mb-3">Nuevo usuario</h3>
                <form method="POST" action="index.php?action=crearUsuario">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input name="usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="clave" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rol</label>
                        <select name="rol" class="form-select">
                            <option value="usuario">Usuario</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Crear usuario</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h6 mb-3">Usuarios registrados</h3>
                <table class="table table-sm">
                    <thead><tr><th>ID</th><th>Usuario</th><th>Rol</th></tr></thead>
                    <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr><td><?= e($u['id']) ?></td><td><?= e($u['usuario']) ?></td><td><?= e($u['rol']) ?></td></tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
