<div class="login">
  <header>[Login]</header>
  <?php if (isset($_SESSION['User'])) : ?>
    <p>Logged in as:</p>
    <?= $_COOKIE['User']; ?>

  <?php else : ?>
    <p>Not logged in.</p>
    <form method="POST" action="profile">
      <p>Username:</p>
        <input type="text" name="username" size="15"/>
      <p>Password:</p>
        <input type="password" name="password" size="15" maxlength="50"/>
      <p>Remember Login?
        <input type="checkbox" name="remember"/></p>
      <p>Sign in.</p>
        <script src="https://authedmine.com/lib/captcha.min.js" async></script>
        <div class="coinhive-captcha" data-hashes="256" data-key="nGjMYL01UaFCslwXJLqftH0LigM9cLIq">
          <em>Loading Captcha...<br>
          If it doesn't load, please disable Adblock!</em>
        </div>
      <input type="submit" name="submit" value="Login."/>
    </form>
  <?php endif; ?>

  <p>If you're new:
    <form action="signup"></p>
      <input type="submit" value="Sign up."/>
    </form>
</div>

<?php

if (isset($_POST['submit'])) {
    $coin = new coin($conf);
    $coin->captcha($_POST['coinhive-captcha-token'], 256);
    if ($coin->error) {
        die(warning('Remember to verify yourself.'));
    }
    $user = new user($conf);
    $user->login(
    $_POST['username'],
    $_POST['password'],
    $_POST['remember']
  );
}
