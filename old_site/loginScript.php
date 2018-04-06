<?php




$n = "User";
$cn = htmlspecialchars ($_POST["username"]);

setcookie($n, $cn, time() + 86400,"/");

header ('Refresh:0 url=/');
?>

<!-- include 'pages/constants/header.php';
header ("Refresh: 10; URL=http://perplestuff.org");

$name = htmlspecialchars ($_REQUEST ['username']);
$password = htmlspecialchars ($_REQUEST ['password']);

echo "<p>This is test dont actually put a real username or password</p><br/>
<b>Name: $name<br/>
password: $password</b>";

echo "<p>This feature will be added as soon as possible.</p><br/>
<b>This page will refresh in 10 seconds.";

include 'pages/constants/footer.php'; -->
