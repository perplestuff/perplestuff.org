<?php 

function dd ($data) {
    echo '<pre>';
    var_dump ($data);
    die ('</pre>');
}

function age ($thot) {
    if ($thot <= 18) echo "get out";
    else
    echo "cum on in";
}