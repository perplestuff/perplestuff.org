<?php
ini_set ('display_errors',1);
ini_set ('display_startup_errors',1);
error_reporting (E_ALL);

require 'core/bootstrap.php';

// var_dump ($_COOKIE ['Access']);
require route::load ('routes.php')
  ->direct (requests::URI(), requests::METHOD());
