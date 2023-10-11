<?php

require_once 'app/Libs/db/MysqliDb.php';

class Connect{
    protected $connection;

    public function connect(){
        $mysqli = new MysqliDb (HOST, USERNAME, PASSWORD, DBNAME);

        if(!$mysqli->connect()){
            $this->connection=$mysqli;

            return $this->connection;
        }else{
            echo "can't found this database";
        }
    }
}