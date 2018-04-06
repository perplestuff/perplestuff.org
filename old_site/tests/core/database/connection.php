<?php

class connection {
    public static function make ($config) {
        try {
            return new PDO (
                $config ['connection'] . ';dbname=' . $config ['name'],
                $config ['username'],
                $config ['password'],
                $config ['options']
            );
        } catch (PDOException $e) {
            die ($e->getMessage());
        }
    }
}

//$connection = new connection ();
//$connection->make ();
//connection::make ();