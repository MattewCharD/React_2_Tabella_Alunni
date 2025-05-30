<?php

class Db extends MySQLi{
    static protected $instance = null;

    public function _construct($host, $user, $password, $schema){
        parent::_construct($host, $user, $password, $schema);
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new Db('my_mariadb', 'root', 'ciccio', 'scuola');
        }
        return self::$instance;
    }

    public function select($table, $where = 1){
        $query = "SELECT * FROM $table WHERE $where";
        if($result = $this->query($query)){
            return $result-> fetch_all(MYSQLI_ASSOC);
        }
        return[];
    }
}

?>