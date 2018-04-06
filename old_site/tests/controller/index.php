<?php

$tasks = $database->selectAll ('todos');

require 'index.view.php';
