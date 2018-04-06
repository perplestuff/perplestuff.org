
<!-- VIEWER -->

<?php require 'constants/header.php'; ?>
<script type="text/javascript">

function submit_msg() {
    var message = message.value;
    var xmlHttp = new XMLHttpRequest();

    xmlhttp.open('GET','messageboard?message='+message, true);
    xmlhttp.send();
}

$(document).ready(function(e){
    $.ajaxSetup({cache:false});
    setInterval(function(){
        $('#chat').load('pages/storage/messages.txt');
    },1000);
});

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var chats = document.getElementById("chat").innerHTML = xmlhttp.responseText;
    }
}
</script>

<div id="header">
  <header>[Messageboard]</header>
</div>
<body>
  <div id="left">
    <p>This is the messageboard, have fun.</p>
    <?php require 'constants/nav.php'; ?>
    <div id="info">
      <p>Do not forget to log in!</p>
      <p>Max length of message is 150 charactors. (this will be changed in the future.)</p>
      <p>Max amount of messages at a time is 25.</p>
      <p>There is a maximum of a 2 second delay to send messages for spam reasons.</p>
      <b>If an error occures please report this to the administrator immediately.</b>
      <p><b>The owner <u>does not</u> take responsibility<br/> for posts made here.</b></p>
      <small>The dates shown are local server time.</small>
    </div>
  </div>
  <div id="right">

  </div>
  <div id="center">
    <div class="msg">
      <div id="chat"><p>Loading...</p></div>
      <form action="messageboard">
        <p>Message: <input type="text" name="message" size="35" autofocus /></p>
        <button onclick="submit_msg()" value="Submit">Send Message</button><br/>
      </form>
    </div>
  </div>
</body>

<?php require 'constants/footer.php'; ?>

<?php

// CONTROLLER
if (isset ($_GET ['message'])) {
  if ($_SESSION) {
    //username
    $up = new upload ($_SESSION ['name']);
    //message, postIdle
    $up ->msg (
      $_GET ['message'],
      1
    );
    //max str length, min str length
    $up ->msgFilters (
      100,
      1
    );
    //ipBlock, spamwords, spamstr, maxlines, file location, maxSamestr
    $up ->messageboard (
      '',
      '',
      '',
      25,
      3,
      'pages/storage/messages.txt'
    );
  } else {
    warning ('You are not logged in, please try again.');
  }
}


// $fileName = "pages/storage/messages.txt";
// $maxLines = 15;
// $maxAlies = 15;
// $postIdle = 3;
// $maxStrlen = 125;
// $minStrlen = 2;
// $maxSameStr = 5;
//
//
// $spamWords = array(
//     "cUMDicC!!11!"
// );
//
// $ipBlock = array(
//     "i hope i never have to do this."
// );
//
// $spamString = array(
//     "my name jeff",
//     "damn daniel",
//     "21 haha im funny",
// );
//
// $message = htmlspecialchars ($_GET["message"]);
// $name = htmlspecialchars ($_COOKIE["User"]);
//
// if ($postIdle > 0) {
//     $lastVisit = $_COOKIE["perplestuff"];
//     setcookie("perplestuff", time());
//
//     if ($lastVisit != "") {
//         $timeDifference = time() - $lastVisit;
//         if ($timeDifference < $postIdle) {
//             die("Spam detected, please wait " . $timeDifference . "seconds more.");
//         }
//     }
// }
//
// if ($name && $message) {
//     if (strlen($message) < $minStrlen) {
//         warning ("Under minimum text length: " . $minStrlen . ", please try again.");
//     }
//     if (strlen($message) > $maxStrlen) {
//         warning ("Over maximum text length: " . $maxStrlen . ", please try again.");
//     }
//     if (strlen($message) > 10) {
//         if (substr_count($message, substr($message,4,6)) > 1) {
//             warning ("Spam detected, too little variaty in you message, please try again.");
//         }
//     }
//     foreach ($ipBlock as $a) {
//         if ($_SERVER["REMOTE_ADDR"] == $a) {
//             warning ("Your IP has been blocked, if this is a mistake, contact @perplestuff on twitter.");
//         }
//     }
//     $myString = strtoupper($message);
//     foreach ($spamWords as $a) {
//         if (strpos($myString, strtoupper($a)) === false) {
//             /*Its all good in the hood.*/
//         } else {
//             warning ("You have used a word that has been blocked, please review the rules on the messageboard page and please try again.");
//         }
//     }
//     foreach ($spamString as $a) {
//         if (strtoupper($message) == strtoupper($a)) {
//             warning ("You have use a string that has been blocked, please review the rules on the messageboard page and please try again.");
//         }
//     }
//
//     $hand = fopen ($fileName,'r');
//     $messageFile = fread ($hand, filesize($fileName));
//     fclose($hand);
//
//     $preArr = explode ("<br/>", $messageFile);
//
//     if (count($preArr) > $maxLines) {
//         $preArr = array_reverse ($preArr);
//         for ($i=0; $i<$maxLines; $i++) {
//             $postArr[$i] = $preArr[$i];
//         }
//         $postArr = array_reverse($postArr);
//     } else {
//         $postArr = $preArr;
//     }
//
//     $messageFile = implode ("<br/>", $postArr);
//
//     if (substr_count($messageFile, $message) > $maxSameStr) {
//         warning ("Spam detected, message has already been sent " . $maxSameStr . " times, please try again.");
//     }
//
//     $space = "";
//     if (strlen($name) > $maxAlies-1) $name = substr($name, 0, $maxAlies-1);
//     for ($i=0; $i<($maxAlies - strlen($name)); $i++) $space .= " ";
//
//     $out = $messageFile . "<b style='color:red;'>" . $name . "</b>" . $space . ": " . $message . "<br/>";
//     $out = str_replace ("\'", "'", $out);
//     $out = str_replace ("\\\"", "\"", $out);
//
//     $hand = fopen ($fileName, 'w');
//     fwrite ($hand, $out);
//     fclose($hand);
// }
