<!-- Background image -->
<div id="intro" class="bg-image shadow-2-strong">
    <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-md-8">
                    <form class="bg-white rounded shadow-5-strong p-5" method="POST">

                        <?php if (isset($_SESSION['flash'])) : ?>
                            <?php foreach ($_SESSION['flash'] as $type => $value) : ?>
                                <div class="alert alert-<?= $type ?>" role="alert">
                                    <?= $value ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="document" name="document" class="form-control" maxlength="14" required />
                            <label class="form-label" for="document">CPF ou CNPJ</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control" required />
                            <label class="form-label" for="password">Senha</label>
                        </div>

                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                    <label class="form-check-label" for="form1Example3">
                                        Lembrar-me
                                    </label>
                                </div>
                            </div>

                            <div class="col text-center">
                                <!-- Simple link -->
                                <a href="#!">Esqueceu a senha?</a>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block">
                            Entrar
                        </button>
                        <a href="/signup" class="btn btn-black btn-block">
                            Cadastrar-se
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Background image -->