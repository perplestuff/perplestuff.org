<!-- VIEWER -->
<?php require 'constants/header.php'; ?>
<script type="text/javascript">
// var timeID = 0;
// $(document).ready(function()
// {
//     $('#post').bind('keypress', function(e)
//     {
//         if ((e.keyCode || e.which) == 13) {
//             sendMsg();
//             $('#msg').val('');
//         }
//     });
//     $('#submit').click(function()
//     {
//         sendMsg();
//         $('#msg').val('');
//     });
// });
// function sendMsg()
// {
//     var msg = $('#msg').val();
//     var request = new XMLHttpRequest();
//     request.open('GET', 'messageboard?msg='+msg, true);
//     request.send();
// }
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
        <div id="chat">...</div>
        <div id="post">
            <form action="messageboard" method="POST" enctype="multipart/form-data" id="messageboard">
                <p>Message: <input type="text" name="msg" id="msg" size="35" autofocus /></p>
                <p>Options: <select name="color" id="color">
                    <option value="style='color:green;'">green</option>
                    <option value="style='color:blue;">blue</option>
                    <option value="style='color:yellow;">yello</option>
                    <option value="style='color:purple;">purple</option>
                    <option value="style='color:orange;">orange</option>
                    <option value="style='color:pink;">pink</option>
                    <option value="style='color:red;">red</option>
                </select>
                </p>
                <p>File: <input type="file" name="file" id="file"/></p>
                <input type="submit" value="Submit." id="submit"/><br/>
            </form>
        </div>
    </div>
</body>

<?php require 'constants/footer.php'; ?>

<?php
//CONTROLLER
$filter = new filter([
    'txtLen'=>150,
    'txtCount'=>100,
    'fileTypes'=>['jpg', 'jpeg', 'png', 'gif'],
    'maxSize'=>1000,
    'dir'=>'pages/storage/img'
]);
$upload = new upload(['conf'=>$conf]);
if (isset($_GET['timeID'])) {
    $id = intval($_GET['timeID']);
    $jsonData = $upload->getLines($id);
    print $jsonData;
}
$color = htmlspecialchars($_POST['color']);
if (isset($_POST['msg'])) {
    $msg = htmlspecialchars($_POST['msg']);
    $filter->txtLen($msg);
    $filter->txtLen($color);
    $filter->txtCount($msg);
    if (!$filter->error) {
        $upload->messageboard(['msg'=>$msg,'owner'=>'lol','options'=>$color]);
    }
}
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = htmlspecialchars($file['name']);
    $filter->txtLen($fileName);
    $filter->fileType($fileName);
    $filter->maxSize($file['size']);
    $upload->fileUpload($fileName);
    if (!$filter->error) {
        $upload->messageboard(['picture'=>$fileName,'owner'=>'lol','options'=>$color]);
    } else {
        warning('error.');
    }
}
?>
