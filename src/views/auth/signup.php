<?php

use app\models\User;
use app\widgets\Alert;

/**
 * @var User $model
 */

?>

<!-- Background image -->
<div id="intro" class="bg-image shadow-2-strong">
    <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-md-8">
                    <form class="bg-white rounded shadow-5-strong p-5" method="POST">

                        <?php Alert::run() ?>

                        <h2 class="text-center font-weight-bold mb-4">Cadastro</h2>

                        <div class="form-group mb-4">
                            <label class="form-label" for="document">CPF ou CNPJ</label>
                            <input type="text" id="document" name="document" class="form-control document" maxlength="14" required value="<?= $model->getDocument() ?>" />
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label" for="name">Nome</label>
                            <input type="text" id="name" name="name" class="form-control" maxlength="255" required value="<?= $model->getName() ?>" />
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label" for="birthday">Data de nascimento</label>
                            <input type="date" id="birthday" name="birthday" class="form-control" required value="<?= $model->getBirthday() ?>" />
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label" for="address">Endereço</label>
                            <input type="text" id="address" name="address" maxlength="255" class="form-control" required value="<?= $model->getAddress() ?>" />
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label" for="password">Senha</label>
                            <input type="password" id="password" maxlength="255" name="password" class="form-control" required />
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label" for="confirm-password">Confirmar senha</label>
                            <input type="password" id="confirm-password" maxlength="255" name="confirm-password" class="form-control" required />
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-success btn-block">
                            Entrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Background image -->