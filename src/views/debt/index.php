<?php

use app\manager\View;
use app\models\Debt;

/**
 * @var Debt[] $debts
 */

?>

<div class="debt-index">
    <section class="mb-2">
        <div class="card border">
            <div class="card-body">
                <h5 class="card-title">Suas dívidas</h5>
                <div class="card-text">
                    <?php foreach ($debts as $i => $debt) : ?>
                        <?= $i !== 0 ? '<hr>' : null ?>
                        <?= View::render('debt', '_form', [
                            'model' => $debt
                        ]) ?>
                    <?php endforeach; ?>


                    <?php if(empty($debts)): ?>
                        <h3 class="text-center">Nenhuma dívida encontrada</h3>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="card border">
            <div class="card-body">
                <h5 class="card-title">Cadastrar nova dívida</h5>
                <div class="card-text">
                    <section>
                        <?= View::render('debt', '_form', [
                            'model' => null
                        ]) ?>
                    </section>

                </div>
            </div>
        </div>
    </section>
</div>