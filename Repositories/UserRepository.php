<?php
  namespace Repositories;

  require_once "__DIR__/../Config/Autoload.php";

  use Repositories\IRepository as IRepository;
  use Models\User as User;

  class UserRepository implements IRepository {
    private $userList = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__)."/Data/users.json";
    }

    public function Add($user)
    {
        $this->RetrieveData();
        
        array_push($this->userList, $user);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->userList;
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->userList as $user)
        {
            $valuesArray["email"] = $user->getEmail();
            $valuesArray["password"] = $user->getPassword();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents($this->fileName, $jsonContent);
    }

    private function RetrieveData()
    {
        $this->studentList = array();

        if(file_exists($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $user = new User();
                $user->setEmail($valuesArray["email"]);
                $user->setPassword($valuesArray["password"]);

                array_push($this->userList, $user);
            }
        }
    }
  }
?>