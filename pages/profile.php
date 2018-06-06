<?php require_once 'constants/header.php'; ?>
<?php

if (isset($_POST ['logOut'])) {
    session_destroy();
    setcookie('Access', '', time()-3600);
    header("Refresh: 0");
}

 ?>
<div id="header">
  <header>[Profile]</header>
</div>
<div id="left">
  <?php require_once 'constants/nav.php'; ?>
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
        <input type="submit" name="update" value="Update info." title="Update info."/>
      </form>
    </div>
  </div>
  <div id="center">
    <div id="profile">
      <header><?= '~'.$_SESSION['name'].' ['.$_SESSION['rank'].']'; ?></header><br/>
      <img src='<?= $_SESSION['pfp']; ?>'/><br/>
      <?php if ($_SESSION['desc']) : ?>
        <p><?= $_SESSION['desc']; ?></p>
      <?php else : ?>
        <p>No description available.</p>
      <?php endif; ?>
    </div>
  </div>
<?php else : ?>
  <div id="right">
    <?php require_once 'constants/login.php'; ?><br/>
  </div>
  <div id="center">
    <div id="profile">
      <header>~Not logged in [NULL]</header><br/>
      <img src='pages/img/unknown.jpg'/><br/>

    </div>
  </div>
<?php endif; ?>
<?php require_once 'constants/footer.php'; ?>

<?php
if (isset($_POST['update'])) {
    $currentName = $_SESSION['name'];
    $pfp = $_FILES['pfp'];
    $desc = htmlspecialchars($_POST['desc']);
    $userName = htmlspecialchars($_POST['userName']);
    $pass = htmlspecialchars($_POST['pass']);
    $confPass = htmlspecialchars($_POST['confPass']);
    $filter = new filter([
        'txtLen'=>25,
        'txtCount'=>3,
        'fileTypes'=>['jpg', 'jpeg', 'png'],
        'maxSize'=>1000000
    ]);
    $upload = new upload([
        'conf'=>$conf,
        'dir'=>'pages/storage/pfp/'
    ]);

    if (isset($pfp['name']) && $pfp['size'] !== 0) {
        $filter->txtLen($pfp['name']);
        $filter->txtCount($pfp['name']);
        $filter->fileTypes($pfp['name']);
        $filter->maxSize($pfp['size']);
        $file = $upload->dir($pfp['name']);
        if (!$filter->error) {
            $upload->fileUpload([
                'from'=>$pfp['tmp_name'],
                'to'=>$file
            ]);
            $conf['database']->update(
                'users',
                'pfp',
                $file,
                'id',
                $_SESSION['id']
            );
        }
    }
    if ($desc) {
        if (strlen($desc) <= 50) {
            $conf['database']->update(
                'users',
                'descript',
                $desc,
                'id',
                $_SESSION['id']
            );
        } else {
            warning('Description is too long, please shorten it to 50 characters.');
        }
    }
    if ($pass || $confPass) {
        if ($pass == $confPass) {
                $conf['database']->update(
                'users',
                'pass',
                password_hash($pass, PASSWORD_DEFAULT),
                'id',
                $_SESSION['id']
            );
        } else {
            warning('Passwords do not match, please try again.');
        }
    }
    if ($userName) {
        $filter->txtLen($userName);
        $filter->txtCount($userName);
        if (!$filter->error) {
            $currentName = $userName;
            $conf['database']->update(
                'users',
                'name',
                $userName,
                'id',
                $_SESSION['id']
            );
        }
    }
    session_destroy();
    header("Refresh: 0");
}
?>
