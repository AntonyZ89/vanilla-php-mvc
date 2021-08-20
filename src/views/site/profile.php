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
                    <div class="form-group">
                        <label for="document">CPF ou CNPJ</label>
                        <input type="text" name="document" id="document" class="form-control" value="<?= $user->getDocument() ?>" required></input>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="birthday">Data de nascimento</label>
                        <input type="date" name="birthday" id="birthday" class="form-control" step=".01" value="<?= $user->getBirthday() ?>" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">Endereço</label>
                        <input type="text" name="address" id="address" class="form-control" value="<?= $user->getAddress() ?>" required>
                    </div>
                </div>
                <row>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="password">Nova senha</label>
                            <input type="pasword" name="password" id="password" class="form-control">
                        </div>
                    </div>
                </row>
                <row>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="confirm-password">Confirmar nova senha</label>
                            <input type="pasword" name="confirm-password" id="confirm-password" class="form-control">
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