<!-- VIEWER -->
<?php
if (isset($_POST['color']) && $_POST['color'] !== "") {
    $color = $_POST['color'];
    setcookie('color', $_POST['color'], time() + 86400 * 30);
} elseif(isset($_COOKIE['color'])) {
    $color = $_COOKIE['color'];
}
?>
<?php require_once 'constants/header.php'; ?>
<link rel="stylesheet" href="pages/constants/css/messageboard.css" type="text/css"/>
<script src=pages/constants/js/messageboard.js type="text/javascript"></script>
<div id="header">
  <header>[Messageboard]</header>
</div>
<body onload="refresh(),startScroll(),startMessage()">
    <div id="left">
        <p>This is the messageboard, have fun.</p>
        <?php require_once 'constants/nav.php'; ?>
        <div id="info">
            <p>Do not forget to log in!</p>
            <p>Max length of message is 150 characters. (this will be changed in the future.)</p>
            <p>Max amount of messages at a time is 50.</p>
            <p>There is a maximum of a 2 second delay to send messages for spam reasons.</p>
            <b>If an error occures please report this to the administrator immediately.</b>
            <p><b>The owner <u>does not</u> take responsibility<br/> for posts made here.</b></p>
            <small>The dates shown are local poster time.</small>
        </div>
    </div>
    <div id="right">

    </div>
    <div id="center">
        <?php require_once 'constants/messageinput.php'; ?>
    </div>
</body>

<?php require_once 'constants/footer.php'; ?>

<?php
//CONTROLLER
$filter = new filter([
    'txtLen'=>150,
    'txtCount'=>100,
    'fileTypes'=>['jpg', 'jpeg', 'png', 'gif'],
    'maxSize'=>1000000,
    'spamWord'=>['dirtynipples'],
    'spamStr'=>['i like men'],
    'ipBlock'=>['99999999999']
]);
$upload = new upload([
    'conf'=>$conf,
    'dir'=>'pages/storage/uploads/'
]);
$filter->ipBlock();
$okMsg = 0;
$okFile = 0;
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'].' ['.$_SESSION['rank'].']';
} else {
    $name = 'Anon [NULL]';
}
if (isset($_POST['msg']) && strlen($_POST['msg']) !== 0) {
    $msg = htmlspecialchars($_POST['msg']);
    $filter->spamWord($msg);
    $filter->spamStr($msg);
    $filter->txtLen($msg);
    $filter->txtLen($color);
    $filter->txtCount($msg);
    if (!$filter->error) {
        $okMsg = 1;
    }
}
if (isset($_FILES['file']) && $_FILES['file']['size'] !== 0) {
    $file = $_FILES['file'];
    $fileName = htmlspecialchars($file['name']);
    $filter->txtLen($fileName);
    $filter->fileTypes($fileName);
    $filter->maxSize($file['size']);
    if (!$filter->error) {
        $fileNN = $upload->dir($fileName);
        $upload->fileUpload(['from'=>$file['tmp_name'], 'to'=>$fileNN]);
        $okFile = 1;
    }
}
if (!$okFile && $okMsg) {
    $conf['database']->insert('msg', ['message'=>$msg, 'owner'=>$name, 'options'=>$color]);
} elseif ($okFile && !$okMsg) {
    $conf['database']->insert('msg', ['picture'=>$fileNN, 'owner'=>$name, 'options'=>$color]);
} elseif ($okFile && $okMsg) {
    $conf['database']->insert('msg', ['message'=>$msg, 'picture'=>$fileNN, 'owner'=>$name, 'options'=>$color]);
}
?>
