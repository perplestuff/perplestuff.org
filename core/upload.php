<?php

class filter
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

    public function __construct($param)
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
        if (strlen($param) > $this->txtLen) {
            warning('Text length to long, please shorten to '.$this->txtLen);
            $this->error = 1;
        }
    }
    public function txtCount($param)
    {
        if (count(explode($param, ' ')) > $this->txtCount) {
            warning('Text count is to big, please shorten to '.$this->txtCount);
            $this->error = 1;
        }
    }
    public function spamWord($param)
    {
        $myString = explode(' ', $param);
        foreach ($myString as $a) {
            if (in_array($a, $this->spamWord)) {
                warning('Text contains a known spam word, please exclude '.$a);
                $this->error = 1;
            }
        }
    }
    public function spamStr($param)
    {
        foreach ($this->spamStr as $a) {
            if (strpos($a, strtolower($param)) !== false) {
                warning('Text contains a known spam sentence, please exclude '.$this->spamStr);
                $this->error = 1;
            }
        }
    }
    public function ipBlock()
    {
        if (in_array($_SERVER['REMOTE_ADDR'], [$this->ipBlock])) {
            warning('Your ip has been blocked: '.$_SERVER['REMOTE_ADDR'].'. If this is a mistake please contact the administrator.');
            $this->error = 1;
        }
    }
    public function fileTypes($param)
    {
        $ext = explode('.', $param);
        $fileExt = strtolower(end($ext));
        if (!in_array($fileExt, $this->fileTypes)) {
            warning('File type is blocked: '.$fileExt.', please try a different one.');
            $this->error = 1;
        }
    }
    public function maxSize($param)
    {
        if ($param > $this->maxSize) {
            warning('File size is too big: '.$param.', please try a different one.');
            $this->error = 1;
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
class upload
{
    public $dir;
    public $conf;
    public function __construct($param)
    {
        $this->dir = $param['dir'];
        $this->conf = $param['conf'];
    }
    public function setCookie($param)
    {
        setcookie($param['cookie'], $param['info'], $param['time']);
    }
    public function fileUpload($param)
    {
        if (!move_uploaded_file($param['from'], $param['to'])) {
            warning('Upload failed, please contact the administrator.');
        }
    }
    public function dir($param)
    {
        $ext = explode('.', $param);
        return $this->dir.date("Y-m-d_H:i:s").'.'.current($ext).'.'.end($ext);
    }
}
