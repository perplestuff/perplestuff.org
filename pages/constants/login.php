<div class="login">
  <header>[Login]</header>
  <?php if (isset($_SESSION['User'])) : ?>
    <p>Logged in as:</p>
    <?= $_COOKIE['User']; ?>

  <?php else : ?>
    <p>Not logged in.</p>
    <form method="POST" action="profile">
      <p>Username:</p>
        <input type="text" name="userName" size="15"/>
      <p>Password:</p>
        <input type="password" name="password" size="15" maxlength="50"/>
      <p>Remember Login?
        <input type="checkbox" name="remember"/></p>
      <p>Sign in.</p>
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
    $name = htmlspecialchars($_POST['userName']); //getting user inputs
    $pass = htmlspecialchars($_POST['password']);
    if ($name && $pass) { //verify the fields are not null
        $userInfo = $conf['database']->select( //getting all rows with same name input
            '*',
            'users',
            'name',
            $name
        );
        foreach ($userInfo as $login) { //goes through each results
            $ps = $login->pass; //grabs hashed password from each result
            if (password_verify($pass, $ps)) { //verifys password from result
                if (isset($_POST['remember'])) {
                    $rand = randStr(7);
                    setcookie('Access', $rand, time() + 86400 * 30);
                    $conf['database']->update(
                        'users',
                        'cookie',
                        $rand,
                        'id',
                        $login->id
                    );
                }
                user::session($login); //stores user info in session
                header('Refresh: 0'); //refreshes the page to show changes
            } else {warning('Failed to log in, either the name/password is wrong or the account does not exist.');}
        }
    } else {warning('One of the fields are blank, please try again.');}
}
?>
