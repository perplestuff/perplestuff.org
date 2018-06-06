<?php require_once 'constants/header.php'; ?>

<div id="header">
  <header>[Login]</header>
</div>
<body>
  <div id="left">
    <p>This is the Login page, <br/>
    pick a username and password.</p>
    <p><b>Choose wisely!</b></p>
    <?php require_once 'constants/nav.php'; ?>
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
      <input type="submit" name="submit" value="Sign Up."/>
    </form>
  </div>
</body>

<?php require_once 'constants/footer.php'; ?>

<?php
if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']); // getting user inputs
    $pass = htmlspecialchars($_POST['password']);
    $pass1 = htmlspecialchars($_POST['password1']);
    $file = $_FILES['file'];
    $date = date("d/m/y");
    $pfp = 'pages/storage/pfp/default.png';
    $rank = 'User';
    $filter = new filter([
        'txtLen'=>25,
        'txtCount'=>1,
        'fileTypes'=>['jpg', 'jpeg', 'png'],
        'maxSize'=>1000000
    ]);
    $upload = new upload([
        'conf'=>$conf,
        'dir'=>'pages/storage/pfp/'
    ]);
    if ($name && $pass) {
        $check = $conf['database']->select(
            'name',
            'users',
            'name',
            $name
        );
        if ($check !== '') {
            if ($pass == $pass1) {
                if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
                    $filter->txtLen($name);
                    $filter->txtCount($name);
                    $filter->fileTypes($file['name']);
                    $filter->maxSize($file['size']);
                    if (!$filter->error) {
                        $pfp = $upload->dir($file['name']);
                        $upload->fileUpload([
                            'from'=>$file['tmp_name'],
                            'to'=>$pfp
                        ]);
                    }
                }
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $conf['database']->insert('users', [
                    'name' => $name,
                    'pass' => $pass,
                    'date' => $date,
                    'pfp' => $pfp,
                    'rank' => $rank
                ]);
                warning('Success! please navigate to the profile tab and sign in.');
            } else {warning('Passwords do not match, please try again.');}
        } else {warning('Name already in use, please try another one.');}
    } else {warning('Either the username field or the password field is blank, please try again.');}
}
?>
