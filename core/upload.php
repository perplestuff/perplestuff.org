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
    public $dir;
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
        $this->dir = $param['dir'];
    }
    public function txtLen($param)
    {
        if (strlen($param) > $this->txtLen) {
            warning('Text length to long, please shorten to '.$this->txtLen);
            // $this->error = 1;
        }
    }
    public function txtCount($param)
    {
        if (count(explode($param, ' ')) > $this->txtCount) {
            warning('Text count is to big, please shorten to '.$this->txtCount);
            // $this->error = 1;
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
class upload extends filter
{
    //set properties
    public $conf;

    public function __construct($param)
    {
        //give properties correct values
        $this->conf = $param['conf'];
    }
    public function getLines()
    {
        // $this->conf['database']->select(
        //     ''
        // );
    }
    public function fileUpload($param)
    {
        move_uploaded_file($this->dir.date("Y-m-d H:i:s").$param);
    }

    public function messageboard($param)
    {
        $this->conf['database']->insert(
            'msg',
            [
                'message'=>$param['msg'],
                'picture'=>$param['pic'],
                'owner'=>$param['owner'],
                'options'=>$param['options']
            ]
        );
    }
}
