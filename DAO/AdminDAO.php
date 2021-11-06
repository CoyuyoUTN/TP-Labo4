<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Admin as Admin;
use DAO\Crud as Crud;
use Exception as Exception;

class AdminDAO implements Crud{

    private $db;
    private $table='Admin';
    private $adminList;

    function __construct(){
        $this->db = Connection::getInstance();
    }



    public function create($admin)
    {

      try
        {
            try
            {
                $query0 = "INSERT INTO ".$this->table." ( Email, Password, Name ) VALUES ( :Email, :Password, :Name  ) ";

                
                $parameters["Email"] = $admin->getEmail();
                $parameters["Password"] = $admin->getPassword();
                $parameters["Name"] = $admin->getName();
               
            

                $this->connection = Connection::GetInstance();


                $this->connection->ExecuteNonQuery($query0, $parameters);
   
           }              
 
            catch(Exception $ex)
            {
                throw $ex;
            }

        
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    private function selectBuilder($id=null,$email=null,$password=null, $name=null)
    {
        $query = "SELECT * FROM  WHERE active=" . strval(1);

        if (isset($id) && $id != "") {
            $query = $query . " && id=" . $id;
        }
        if (isset($email) && $email != "") {
            $query = $query . ' && Email="' . $email . '"';
        }
        if (isset($password) && $password != "") {
            $query = $query . " && Password=" . $password;
        }
        if (isset($name) && $name != "") {
            $query = $query . " && Name=" . $name;
        }
        return $query;
    }
    private function insertBuilder($email,$password,$name)
    {
        $query = "INSERT INTO Admin (";
        $values = ") VALUES (";


        $query = $query . "Id, Email, Password, Name";
        $values = $values . '"' .strval($email) . ','  . strval($password) . ',' . strval($name) . ')';

        return $query.$values;
    }


    function readAll(){
        try
            {
                $adminList = array();

                $query = "SELECT * FROM ".$this->table. " WHERE active = 1 ";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $admin = new Admin();
                    $admin->setName($row["Name"]);
                    $admin->setId($row["Id"]);
                    $admin->setEmail($row["Email"]);
                    $admin->setPassword($row["Password"]);
                    $admin->setActive($row["Active"]);
                    
                    

                    array_push($adminList, $admin);
                }

                return $adminList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    function GetByEmail($email, $password){
       
        $admin = null;

        $query = 'SELECT * FROM '.$this->table.' WHERE Email = "'.$email.'" && Password = "'.$password.'"';

        $this->connection = Connection::GetInstance();

        $results = $this->connection->Execute($query);
      
        foreach($results as $row)
        {
            $admin = new Admin();
            $admin->setId($row["Id"]);
            $admin->setPassword($row["Password"]);
            $admin->setEmail($row["Email"]);
            $admin->setName($row["Name"]);
        }

        return $admin;
    }

    public function read($adminId)
    {
        try
        {
            $admin = null;

            $query = "SELECT * FROM Admin".$this->table." WHERE Id = :Id";

            $parameters["Id"] = $adminId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach ($resultSet as $row)
            {
                $admin = new Admin();
                $admin->setId($row["Id"]);
                $admin->setNombre($row["Name"]);
                $admin->setEmail($row["Email"])   ;
                $admin->setPassword($row["Password"]);
            }
                        
            return $admin;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function buscarEmail($email){


        try
                {
                    $adminList = array();
                   
                    $query = "SELECT Id, Email, Name, Password, Active FROM ".$this->table." WHERE Email like '".$email."%' ";
    
                    
                    
                    $this->connection = Connection::GetInstance();
                   
                    $resultSet = $this->connection->Execute($query);
                   
                    foreach ($resultSet as $row)
                    {
                        $admin = new Admin();
                        $admin->setId($row["Id"]);
                        $admin->setEmail($row["Email"]);
                        $admin->setName($row["Name"]);
                        $admin->setPassword($row["Password"]);
                        $admin->setActive($row["Active"]);
                      
                        array_push($adminList, $admin);
                    }
                  
                    return $adminList;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
    
        }
    
public function update($admin){

    try
        {
            $query = "UPDATE ".$this->table." SET Name = :Name, Active = :Active, Email  = :Email, Password = :Password  WHERE Id = :Id";
            
            
            $parameters["Name"] = $admin->getNombre();
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




    public function VerificarAdminExsist($email)
    {
        try
        {
            

            $query = "SELECT name FROM ".$this->table." WHERE Email like '".$email."' ";

           

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            
            return $resultSet;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }






}
