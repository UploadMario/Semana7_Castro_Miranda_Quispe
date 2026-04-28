<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Reportes</h2>
        <p class="text-muted mb-0">Resumen por fiscalía, delito y estado</p>
    </div>
    <a href="index.php?action=csv" class="btn btn-outline-success">Exportar CSV</a>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h6">Por fiscalía</h3>
                <table class="table table-sm mb-0">
                    <thead><tr><th>Fiscalía</th><th class="text-end">Total</th></tr></thead>
                    <tbody>
                    <?php foreach ($stats['porFiscalia'] as $row): ?>
                        <tr><td><?= e($row['fiscalia']) ?></td><td class="text-end"><?= e($row['total']) ?></td></tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h6">Top delitos</h3>
                <table class="table table-sm mb-0">
                    <thead><tr><th>Delito</th><th class="text-end">Total</th></tr></thead>
                    <tbody>
                    <?php foreach ($stats['porDelito'] as $row): ?>
                        <tr><td><?= e($row['delito']) ?></td><td class="text-end"><?= e($row['total']) ?></td></tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
