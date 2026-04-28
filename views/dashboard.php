<h3>Dashboard Fiscalía</h3>

<div class="row">
    <div class="col-md-4">
        <canvas id="estadoChart"></canvas>
    </div>

    <div class="col-md-8">
        <canvas id="fiscaliaChart"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// DATOS DESDE PHP
const archivados = <?= $archivados ?>;
const formalizados = <?= $formalizados ?>;

// GRAFICO 1: ESTADO
new Chart(document.getElementById('estadoChart'), {
    type: 'pie',
    data: {
        labels: ['Archivados', 'Formalizados'],
        datasets: [{
            data: [archivados, formalizados]
        }]
    }
});

// GRAFICO 2: FISCALIA
const fiscalias = <?= json_encode($fiscalias_labels) ?>;
const totales = <?= json_encode($fiscalias_data) ?>;

new Chart(document.getElementById('fiscaliaChart'), {
    type: 'bar',
    data: {
        labels: fiscalias,
        datasets: [{
            label: 'Casos por Fiscalía',
            data: totales
        }]
    }
});
</script>