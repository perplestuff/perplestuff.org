<?php

class upload {
  //set properties
  private $userName,
    $message;
  public $file,
    $error;

  public function __construct ($userName) {
    //give properties correct values
    $this ->userName = htmlspecialchars ($userName);
    $this ->error = 0;
  }

  public function msg ($message, $postIdle) {
    $this ->message = htmlspecialchars ($message);
    if ($postIdle > 0) {
      $lastIdle = $_COOKIE ['idleTime'];
      setcookie ('idleTime', time ());
      if ($lastIdle) {
        $idleDifference = time () - $lastIdle;
        if ($idleDifference <= $postIdle) {
          warning ('Spam detected, please wait '.$postIdle.' seconds.');
          $this ->error = 1;
        }
      }
    }
  }

  public function file ($file) {
    //get file info
    $fileT = $file ['type'];
    $fileS = $file ['size'];
    $fileN = htmlspecialchars ($file ['name']);
    $fileTN = $file ['tmp_name'];
    $fileE = $file ['error'];
    //get file extension
    $ext = explode ('.', $fileN);
    $fileEXT = strtolower (end ($ext));
    //return info
    $this ->file = array (
      'fileT' => $fileT,
      'fileS' => $fileS,
      'fileN' => $fileN,
      'fileTN' => $fileTN,
      'fileE' => $fileE,
      'fileEXT' => $fileEXT
    );
  }

  public function msgFilters ($maxStrlen, $minStrlen) { //filter msg length
    if (strlen ($this ->message) < $minStrlen) {
      warning ('Under minimum text length: '.$minStrlen.', please try again.');
      $this ->error = 1;
    }
    if (strlen ($this ->message) > $maxStrlen) {
      warning ('Over maximum text length: '.$maxStrlen.', please try again.');
      $this ->error = 1;
    }
  }

  public function fileFilters ($formats, $maxSize, $maxName) { //filter out bad files
    //call file function
    extract ($this ->file);
    //filters
    $error = 0;
    if (!$this ->userName) {
      warning ('Uknown user, please login or use the Anon account.');
      $this ->error = 1;
    }
    if (!in_array ($fileEXT, $formats)) {
      warning ('The file type is not supported, please choose a different one.');
      $this ->error = 1;
    }
    if ($fileS > $maxSize) {
      warning ('The file size is too big, please compress it or use a different one.');
      $this ->error = 1;
    }
    if (strlen ($fileN) > $maxName) {
      warning ('The file name is too long, please shorten it.');
      $this ->error = 1;
    }
    if ($fileE) {
      warning ('There was an error while uploading the file, please try again.');
      $this ->error = 1;
    }
    if ($this ->error == 0 && $this ->error == 1) {
      warning ('there has been a server error, please contact the administrator.');
    }
  }

  public function fileboard ($desc, $info, $dir, $maxLines) {
    //call file function
    extract ($this ->file);
    //more fileboard specific filters
    if (!$desc) {
      $caption = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $fileN);
    } else {
      $caption = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $desc);
      $caption = $caption.".".$fileEXT;
    }
    if (file_exists ($dir.$caption)) {
      warning ('The file name already exists, please change it.');
      $this ->error = 1;
    }
    //upload process
    if (!$this ->error) {
      move_uploaded_file ($fileTN, $dir.$caption);

      $hand = fopen ($info, 'r');
      $fileInfo = fread ($hand, filesize ($info));
      fclose ($hand);

      $preArr = explode ('~', $fileInfo);
      if (count ($preArr) > $maxLines) {
        for ($i = 0; $i < $maxLines; $i++) {
          $postArr [$i] = $preArr [$i];
        }
      } else {
        $postArr = $preArr;
      }
      $fileInfo = implode ("~", $postArr);

      $out = "~<b style='color:green;'>".$this ->userName.' ['.$_SESSION ['rank']."] : </b>
      <p>".$caption."</p>
      <img src='".$dir.$caption."'>
      <br/><br/>"
      .$fileInfo;

      file_put_contents ($info, $out);
    } else {
      warning ('File not sent, please try again.');
    }
  }

  public function messageboard ($ipBlock, $spamWords, $spamStr, $maxLines, $maxSamestr, $info) {
    if ($ipBlock && $spamWords && $spamStr) {
      $lowerStr = strtolower ($this ->message);
      foreach ($ipBlock as $a) {
        if ($_SERVER ['REMOTE_ADDR'] == $a) {
          warning ('Your IP has been blocked, if this is a mistake, please contact the administrator.');
          $this ->error = 1;
        }
      }
      foreach ($spamWords as $a) {
        if (strpos ($lowerStr, strtolower ($a))) {
          warning ('You have used a word that was marked as spam, if this is a mistake please contact the administrator.');
          $this ->error = 1;
        }
      }
      foreach ($spamStr as $a) {
        if ($lowerStr == strtolower ($a)) {
          warning ('You have used a string that has been marked as spam, if this is a mistake please contact the adminitrator.');
          $this ->error = 1;
        }
      }
    }
    $hand = fopen ($info, 'r');
    $msgFile = fread ($hand, filesize ($info));
    fclose ($hand);

    if (substr_count ($msgFile, $this ->message) > $maxSamestr) {
      warning ('Spam detected, message has already been sent '.$maxSamestr.' times, please try again.');
      $this ->error = 1;
    }

    if (!$this ->error) {
      $preArr = explode ('<br/>', $msgFile);

      if (count ($preArr) > $maxLines) {
        $preArr = array_reverse ($preArr);
        for ($i=0; $i < $maxLines; $i++) {
          $postArr [$i] = $preArr [$i];
        }
        $postArr = array_reverse ($postArr);
      } else {
        $postArr = $preArr;
      }

      $msgFile = implode ('<br/>', $postArr);

      $out = $msgFile.'<b style="color:red;">~'.$this ->userName.' ['.$_SESSION ['rank'].']</b>: '.$this ->message.'<br/>';

      $hand = fopen ($info, 'w');
      fwrite ($hand, $out);
      fclose ($hand);
    }
  }

  public function pfp ($dir, $pfpN) {
    extract ($this ->file);
    if (!$this ->error) {
      move_uploaded_file ($fileTN, $dir.$pfpN.'.'.$fileEXT);
    }
  }
}
