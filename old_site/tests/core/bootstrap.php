<?php

$config = require 'config.php';
require 'core/router.php';
require 'core/database/connection.php';
require 'core/database/query_builder.php';

require 'core/functions.php';

return new queryBuilder (
    connection::make ($config ['database'])
);
