<?php
namespace Classes\Database;

class DBAL extends Database{
    
    protected $serverAddress = 'localhost';
    protected $userName = 'dev';
    protected $DBPassword = 'thepassword1';
    protected $dbName = 'latloto';
    protected $port = 3306;

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
        if ($parameters['id'] == NULL) {
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

    public function createUser ($object, array $parameters) {
        // Checks for unique username
        if (!$this->isFieldUnique($object, array('username'=>$parameters['username']))){
            $this->HandleError('Account with this username already exist');
            return false;
        }
        // Hash the password
        $salt = Database::getSalt();
        $parameters['password'] = crypt($parameters['password'],'$2y$07$'.$salt);
        // Saves to database
        try {
            $this->save($object, $parameters);
        } catch (\PDOException $e) {
            echo 'Smth else wrong: ', $e->getMessage(), "\n";
            return false;
        }
        return true;
    }


    public function CheckLoginDB($object, array $parameters){
        $result = $this->selectBy($object,['username' => $parameters['username']]);
        if ($acc = $result->fetch()){
            if (hash_equals($acc['password'], crypt($parameters['password'], $acc['password']))) {
                //Starts season
                session_unset();
                session_destroy();
                session_start();

                $_SESSION['username'] = $acc['username'];
                return true;
            }
        }
        return false;
    }

    public function login($object, array $parameters){

        // Checks username and pass in DB
        if (!$this->CheckLoginDB($object, $parameters)){
            $this->HandleError('Error logging in. The username or password does not match');
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