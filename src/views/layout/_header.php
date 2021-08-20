<?php

use app\manager\View;
use app\models\User;

/**
 * @var User|null $user logged user
 */

?>
<!--Main Navigation-->
<header>
    <?= View::render('layout', '_siderbar', ['user' => $user]) ?>

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <span class="me-2">
                            <?= $user ? $user->getName() : 'Usuário convidado(a)' ?>
                        </span>
                        <img src="/src/assets/img/avatar.png" class="rounded-circle" height="22" alt="" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <?php if ($user) : ?>
                            <li><a class="dropdown-item" href="/profile">Meu perfil</a></li>
                            <li><a class="dropdown-item" href="/logout" data-method="POST">Sair</a></li>
                        <?php else : ?>
                            <li><a class="dropdown-item" href="/login">Entrar</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
<!--Main Navigation-->