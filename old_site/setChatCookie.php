<?php 

    $n = "User";

    $cn = $_POST["name"];



    $cn = str_replace("&", "&amp;", $cn);

    $cn = str_replace("<", "&lt;", $cn);

    $cn = str_replace(">", "&gt;", $cn);

    

    setcookie($n, $cn, time() + 86400,"/");

    

    if (isset($_COOKIE[$n])) {

        echo "<p>Cookie succssfully set. User Name:" . $_COOKIE[$n] . ".</p>";

    } else {

        echo "<p>Something failed, cookies not set.</p>";

    }

    

    header("Refresh:2; url=index.php");

?>

<html>

  <link href="style.css" type="text/css" rel="stylesheet">  

</html>