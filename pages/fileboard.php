<!-- VIEWER -->

<?php require_once 'constants/header.php'; ?>
<link rel="stylesheet" href="pages/constants/css/fileboard.css" type="text/css"/>
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
    <?php require_once 'constants/nav.php'; ?>
    <div id="info">
        <p>Max file size is <b>10 MB</b>.</p>
        <p>Max caption length is 15 chars.</p>
        <p>Max amount of images at a time is 15.</p>
        <p>Captions with spaces get converted into underscores. (for filesystem reasons.)</p>
        <p>The owner takes <u>no</u> responsibility for the posts made here.</p>
    </div>
  </div>
  <div id="right">

  </div>
  <div id="center">
    <!-- <div class="file">
      <form action="fileboard" method="POST" enctype="multipart/form-data">
      <p>Add a caption if you care to.</p>
      <input type="text" name="desc" maxlength="75"/>
      <p>Please select an image.</p>
      <input type="file" name="file" id="file"/>
      <input type="submit" value="Select Image." name="submit"/>
      </form>

      <div id="files">loading...</div>
    </div> -->
    <h1>[Currently under construction.]</h1>
  </div>
</body>
<?php require_once 'constants/footer.php'; ?>

<?php
// CONTROLLER
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filter = new filter([
        'txtLen'=>50,
        'fileTypes'=>['pdf', 'mp4', 'mp3', 'wav'],
        'maxSize'=>10000000
    ]);
}
?>
