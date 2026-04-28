<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Dashboard</h2>
        <p class="text-muted mb-0">Resumen general de carpetas registradas</p>
    </div>
    <a href="index.php?view=form" class="btn btn-primary">Nueva carpeta</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><div class="small-muted">Total</div><div class="stat-number"><?= e($stats['total']) ?></div></div></div></div>
    <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><div class="small-muted">Formalizados</div><div class="stat-number"><?= e($stats['formalizados']) ?></div></div></div></div>
    <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><div class="small-muted">Archivados</div><div class="stat-number"><?= e($stats['archivados']) ?></div></div></div></div>
    <div class="col-md-3"><div class="card shadow-sm"><div class="card-body"><div class="small-muted">Sentenciados</div><div class="stat-number"><?= e($stats['sentenciados']) ?></div></div></div></div>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h6 mb-3">Casos por fiscalía</h3>
                <?php if (empty($stats['porFiscalia'])): ?>
                    <p class="text-muted mb-0">Aún no hay datos registrados.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead><tr><th>Fiscalía</th><th class="text-end">Total</th></tr></thead>
                            <tbody>
                            <?php foreach ($stats['porFiscalia'] as $row): ?>
                                <tr><td><?= e($row['fiscalia']) ?></td><td class="text-end fw-semibold"><?= e($row['total']) ?></td></tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h6 mb-3">Delitos más registrados</h3>
                <?php if (empty($stats['porDelito'])): ?>
                    <p class="text-muted mb-0">Aún no hay datos registrados.</p>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                    <?php foreach ($stats['porDelito'] as $row): ?>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span><?= e($row['delito']) ?></span>
                            <strong><?= e($row['total']) ?></strong>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
