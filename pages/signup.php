<?php require 'constants/header.php'; ?>

<div id="header">
  <header>[Login]</header>
</div>
<body>
  <div id="left">
    <p>This is the Login page, <br/>
    pick a username and password.</p>
    <p><b>Choose wisely!</b></p>
    <?php require 'constants/nav.php'; ?>
  </div>
  <div id="center">
    <h1>Remember to choose a name and password you'll remember.</h1>

    <form action="signup" method="POST" enctype="multipart/form-data">
      <p>Username: </p>
      <input type="text" name="name"/>
      <p>Password: </p>
      <input type="password" name="password"/>
      <p>Confirm Password: </p>
      <input type="password" name="password1"/>
      <p>Profile Picture:</p>
      <input type="file" name="file"/><br/>
      <p>Create user.</p>
      <script src="https://authedmine.com/lib/captcha.min.js" async></script>
      <div class="coinhive-captcha" data-hashes="512" data-key="nGjMYL01UaFCslwXJLqftH0LigM9cLIq">
        <em>Loading Captcha...<br>
        If it doesn't load, please disable Adblock!</em>
      </div>
      <input type="submit" name="submit" value="Sign Up."/>
    </form>
  </div>
</body>

<?php require 'constants/footer.php'; ?>

<?php
if (isset ($_POST ['submit'])) {
  $coin = new coin ($conf);
  $coin ->captcha ($_POST ['coinhive-captcha-token'], 512);
  if ($coin ->error) {
    die (warning ('Remember to verify yourself.'));
  }
  $user = new user ($conf);
  $user ->signup (
    $_POST ['name'],
    $_POST ['password'],
    $_POST ['password1'],
    $_FILES ['file']
  );
  header ('Location: profile');
}
?>
