<?php
$old = $_SESSION['old'] ?? [];
unset($_SESSION['old']);
$errores = $_SESSION['errores'] ?? [];
unset($_SESSION['errores']);
$modoEditar = !empty($carpeta);
$val = function($campo) use ($old, $carpeta) { return $old[$campo] ?? ($carpeta[$campo] ?? ''); };
$action = $modoEditar ? 'actualizar' : 'guardar';
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1"><?= $modoEditar ? 'Editar carpeta' : 'Nueva carpeta' ?></h2>
        <p class="text-muted mb-0">Complete los datos principales del cuadro de flagrancia</p>
    </div>
    <a href="index.php?view=listar" class="btn btn-outline-secondary">Volver</a>
</div>

<?php if ($errores): ?>
    <div class="alert alert-warning">
        <strong>Revisa el formulario:</strong>
        <ul class="mb-0"><?php foreach ($errores as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="index.php?action=<?= $action ?>">
            <?php if ($modoEditar): ?><input type="hidden" name="id" value="<?= e($carpeta['id']) ?>"><?php endif; ?>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">N° caso / carpeta fiscal *</label>
                    <input name="nro_carpeta" class="form-control" value="<?= e($val('nro_carpeta')) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha *</label>
                    <input type="date" name="fecha" class="form-control" value="<?= e($val('fecha')) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Estado *</label>
                    <select name="estado" class="form-select" required>
                        <?php foreach (['formalizado' => 'Formalizado', 'archivado' => 'Archivado', 'sentenciado' => 'Sentenciado'] as $k => $label): ?>
                            <option value="<?= e($k) ?>" <?= $val('estado') === $k ? 'selected' : '' ?>><?= e($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fiscal responsable *</label>
                    <input name="fiscal_responsable" class="form-control" value="<?= e($val('fiscal_responsable')) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fiscalía *</label>
                    <input name="fiscalia" class="form-control" value="<?= e($val('fiscalia')) ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Despacho</label>
                    <input name="despacho" class="form-control" value="<?= e($val('despacho')) ?>">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Delito *</label>
                    <input name="delito" class="form-control" value="<?= e($val('delito')) ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Proceso inmediato</label>
                    <input name="proceso_inmediato" class="form-control" value="<?= e($val('proceso_inmediato')) ?>" placeholder="Ej: Sí / No / Requerido">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Formalización</label>
                    <input name="formalizacion" class="form-control" value="<?= e($val('formalizacion')) ?>" placeholder="Ej: Sí / No / Fecha">
                </div>

                <div class="col-md-3">
                    <label class="form-label">PP fundado / plazo</label>
                    <input name="prision_preventiva_fundado_plazo" class="form-control" value="<?= e($val('prision_preventiva_fundado_plazo')) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">PP infundado</label>
                    <input name="prision_preventiva_infundado" class="form-control" value="<?= e($val('prision_preventiva_infundado')) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Comparecencia fundado / plazo</label>
                    <input name="comparecencia_fundado_plazo" class="form-control" value="<?= e($val('comparecencia_fundado_plazo')) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Comparecencia infundado</label>
                    <input name="comparecencia_infundado" class="form-control" value="<?= e($val('comparecencia_infundado')) ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Sentencia efectiva</label>
                    <input name="sentencia_efectiva" class="form-control" value="<?= e($val('sentencia_efectiva')) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sentencia suspendida</label>
                    <input name="sentencia_suspendida" class="form-control" value="<?= e($val('sentencia_suspendida')) ?>">
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-primary"><?= $modoEditar ? 'Actualizar' : 'Guardar' ?></button>
                <a href="index.php?view=listar" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
