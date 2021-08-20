<?php

use app\models\User;

/**
 * @var User $user
 */
?>

<div class="site-profile card">
    <div class="card-body">
        <h5 class="card-title">
            Perfil
        </h5>

        <form action="/profile" method="post">
            <input type="hidden" name="id" id="id" value="<?= $user->getId() ?>">
            <input type="hidden" name="created_at" id="created_at" value="<?= $user->getCreatedAt() ?>">
            <input type="hidden" name="updated_at" id="updated_at" value="<?= $user->getUpdatedAt() ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline mb-2">
                        <input type="text" name="document" id="document" class="form-control document" maxlength="14" value="<?= $user->getDocument() ?>" required></input>
                        <label class="form-label" for="document">CPF ou CNPJ</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-outline mb-2">
                        <input type="text" name="name" id="name" class="form-control" value="<?= $user->getName() ?>" required></input>
                        <label class="form-label" for="name">Nome</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-outline mb-2">
                        <input type="date" name="birthday" id="birthday" class="form-control" step=".01" value="<?= $user->getBirthday() ?>" required>
                        <label class="form-label" for="birthday">Data de nascimento</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-outline mb-2">
                        <input type="text" name="address" id="address" class="form-control" value="<?= $user->getAddress() ?>" required>
                        <label class="form-label" for="address">Endereço</label>
                    </div>
                </div>
                <row>
                    <div class="col-md-4">
                        <div class="form-outline mb-2">
                            <input type="password" name="password" id="password" class="form-control">
                            <label class="form-label" for="password">Nova senha</label>
                        </div>
                    </div>
                </row>
                <row>
                    <div class="col-md-4">
                        <div class="form-outline">
                            <input type="password" name="confirm-password" id="confirm-password" class="form-control">
                            <label class="form-label" for="confirm-password">Confirmar nova senha</label>
                        </div>
                    </div>
                </row>
            </div>
            <div class="clearfix">
                <div class="float-end mt-2">
                    <button type="submit" class="btn btn-primary">
                        Atualizar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>