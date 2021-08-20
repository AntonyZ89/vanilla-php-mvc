<?php

/**
 * @var string $content
 */

use app\manager\View;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="/src/assets/css/login.css" />
    <link rel="stylesheet" href="/src/assets/css/alert.css" />
</head>

<body class="login">
    <!--Main Navigation-->
    <header>
        <?= $content ?>
    </header>
    <!--Main Navigation-->

    <?= View::render('layout', '_footer') ?>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.9.0/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="/src/assets/js/validation.js"></script>
</body>

</html>