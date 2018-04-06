<?php

function dd ($data) {
    echo '<pre>';
    var_dump ($data);
    echo '</pre>';
}

function randStr ($len) {
  $randStr = bin2hex (random_bytes ($len));
  return $randStr;
}

function warning ($msg) {
  echo "<script type='text/javascript'>
  alert ('$msg');
  </script>";
}

function normal_chars ($string)
{
    $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
    $string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
    $string = preg_replace(array('~[^0-9a-z]~i', '~[ -]+~'), ' ', $string);

    return trim($string, ' -');
}
