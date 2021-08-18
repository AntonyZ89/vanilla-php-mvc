<?php

use app\manager\View;

?>

<div class="debt-index">
    <h1>Minhas dívidas</h1>
    <hr>
    <section class="mb-2">
        <div class="card border">
            <div class="card-body">
                <h5 class="card-title">Dívidas</h5>
                <div class="card-text">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                        <?= $i !== 0 ? '<hr>' : null ?>
                        <?= View::render('debt', '_form') ?>
                    <?php endfor; ?>

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
                        <?= View::render('debt', '_form') ?>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>