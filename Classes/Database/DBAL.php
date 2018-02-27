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

    /**
     * @return string
     */
    public function getServerAddress()
    {
        return $this->serverAddress;
    }

    /**
     * @param string $serverAddress
     */
    public function setServerAddress($serverAddress)
    {
        $this->serverAddress = $serverAddress;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getDBPassword()
    {
        return $this->DBPassword;
    }

    /**
     * @param string $DBPassword
     */
    public function setDBPassword($DBPassword)
    {
        $this->DBPassword = $DBPassword;
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * @param string $dbName
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    
    
}

?>