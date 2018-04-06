<?php
ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL);

$database = require 'core/bootstrap.php';

$router = new Router;

require 'routes.php';

$uri = trim ($_SERVER ['REQUEST_URI'], '/');


require $router->direct($uri);
