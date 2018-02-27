<?php
namespace Classes\Database;

class DBAL extends Database{
    
    public function __construct(){
        parent::__construct();
    }

    public function selectById(\Classes\Entity\Entity $object,$id)  {
        return $this->selectBy($object,['id'=>$id]);
    }

    public function selectAll(\Classes\Entity\Entity $object)  {
        $stmt = $this->query($this->buildSelectAll($object));
        return $stmt;
    }

    public function selectBy(\Classes\Entity\Entity $object,array $parameters)  {
        return $this->buildSelectBy($object,$parameters);
    }

    public function deleteById(\Classes\Entity\Entity $object, $id)  {
        return $this->buildDeleteBy($object,array('id' => $id));
    }

    public function deleteBy(\Classes\Entity\Entity $object, array $parameters){
        return $this->buildDeleteBy($object,$parameters);
    }

    public function save(\Classes\Entity\Entity $object, array $parameters)
    {
        if (empty($parameters['id'])) {
            return $this->buildInsert($object, $parameters);
        }
        return $this->buildEditById($object, $parameters['id'], $parameters);
    }

    public function isFieldUnique ($object, array $parameters) {
        $stmt = $this->selectBy($object,$parameters);
        if ($stmt->fetch()){
            return false;
        }
        return true;
    }

    public function getLastInsertId(){
        return $this->lastInsertId();
    }
    
}

?>