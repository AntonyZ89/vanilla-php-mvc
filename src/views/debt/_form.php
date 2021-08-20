<?php

use app\models\Debt;

/**
 * @var Debt $model
 */

$model = $model ?? new Debt();
?>

<form action="/debt/save" method="post">
    <?php if (!$model->isNewRecord()) : ?>
        <input type="hidden" name="id" id="id" value="<?= $model->getId() ?>">
        <input type="hidden" name="created_at" id="created_at" value="<?= $model->getCreatedAt() ?>">
        <input type="hidden" name="updated_at" id="updated_at" value="<?= $model->getUpdatedAt() ?>">
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="description">Descrição</label>
                <input type="text" name="description" id="description" class="form-control" value="<?= $model->getDescription() ?>" required></input>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="value">Valor</label>
                <input type="number" name="value" id="value" class="form-control" step=".01" value="<?= $model->getValue() ?>" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="due_date">Data de Vencimento</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="<?= $model->getDueDate() ?>" required>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="float-end mt-2">
            <?php if (!$model->isNewRecord()) : ?>
                <a href="/debt/<?= $model->getId() ?>/delete" target="_blank" class="btn btn-danger" data-method="post">
                    Excluir
                </a>
            <?php endif; ?>

            <button type="submit" class="btn btn-<?= $model->isNewRecord() ? 'success' : 'primary' ?>">
                <?= $model->isNewRecord() ? 'Enviar' : 'Atualizar' ?>
            </button>
        </div>
    </div>
</form>