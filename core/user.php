<?php

class user
{ //controls the user account
    public $conf;
    public $error;

    public function __construct($conf)
    { //grab conf and set error to null
        $this->conf = $conf;
        $this->error = 0;
    }
    public function login($name, $pass, $remember)
    { //login function
    $name = htmlspecialchars($name); //getting user inputs
    $pass = htmlspecialchars($pass);
        if ($name && $pass) { //verify the fields are not null
      $userInfo = $this->conf['database']->select( //getting all rows with same name input
        '*',
        'users',
        'name',
        $name
      );
            foreach ($userInfo as $login) { //goes through each results
        $ps = $login->pass; //grabs hashed password from each result
        if (password_verify($pass, $ps)) { //verifys password from result
          if (isset($remember)) {
              $rand = randStr(7);
              $cook = new cookies($this->conf);
              $cook->setCookie(
              'users',
              'cookie',
              $rand,
              'id',
              $login->id,
              'Access'
            );
          }
            warning('success!');
            self::session($login); //stores user info in session
          header('Refresh: 0'); //refreshes the page to show changes
        } else {
            warning('Failed to log in, either the name/password is wrong or the account does not exist.');
            $this->error = 1;
        }
            }
        }
    }
    public function signup($name, $pass, $pass1, $file)
    { //sign up function
    $name = htmlspecialchars($name); // getting user inputs
    $pass = htmlspecialchars($pass);
        $pass1 = htmlspecialchars($pass1);
        $date = date("d/m/y");
        $pfp = 'pages/storage/pfp/default.png';
        $rank = 'User';
        $dir = 'pages/storage/pfp/';

        if ($name && $pass) {
            $check = $this->conf['database']->select(
        'name',
        'users',
        'name',
        $name
      );
            if ($check) {
                die(warning('Name already in use, please try another one.'));
                $this->error = 1;
            }
            if ($pass !== $pass1) {
                die(warning('Passwords do not match, please try again.'));
                $this->error = 1;
            }
            if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
                $upload = new upload($name);
                $upload->file($file);
                $upload->fileFilters(
          array('jpg', 'jpeg', 'png', 'gif'),
          1000000,
          100
        );
                $upload->pfp(
          $dir,
          $name
        );
                if (!$upload->error) {
                    $pfp = $dir.$name.'.'.$upload->file['fileEXT'];
                }
            }
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $this->conf['database']->insert('users', [
        'name' => $name,
        'pass' => $pass,
        'date' => $date,
        'pfp' => $pfp,
        'rank' => $rank
      ]);
        } else {
            warning('Either the username field or the password field is blank, please try again.');
            $this->error = 1;
        }
    }
    public function edit($dir, $currentN, $pfp, $desc, $userName, $pass, $confPass)
    {
        if ($userName) {
            if (strlen($userName) <= 15) {
                $currentN = $userName;
                $this->conf['database']->update(
          'users',
          'name',
          $userName,
          'id',
          $_SESSION['id']
        );
            } else {
                die(warning('Username is too long, please shorten it to 15 charactors.'));
                $this->error = 1;
            }
        }
        if (isset($pfp['name']) && $pfp['size'] !== 0) {
            $upload = new upload($currentN);
            $upload->file($pfp);
            $upload->fileFilters(
        array('jpg', 'jpeg', 'png', 'gif'),
        1000000,
        100
      );
            $upload->pfp(
        $dir,
        $currentN
      );
            $this->conf['database']->update(
        'users',
        'pfp',
        $dir.$currentN.'.'.$upload-> file['fileEXT'],
        'id',
        $_SESSION['id']
      );
        }
        if ($desc) {
            if (strlen($desc) <= 50) {
                $this->conf['database']->update(
          'users',
          'descript',
          $desc,
          'id',
          $_SESSION['id']
        );
            } else {
                die(warning('Description is too long, please shorten it to 50 characters.'));
                $this->error = 1;
            }
        }
        if ($pass && $confPass) {
            if ($pass == $confPass) {
                $this->conf['database']->update(
          'users',
          'pass',
          password_hash($pass, PASSWORD_DEFAULT),
          'id',
          $_SESSION['id']
        );
            } else {
                die(warning('Passwords do not match, please try agian.'));
                $this->error = 1;
            }
        }
        session_destroy();
    }
    public static function session($login)
    {
        $_SESSION =[
      'id' => $login->id,
      'name' => $login->name,
      'date' => $login->date,
      'pfp' => $login->pfp,
      'rank' => $login->rank,
      'desc' => $login->descript
    ];
    }
}
