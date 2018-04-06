<?php

$name = $_POST['name'];
$rate = $_POST['rate'];
$recommend = $_POST['recommend'];
$suggestion = $_POST['suggestion'];
$data = $name . "," . $rate . "," . $recommend . "\n" . $suggestion . "\n";
$file = "user_info.csv";

file_put_contents($file, $data . PHP_EOL, FILE_APPEND);

print "<p>Thanks for posting.<br><br>Name: $name</br>Rating: $rate</br>Would Recomment: $recommend</p> Suggestion: $suggestion";


print "<p><br>your browser will refresh in 5 seconds.</p>";
header("Refresh:5; url=index.php");

?>
