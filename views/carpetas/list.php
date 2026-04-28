<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Listado de carpetas</h2>
        <p class="text-muted mb-0">Consulta, filtra y administra los registros</p>
    </div>
    <a href="index.php?view=form" class="btn btn-primary">Nueva carpeta</a>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form class="row g-2" method="GET" action="index.php">
            <input type="hidden" name="view" value="listar">
            <div class="col-md-5">
                <input class="form-control" name="q" value="<?= e($filtros['q'] ?? '') ?>" placeholder="Buscar por carpeta, fiscal, fiscalía o delito">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="estado">
                    <option value="">Todos los estados</option>
                    <?php foreach (['formalizado' => 'Formalizado', 'archivado' => 'Archivado', 'sentenciado' => 'Sentenciado'] as $k => $label): ?>
                        <option value="<?= e($k) ?>" <?= ($filtros['estado'] ?? '') === $k ? 'selected' : '' ?>><?= e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <input class="form-control" name="fiscalia" value="<?= e($filtros['fiscalia'] ?? '') ?>" placeholder="Fiscalía">
            </div>
            <div class="col-md-1 d-grid">
                <button class="btn btn-dark">Filtrar</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <strong>Total: <?= count($data) ?></strong>
            <a class="btn btn-outline-success btn-sm" href="index.php?action=csv&q=<?= urlencode($filtros['q'] ?? '') ?>&estado=<?= urlencode($filtros['estado'] ?? '') ?>&fiscalia=<?= urlencode($filtros['fiscalia'] ?? '') ?>">Exportar CSV</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>N° carpeta</th>
                    <th>Fecha</th>
                    <th>Fiscal</th>
                    <th>Fiscalía</th>
                    <th>Delito</th>
                    <th>Estado</th>
                    <th class="actions">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($data)): ?>
                    <tr><td colspan="8" class="text-center text-muted py-4">No hay registros para mostrar.</td></tr>
                <?php endif; ?>
                <?php foreach ($data as $d): ?>
                    <tr>
                        <td><?= e($d['id']) ?></td>
                        <td class="fw-semibold"><?= e($d['nro_carpeta']) ?></td>
                        <td><?= e($d['fecha']) ?></td>
                        <td><?= e($d['fiscal_responsable']) ?></td>
                        <td><?= e($d['fiscalia']) ?></td>
                        <td><?= e($d['delito']) ?></td>
                        <td><span class="badge text-bg-secondary"><?= e($d['estado']) ?></span></td>
                        <td class="actions">
                            <a class="btn btn-sm btn-outline-primary" href="index.php?view=form&id=<?= e($d['id']) ?>">Editar</a>
                            <a class="btn btn-sm btn-outline-danger" href="index.php?action=eliminar&id=<?= e($d['id']) ?>" onclick="return confirm('¿Eliminar esta carpeta?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
