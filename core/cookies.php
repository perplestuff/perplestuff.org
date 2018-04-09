<?php

class cookies {
  public $conf,
    $error;

  public function __construct ($conf) {
    $this ->conf = $conf;
    $this ->error = 0;
  }
  public function verifyCookie ($info, $table, $column, $value) {
    $userInfo = $this ->conf ['database'] ->select (
      $info,
      $table,
      $column,
      $value
    );
    if ($userInfo) {
      return $userInfo;
    } else {
      $this ->error = 1;
    }
  }
  public function setCookie ($table, $column, $info, $value1, $value2, $cookie) {
    if (setcookie ($cookie, $info, time() + 86400 * 30)) {
      $userInfo = $this ->conf ['database'] ->update (
        $table,
        $column,
        $info,
        $value1,
        $value2
      );
    } else {
      $this ->error = 1;
    }
  }
  public function destroyCookie () {
    if (setcookie ($cookie, $info, time () + 86400 * 30)) {
      $userInfo = $this ->conf ['database'] ->update (
        $table,
        $column,
        $info,
        $value1,
        $value2
      );
    } else {
      $this ->error = 1;
    }
  }
}

 ?>
