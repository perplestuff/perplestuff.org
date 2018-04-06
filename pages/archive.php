<?php
//set how many outputs per page
$resultsNum = 5;
//get the page number if there is one
if (isset ($_GET ['page'])) {
  $pageNum = $_GET ['page'];
} else {
  $pageNum = 1;
}
//set the start output for the beginning of page
$pageStart = abs (($pageNum - 1) * $resultsNum) + 1;
//set the end output for the end of page
$pageEnd = $pageStart + $resultsNum - 1;
//fetch output from database
$results = $conf ['database'] ->between (
  'name, rank, pfp, descript, date',
  'users',
  'id',
  $pageStart,
  $pageEnd
);
//check if user submitted a search request then fetch it from database
if (isset ($_POST ['submit'])) {
  $search = htmlspecialchars ($_POST ['search']);

  $results = $conf ['database'] ->select (
    'name, rank, pfp, descript, date',
    'users',
    'name',
    $search
  );
  if (!$results) {
    warning ('There is no user with that name, please check it and try again.');
  }
}

 ?>
<?php require 'constants/header.php'; ?>
<div id="header">
  <header>[Archive]</header>
</div>
<body>
  <div id="left">
    <p>This is the archive, please stay awhile.</p>
    <?php require 'constants/nav.php'; ?>
    <div id="info">
      <p>You can use the search bar to lookup users which will show their name, profile picture, description, and the date they joined.</p>
      <p>Make shure you spell their name the exact way its displayed.</p>
      <p>Please report any problems to the administrator, this is still experimental.</p>
    </div>
  </div>
  <div id="center">
    <form action="archive" method="POST">
      <p>Please enter users name.</p>
      <input type="text" name="search" maxlength="15"/>
      <input type="submit" name="submit" value="Search."/>
    </form>
    <?php
    //count the total results from database
      $pageItems = $conf ['database'] ->count (
        'users'
      );
      //get the total number of pages and set them depending of current page
      $tabsTotal = ceil ($pageItems / $resultsNum);
      if ($tabsTotal < 11) {
        $tabsStart = 1;
        $tabsEnd = $tabsTotal;
      } elseif ($pageNum <= 5) {
        $tabsStart = 1;
        $tabsEnd = $tabsStart + 10;
      } elseif ($pageNum + 5 >= $tabsTotal) {
        $tabsStart = $tabsTotal - 10;
        $tabsEnd = $tabsTotal;
      } else {
        $tabsStart = $pageNum - 5;
        $tabsEnd = $pageNum + 5;
      }

      ?>

    <div id="profile">
      <?php for ($i = $tabsStart; $i <= $tabsEnd; $i++) : ?>
        <b>[<a
          <?php if ($pageNum == $i) {echo 'style="color:red;"';}?>
          href='<?= requests::URI().'?page='.$i ?>'
          ><?= $i ?></a>]</b>
      <?php endfor; ?>
      <?php if (isset ($results)) : ?>
        <?php foreach ($results as $res) : ?>
          <p>User:</p>
          <p><?= $res ->name; ?> [<?= $res ->rank; ?>]</p>
          <img src='<?= $res ->pfp; ?>'>
          <p><?= $res ->descript; ?></p>
          <p><?= $res ->date; ?></p>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</body>
<?php require 'constants/footer.php'; ?>
