<?php

class upload
{
    //set properties
    private $userName;
    private $message;
    public $file;
    public $dir;
    public $info;

    public function __construct($param)
    {
        //give properties correct values
        $this->userName = htmlspecialchars($param['userName']);
        $this->message = htmlspecialchars($param['message']);
        $this->file = $param['file'];
    }
    public function fileUpload($param)
    {
        //upload process
        if (!$this->filter->error) {
            move_uploaded_file($this->file['tmp_name'], $this->dir.$this->userName.$this->file['name']);

            $hand = fopen($this->info, 'r');
            $fileInfo = fread($hand, filesize($info));
            fclose($hand);

            $preArr = explode('~', $fileInfo);
            if (count($preArr) > $maxLines) {
                for ($i = 0; $i < $maxLines; $i++) {
                    $postArr[$i] = $preArr[$i];
                }
            } else {
                $postArr = $preArr;
            }
            $fileInfo = implode("~", $postArr);

            $out = "~<b style='color:green;'>".$this->userName.' ['.$_SESSION['rank']."] : </b>
            <p>".$caption."</p>
            <img src='".$dir.$caption."'>
            <br/><br/>"
            .$fileInfo;
            file_put_contents($info, $out);
        } else {
            warning('File not sent, please try again.');
        }
    }

    public function messageboard($ipBlock, $spamWords, $spamStr, $maxLines, $maxSamestr, $info)
    {
        $hand = fopen($info, 'r');
        $msgFile = fread($hand, filesize($info));
        fclose($hand);

        if (substr_count($msgFile, $this->message) > $maxSamestr) {
            warning('Spam detected, message has already been sent '.$maxSamestr.' times, please try again.');
            $this->error = 1;
        }

        if (!$this->error) {
            $preArr = explode('<br/>', $msgFile);

            if (count($preArr) > $maxLines) {
                $preArr = array_reverse($preArr);
                for ($i=0; $i < $maxLines; $i++) {
                    $postArr[$i] = $preArr[$i];
                }
                $postArr = array_reverse($postArr);
            } else {
                $postArr = $preArr;
            }

            $msgFile = implode('<br/>', $postArr);

            $out = $msgFile.'<b style="color:red;">~'.$this->userName.' ['.$_SESSION['rank'].']</b>: '.$this->message.'<br/>';

            $hand = fopen($info, 'w');
            fwrite($hand, $out);
            fclose($hand);
        }
    }
}

class filter extends upload
{
    public $txtLen;
    public $txtCount;
    public $spamWord;
    public $spamStr;
    public $ipBlock;
    public $fileTypes;
    public $maxSize;
    public $fileExists;
    public $error = 0;

    public function __contruct($param)
    {
        $this->txtLen = $param['txtLen'];
        $this->txtCount = $param['txtCount'];
        $this->spamWord = $param['spamWord'];
        $this->spamStr = $param['spamStr'];
        $this->ipBlock = $param['ipBlock'];
        $this->fileTypes = $param['fileTypes'];
        $this->maxSize = $param['maxSize'];
    }
    public function txtLen($param)
    {
        if ($param > $this->txtLen) {
            warning('Text length to long, please shorten to '.$this->txtLen);
            $this->error = 1;
        }
    }
    public function txtCount($param)
    {
        if ($param > $this->txtCount) {
            warning('Text count is to big, please shorten to '.$this->txtCount);
            $this->error = 1;
        }
    }
    public function spamWord($param)
    {
        foreach ($param as $a) {
            if (strpos($this->spamStr, strtolower($a))) {
                warning('Text contains a known spam word, please exclude '.$a);
                $this->error = 1;
            }
        }
    }
    public function spamStr($param)
    {
        foreach ($param as $a) {
            if ($this->spamStr == strtolower($a)) {
                warning('Text contains a known spam sentence, please exclude '.$a);
                $this->error = 1;
            }
        }
    }
    public function ipBlock($param)
    {
        foreach ($param as $a) {
            if ($_SERVER['REMOTE_ADDR'] == $a) {
                warning('Your ip has been blocked: '.$_SERVER['REMOTE_ADDR'].'. If this is a mistake please contact the administrator.');
                $this->error = 1;
            }
        }
    }
    public function fileType($param)
    {
        foreach ($param as $a) {
            $ext = explode('.', $a);
            $fileExt = strtolower(end($ext));
            if ($this->fileTypes !== $fileExt) {
                warning('File type is plocked: '.$fileExt.', please try a different one.');
                $this->error = 1;
            }
        }
    }
    public function maxSize($param)
    {
        foreach ($param as $a) {
            if ($a > $this->maxsize) {
                warning('File size is too big: '.$a.', please try a different one.');
                $this->error = 1;
            }
        }
    }
    public function alreadyExists($param)
    {
        foreach ($param as $a) {
            if (file_exists($a)) {
                warning('File has already been uploaded, please try a different one.');
                $this->error = 1;
            }
        }
    }
}
