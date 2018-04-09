<?php require 'constants/header.php'; ?>
<?php

if (isset ($_POST ['logOut'])) {
  session_destroy ();
  setcookie ('Access', '', time ()-3600);
  header ("Refresh: 0");
}

 ?>
<div id="header">
  <header>[Profile]</header>
</div>
<div id="left">
  <?php require 'constants/nav.php'; ?>
  <div id="info"><br/>
    <ul>
      <li>Max length of name is 15.</li>
      <li>Max length of description is 50.</li>
      <li>Max file size of pfp is 1MB.</li>
    </ul>
    <b>If you forgot your username or password contact the administrator with proof of that identity.</b><br/><br/>
    <b>If you have any other problems logging in please report it to the administrator immediately.</b>
  </div>
</div>
<?php if ($_SESSION) : ?>
  <div id="right">
    <div id="user">
      <p>Welcome home.</p><br/>
      <p>[Options]</p>
      <small>Change any setting you want.</small><br/>
      <b>Refresh the page to view changes.</b>
      <form action ="profile" method="POST">
        <p>Logout.</p>
        <input type="submit" name="logOut" value="Logout." title="Logout."/>
      </form>
      <form action="profile" method="POST" enctype="multipart/form-data"><br/>
        <p>Change pfp.</p>
        <input type="file" name="pfp" title="New pfp."/>
        <p>Change description.</p>
        <input type="text" name="desc" title="New description."/>
        <p>Change user name.</p>
        <input type="text" name="userName" title="New name."/>
        <p>Change password.</p>
        <input type="password" name="pass"  title="New password."/>
        <p>Confirm password.</p>
        <input type="password" name="confPass" title="New password."/>
        <p>Submit changes.</p>
        <script src="https://authedmine.com/lib/captcha.min.js" async></script>
        <div class="coinhive-captcha" data-hashes="256" data-key="nGjMYL01UaFCslwXJLqftH0LigM9cLIq">
          <em>Loading Captcha...<br>
		      If it doesn't load, please disable Adblock!</em>
	      </div>
        <input type="submit" name="update" value="Update info." title="Update info."/>
      </form>
    </div>
  </div>
  <div id="center">
    <div id="profile">
      <header><?= '~'.$_SESSION ['name'].' ['.$_SESSION ['rank'].']'; ?></header><br/>
      <img src='<?= $_SESSION ['pfp']; ?>'/><br/>
      <?php if ($_SESSION ['desc']) : ?>
        <p><?= $_SESSION ['desc']; ?></p>
      <?php else : ?>
        <p>No description available.</p>
      <?php endif; ?>
    </div>
  </div>
<?php else : ?>
  <div id="right">
    <?php require 'constants/login.php'; ?><br/>
  </div>
  <div id="center">
    <div id="profile">
      <header>~Not logged in [NULL]</header><br/>
      <img src='pages/img/unknown.jpg'/><br/>

    </div>
  </div>
<?php endif; ?>
<?php require 'constants/footer.php'; ?>

<?php
$user = new user ($conf);
if (isset ($_POST ['update'])) {
  $coin = new coin ($conf);
  $coin ->captcha ($_POST ['coinhive-captcha-token'], 256);
  if ($coin ->error) {
    die (warning ('Remember to verify yourself.'));
  }
  $user ->edit (
    'pages/storage/pfp/',
    $sesh ['name'],
    $_FILES ['pfp'],
    $_POST ['desc'],
    $_POST ['userName'],
    $_POST ['pass'],
    $_POST ['confPass']
  );
  header ("Refresh: 0");
}



?>
