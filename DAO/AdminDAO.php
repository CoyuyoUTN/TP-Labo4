<?php

namespace DAO;


use DAO\Crud as Crud;
use Models\Admin as Admin;
USE FFI\Exception as Exception;
use Models\Student;

class AdminDAO implements Crud{

    private $adminList=array();
    private $fileName = ROOT."Data/admin.json";
    private $table="Admin";
	private $connection;



    public function __construct(){
        $this->connection = Connection::getInstance();
    }



    public function create($admin)
	{

        try
            {
                $query = "INSERT INTO ".$this->table." (Name) VALUES (Name), (Email) VALUES (:Email),(Password) VALUES (:Password),
                (Active) VALUES (:Active);";
                
               
                $parameters["Name"] = $admin->getFirstName();
                $parameters["Email"] = $admin->getEmail();
                $parameters["Password"] = $admin->getPassword();
                $parameters["Active"] = $admin->getActive();
               

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
	}

  
    public function readAll(){
        try
            {
                $adminList = array();

                $query = "SELECT * FROM ".$this->table;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $admin = new Admin();
                    $admin->setId($row["Id"]);
                    $admin->setNombre($row["Name"]);
                    $admin->setActive($row["Active"]);
                    $admin->setEmail($row["Email"])   ;
                    $admin->setPassword($row["Password"]);

                    array_push($adminList, $admin);
                }

                return $adminList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

       public function read($adminId)
        {
            try
            {
                $artist = null;

                $query = "SELECT * FROM ".$this->table." WHERE Id = :Id";

                $parameters["Id"] = $adminId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $admin = new Admin();
                    $admin->setId($row["Id"]);
                    $admin->setNombre($row["Name"]);
                    $admin->setEmail($row["Email"]);
                    $admin->setPassword($row["Password"]);
                    $admin->setActive($row["Active"]);
                    
                    
                
                  

                }
                            
                return $admin;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


               
   
    



        public function update ($admin){

        try
            {
                $query = "UPDATE ".$this->table." SET Name = :Name, Email = :Email, Password = :Password  WHERE Id = :Id";
                
                $parameters["Id"] = $admin->getId();
                $parameters["Name"] = $admin->getNombre();
                $parameters["Password"] = $admin->getPassword();
                $parameters["Email"] = $admin->getEmail();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

          }
    
         public function delete($adminId)
        {
            try
            {
                $query = "DELETE FROM ".$this->table." WHERE Id = :Id";
        
                $parameters["Id"] = $adminId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            }            
        }
   
   
   
   
      //// A partir de aca para abajo es con JSON, parte vieja
   
   
     function Add(Admin $admin){

        
        $this->RetrieveData();
        $admin->setId($this->GetNextId());
        array_push($this->adminList, $admin);
        $this->SaveData();


    }


    public function Edit(Admin $admin){

        
        $this->RetrieveData();
        
        array_push($this->adminList, $admin);
        $this->SaveData();


    }
    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->adminList as $admin)
        {
            $valuesArray = array();
            $valuesArray["Name"] = $admin->getName();
            $valuesArray["CUIL"] = $admin->getCuil();
            $valuesArray["id"] = $admin->getId();
            
            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }

    public function Remove($id)
    {            
        $this->RetrieveData();
        
        $this->adminadminList = array_filter($this->adminadminList, function($adminadmin) use($id){                
            return $adminadmin->getId() != $id;
        });
        
        $this->SaveData();
    }

    public function searchId($id)
    {            
        $this->RetrieveData();

        $return = array();

        for ($i=0; $i < count($this->adminadminadminList); $i++) { 
            if($this->adminadminadminList[$i]->getId() == $id){
               
                $return = $this->adminadminadminList[$i];
                
            }
        }
       
        return $return;
    }

   





    function GetAll($filter=NULL){

        $this->RetrieveData();

        if($filter != NULL){
            $ret = array_filter($this->adminList, function($admin) use($filter){
                return str_contains($admin->getName(),$filter);
            });
        }
        else{
            $ret = $this->adminList;
        }

        return $ret;
    }





  private function RetrieveData()
        {
             $this->adminList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $admin = new Admin();
                     $admin->setEmail($content["Email"]);
                     $admin->setPassword($content["Password"]);
                   
                     

                     array_push($this->adminList, $admin);
                 }
             }
        }




        private function GetNextId()
        {
            $id = 0;

            foreach($this->adminList as $admin)
            {
                $id = ($admin->getId() > $id) ? $admin->getId() : $id;
            }

            return $id + 1;
        }






}




?>