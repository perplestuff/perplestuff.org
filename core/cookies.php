<?php

class cookies
{
    public $conf;
    public $error = 0;

    public function __construct($param)
    {
        $this->conf = $param['conf'];
    }
    public function destroyCookie($param)
    {
        if (setcookie($param['cookie'], $param['info'], time() + 86400 * 30)) {
            $userInfo = $this->conf['database']->update(
                $param['table'],
                $param['column'],
                $param['info'],
                $param['value1'],
                $param['value2']
            );
        } else {
            $this->error = 1;
        }
    }
    public function spamCookie()
    {
        if ($postIdle > 0) {
            $lastIdle = $_COOKIE['idleTime'];
            setcookie('idleTime', time());
            if ($lastIdle) {
                $idleDifference = time() - $lastIdle;
                if ($idleDifference <= $postIdle) {
                    warning('Spam detected, please wait '.$postIdle.' seconds.');
                    $this->error = 1;
                }
            }
        }
    }
}
