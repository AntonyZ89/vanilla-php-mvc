<?php

/**
 * @var string $content
 * @var User|null $user logged user
 */

use app\manager\View;
use app\widgets\Alert;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="/src/assets/css/main.css">
    <link rel="stylesheet" href="/src/assets/css/sidebar.css">
    <link rel="stylesheet" href="/src/assets/css/alert.css" />
</head>

<body>
    <?= View::render('layout', '_header', ['user' => $user]) ?>

    <!--Main layout-->
    <main style="margin-top: 68px" class="mb-2">
        <div class="container">

            <?php Alert::run() ?>

            <?= $content ?>
        </div>
    </main>
    <!--Main layout-->

    <?= View::render('layout', '_footer') ?>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
    <!-- script -->
    <script type="text/javascript" src="/src/assets/js/script.js"></script>
    <script type="text/javascript" src="/src/assets/js/validation.js"></script>
</body>

</html>