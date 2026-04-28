<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Dashboard</h2>
        <p class="text-muted mb-0">Resumen general de carpetas registradas</p>
    </div>
    <a href="index.php?view=form" class="btn btn-primary">Nueva carpeta</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="small-muted">Total</div>
                <div class="stat-number"><?= e($stats['total'] ?? 0) ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="small-muted">Formalizados</div>
                <div class="stat-number"><?= e($stats['formalizados'] ?? 0) ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="small-muted">Archivados</div>
                <div class="stat-number"><?= e($stats['archivados'] ?? 0) ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="small-muted">Sentenciados</div>
                <div class="stat-number"><?= e($stats['sentenciados'] ?? 0) ?></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <strong>Carpetas por Fiscalía</strong>
            </div>
            <div class="card-body">
                <?php if (empty($stats['porFiscalia'])): ?>
                    <p class="text-muted mb-0">Aún no hay datos para graficar.</p>
                <?php else: ?>
                    <canvas id="graficoFiscalias" height="120"></canvas>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <strong>Estados de carpetas</strong>
            </div>
            <div class="card-body">
                <canvas id="graficoEstados" height="160"></canvas>
            </div>
        </div>
    </div>
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
                            <thead>
                                <tr>
                                    <th>Fiscalía</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stats['porFiscalia'] as $row): ?>
                                    <tr>
                                        <td><?= e($row['fiscalia'] ?: 'Sin fiscalía') ?></td>
                                        <td class="text-end fw-semibold"><?= e($row['total']) ?></td>
                                    </tr>
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
                                <span><?= e($row['delito'] ?: 'Sin delito') ?></span>
                                <strong><?= e($row['total']) ?></strong>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const fiscaliasLabels = <?= json_encode(array_column($stats['porFiscalia'] ?? [], 'fiscalia')) ?>;
const fiscaliasData = <?= json_encode(array_column($stats['porFiscalia'] ?? [], 'total')) ?>;

if (document.getElementById('graficoFiscalias')) {
    new Chart(document.getElementById('graficoFiscalias'), {
        type: 'bar',
        data: {
            labels: fiscaliasLabels,
            datasets: [{
                label: 'Cantidad de carpetas',
                data: fiscaliasData
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
}

const estadosLabels = ['Formalizados', 'Archivados', 'Sentenciados'];
const estadosData = [
    <?= json_encode($stats['formalizados'] ?? 0) ?>,
    <?= json_encode($stats['archivados'] ?? 0) ?>,
    <?= json_encode($stats['sentenciados'] ?? 0) ?>
];

if (document.getElementById('graficoEstados')) {
    new Chart(document.getElementById('graficoEstados'), {
        type: 'doughnut',
        data: {
            labels: estadosLabels,
            datasets: [{
                label: 'Estados',
                data: estadosData
            }]
        },
        options: {
            responsive: true
        }
    });
}
</script>