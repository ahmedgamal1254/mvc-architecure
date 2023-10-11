<?php 

class Model extends Connect{
    protected $table; // Product ==> products etc....

    private $conn;

    public function __construct(){
        $this->table = strtolower(static::class) . "s";

        $this->conn=$this->connect();
    }

    public static function all(){
        $class=new static();
        $result=$class->conn->get($class->table);

        return $result;
    }

    public static function find(){
        $class=new static();
        // $result=$class->conn->get
    }
}