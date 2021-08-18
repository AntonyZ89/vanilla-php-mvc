<?php

use app\controllers\SiteController;

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/config/params.php');

SiteController::actionIndex();