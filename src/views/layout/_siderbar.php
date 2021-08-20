<?php 

use app\models\User;

/**
 * @var User|null $user logged user
 */

?>

<!-- Sidebar -->
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
            <a href="/" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                <i class="fas fa-home fa-fw me-3"></i>
                <span>Início</span>
            </a>
            <?php if ($user) : ?>
                <a href="/debt" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-chart-area fa-fw me-3"></i>
                    <span>Minhas dívidas</span>
                </a>
                <a href="/profile" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-user fa-fw me-3"></i>
                    <span>Perfil</span>
                </a>
                <a href="/logout" class="list-group-item list-group-item-action py-2 ripple" data-method="post">
                    <i class="fas fa-sign-out-alt fa-fw me-3"></i>
                    <span>Sair</span>
                </a>
            <?php else : ?>
                <a href="/login" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-sign-in-alt fa-fw me-3"></i>
                    <span>Entrar</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<!-- Sidebar -->