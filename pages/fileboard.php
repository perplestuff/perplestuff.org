<!-- VIEWER -->

<?php require 'constants/header.php'; ?>
<script>
    $(document).ready(function(e){
        $.ajaxSetup({cache:false});
        setInterval(function(){
            $('#files').load('pages/storage/file.txt');
        },1000);
    });
</script>
<div id="header">
  <header>[Fileboard]</header>
</div>
<body>
  <div id="left">
    <p>This is the fileboard, please be careful.</p>
    <?php require 'constants/nav.php'; ?>
    <div id="info">
        <p>Max file size is <b>1 MB</b>.</p>
        <p>Max caption length is 15 chars.</p>
        <p>Max amount of images at a time is 15.</p>
        <p>Captions with spaces get converted into underscores. (for filesystem reasons.)</p>
        <p>The owner takes <u>no</u> responsibility for the posts made here.</p>
    </div>
  </div>
  <div id="right">

  </div>
  <div id="center">
    <div class="file">
      <form action="fileboard" method="POST" enctype="multipart/form-data">
      <p>Add a caption if you care to.</p>
      <input type="text" name="desc" maxlength="75"/>
      <p>Please select an image.</p>
      <input type="file" name="file" id="file"/>
      <input type="submit" value="Select Image." name="submit"/>
      </form>

      <div id="files">loading...</div>
    </div>
  </div>
</body>
<?php require 'constants/footer.php'; ?>

<?php
// CONTROLLER
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $up = new upload ($_SESSION['name']);
  $up->file ($_FILES['file']);
  $up->fileFilters (
    array ('jpg', 'jpeg', 'png', 'gif'),
    1000000,
    75
  );
  $up->fileboard (
    $_POST['desc'],
    'pages/storage/file.txt',
    'pages/storage/uploads/',
    15
  );
  // $up ->fileboard ($_FILES ['file'], $_POST ['desc']);
}






// $upload = 1;
// $dir = 'pages/storage/uploads/';
// $fileTXT = 'pages/storage/file.txt';
// $maxFileSize = 1000000;
// $maxLines = 10;
//
// $allowedFile = array (
//     'jpg',
//     'jpeg',
//     'png',
//     'gif'
// );
//
// $userName = $_COOKIE ['User'];
//
// if ($_FILES && $userName) {
// $file = $_FILES ['file'];
// $fileN = htmlspecialchars ($file ['name']);
// $fileTN = $file ['tmp_name'];
// $fileS = $file ['size'];
// $fileE = $file ['error'];
// $fileT = $file ['type'];
//
// str_replace ("~", "", $fileN);
// str_replace (" ", "", $fileN);
//
//
//
// $ext = explode ('.', $fileN);
// $fileEXT = strtolower (end ($ext));
// $fileNN = uniqid ('', true).".".$fileN;
//
// if (file_exists ($dir . $fileN)) {
// warning ('The file already exists.');
// $upload = 0;
// }
// if ($fileS > $maxFileSize) {
// warning ('The filesize is too big, please reduce it and try again.');
// $upload = 0;
// }
// if ($fileE === 1) {
// warning ('There was a file error, please try again.');
// $upload = 0;
// }
// if (in_array ($fileEXT, $allowedFile)) {
//   /*is all gud*/
// } else {
// warning ('The current file type: ' . $fileEXT . ', is not allowed.');
// $upload = 0;
// }
//
// if ($upload !== 0 && $upload !== 1) {
//     warning ('Critical error found, please report this to the administrator, thanks.');
//     die();
// }
//     if ($upload === 1) {
//       move_uploaded_file ($fileTN, $dir.$fileN);
//
//       $hand = fopen ($fileTXT, 'r');
//       $fileINFO = fread ($hand, filesize ($fileTXT));
//       fclose ($hand);
//
//       $preArr = explode ("~", $fileINFO);
//       if (count($preArr) > $maxLines) {
//         for ($i=0; $i < $maxLines; $i++) {
//           $postArr [$i] = $preArr[$i];
//         }
//       } else {
//         $postArr = $preArr;
//       }
//       $fileINFO = implode ("~", $postArr);
//
//       $out = "~<b style='color:red;'>" . $userName . "</b>: <br/><img src='" . $dir . $fileN . "'><br/><br/>" . $fileINFO;
//
//       file_put_contents ($fileTXT, $out);
//     } else {
//     warning ('File not sent, please try again.');
//     die();
//     }
// }
 ?>
