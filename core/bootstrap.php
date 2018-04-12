<?php
$conf =[];

$conf['conf'] = require 'config.php';

require 'core/router.php';
require 'core/functions.php';
require 'core/database.php';
require 'core/user.php';
require 'core/upload.php';
require 'core/coin.php';
require 'core/cookies.php';

$conf['database'] = new Query(
    connection::make($conf['conf']['database'])
);
$conf['coin'] = $conf['conf']['coin'];
