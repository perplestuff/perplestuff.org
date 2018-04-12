huehue
<?php
echo "test";
require "core/bootstrap.php";
$data = $conf ['database']->selectAll('msg');
var_dump($data);
foreach ($data as $msg) {
    echo $msg;
}

 ?>
