<?php

class user
{ //controls the user account
    public $conf;
    public $error = 0;

    public function __construct($conf)
    {
        $this->conf = $conf;
    }
    public static function compare($param)
    {
        $info = $this->conf['database']->select(
            $param['info'],
            $param['table'],
            $param['column'],
            $param['value']
        );
        foreach ($info as $a) {
            if ($a == $param['compare']) {return true;} else {return false;}
        }
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
