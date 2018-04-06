<?php

$fileName = "messages.txt";
$maxLines = 15;
$maxAlies = 15;
$postIdle = 3;
$maxStrlen = 125;
$minStrlen = 2;
$maxSameStr = 5;


$spamWords = array(
    "cUMDicC!!11!"
);

$ipBlock = array(
    "i hope i never have to do this."
);

$spamString = array(
    "my name jeff",
    "damn daniel",
    "21 haha im funny",
);

$message = $_GET["message"];
$name = $_COOKIE["User"];

$message = str_replace("&", "&amp;", $message);
$message = str_replace("<", "&lt;", $message);
$message = str_replace(">", "&gt;", $message);


if ($postIdle > 0) {
    $lastVisit = $_COOKIE["perplestuff"];
    setcookie("perplestuff", time());

    if ($lastVisit != "") {
        $timeDifference = time() - $lastVisit;
        if ($timeDifference < $postIdle) {
            die("Spam detected, please wait " . $timeDifference . "seconds more.");
        }
    }
}

if ($name !== "") {
    if (strlen($message) < $minStrlen) {
        die("Under minimum text length: " . $minStrlen . ", please try again.");
    }
    if (strlen($message) > $maxStrlen) {
        die("Over maximum text length: " . $maxStrlen . ", please try again.");
    }
    if (strlen($message) > 10) {
        if (substr_count($message, substr($message,4,6)) > 1) {
            die("Spam detected, too little variaty in you message, please try again.");
        }
    }
    foreach ($ipBlock as $a) {
        if ($_SERVER["REMOTE_ADDR"] == $a) {
            die("Your IP has been blocked, if this is a mistake, contact @perplestuff on twitter.");
        }
    }
    $myString = strtoupper($message);
    foreach ($spamWords as $a) {
        if (strpos($myString, strtoupper($a)) === false) {
            /*Its all good in the hood.*/
        } else {
            die("You have used a word that has been blocked, please review the rules on the messageboard page and please try again.");
        }
    }
    foreach ($spamString as $a) {
        if (strtoupper($message) == strtoupper($a)) {
            die("You have use a string that has been blocked, please review the rules on the messageboard page and please try again.");
        }
    }
}


$hand = fopen ($fileName,'r');
$messageFile = fread ($hand, filesize($fileName));
fclose($hand);

$preArr = explode ("<br>", $messageFile);

if (count($preArr) > $maxLines) {
    $preArr = array_reverse ($preArr);
    for ($i=0; $i<$maxLines; $i++) {
        $postArr[$i] = $preArr[$i];
    }
    $postArr = array_reverse($postArr);
} else {
    $postArr = $preArr;
}

$messageFile = implode ("<br>", $postArr);

if (substr_count($messageFile, $message) > $maxSameStr) {
    die("Spam detected, message has already been sent " . $maxSameStr . " times, please try again.");
}

$space = "";
if (strlen($name) > $maxAlies-1) $name = substr($name, 0, $maxAlies-1);
for ($i=0; $i<($maxAlies - strlen($name)); $i++) $space .= " ";

$out = $messageFile . $name . $space . ": " . $message . "<br>";
$out = str_replace ("\'", "'", $out);
$out = str_replace ("\\\"", "\"", $out);

$hand = fopen ($fileName, 'w');
fwrite ($hand, $out);
fclose($hand);
?>
