<?php
namespace Classes\Database;


use config\DatabaseConfig;

class Database extends \PDO {

    var $error_message;


    public function __construct(){
        $dbconfig = new DatabaseConfig;
        $dsn='mysql:dbname='.$dbconfig->getDbName().';host='.$dbconfig->getServerAddress();
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        parent::__construct($dsn,$dbconfig->getUserName(),$dbconfig->getDBPassword(),$opt);
    }

    protected function buildSelectAll(\Classes\Entity\Entity $object){
        return 'SELECT * FROM '.$object->tableName;
    }

    protected function buildDeleteBy($object, array $parameters){
        $sql = 'DELETE FROM '.$object->tableName.' WHERE ';
        $i = 0;
        $values = array();
        foreach($parameters as $key=>$value){
            if($i === 0){
                $sql .= $key." = ?";
            } else {
                $sql .= ' AND ';
                $sql .= $key." = ?";
            }
            array_push($values, $value);
            $i++;
        }
        echo $sql.'<br />';
        print_r($values);
        $stmt = $this->prepare($sql);
        $stmt->execute($values);
        return $stmt;
    }


    protected function buildEditById(\Classes\Entity\Entity $object, $id, array $parameters){
        $sql = "UPDATE $object->tableName SET ";
        $values = array();
        foreach ($parameters as $key=>$value){
            $sql .= $key." = ?, ";
            array_push($values, $value);
        }
        $sql = rtrim($sql,", ");
        $sql .= ' WHERE id = ?';
        array_push($values, $id);
        $stmt = $this->prepare($sql);
        $stmt->execute($values);
        return $stmt;
    }

    protected function buildInsert(\Classes\Entity\Entity $object, array $parameters){
        $sql = "INSERT INTO $object->tableName (";
        $values = array();
        foreach ($parameters as $key=>$value){
            $sql .= $key.",";
            array_push($values, $value);
        }
        $sql = rtrim($sql,",");
        $sql .= ') VALUES (';
        foreach ($parameters as $key=>$value){
            $sql .= "?,";
        }
        $sql = rtrim($sql,",");
        $sql .= ')';
        $stmt = $this->prepare($sql);
        $stmt->execute($values);
        return $stmt;
    }

    protected function buildSelectBy(\Classes\Entity\Entity $object,array $parameters){
        $sql = $this->buildSelectAll($object);
        $i = 0;
        $values = array();
        foreach($parameters as $key=>$value){
            if($i === 0){
                $sql .= ' WHERE ';
                $sql .= $key." = ?";
            } else {
                $sql .= ' AND ';
                $sql .= $key." = ?";
            }
            $i++;
            array_push($values, $value);
        }
        $stmt = $this->prepare($sql);
        $stmt->execute($values);
        return $stmt;
    }

    public static function getSalt($bytes = 11){
        $bytes = random_bytes($bytes);
        return bin2hex($bytes);
    }

    protected function HandleError($error){
        $this->error_message = $error;
    }

}
?>
