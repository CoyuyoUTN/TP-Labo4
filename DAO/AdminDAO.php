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

//************************************************************************************** */


    public function create($admin)
    {

      try
        {
            $query = "INSERT INTO ".$this->table." (Name) VALUES (Name), (Email) VALUES (:Email),(Password) VALUES (:Password),
            (Active) VALUES (:Active);";//DUDA, el ID es autoincrement
                                                                        //como le solicito el insert ??
            
            
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
            $admin = null;

            $query = "SELECT * FROM ".$this->table." WHERE Id = :Id";

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



//---------------------------------------------------------------------------//











    function GetAll($id=null,$email=null,$password=null, $name=null){
        $result = array();
        $list=array();

        $result = $this->db->Execute($this->queryBuilder($id,$email,$password,$name));

        foreach ($result as $value) {
            array_push($list,Admin::fromArray($value));
        }

        return $list;
    }

    function queryBuilder($id=null,$email=null,$password=null, $name=null){
        $query = "SELECT * FROM Admin WHERE active=".strval(1);

        if(isset($id) && $id != ""){
            $query = $query." && id=".$id;
        }
        if(isset($email) && $email != ""){
            $query = $query.' && Email="'.$email.'"';
        }
        if(isset($password) && $password != ""){
            $query = $query." && Password=".$password;
        }
        if(isset($name) && $name != ""){
            $query = $query." && Name=".$name;
        }
    

        return $query;
    }

    function GetById($id){
        $result = $this->db->Execute('SELECT * FROM Admin WHERE id='.$id." && active=1");
        $list=array();

        foreach ($result as $value) {
            array_push($list,Admin::fromArray($value));
        }

        return $list;
    }









}




?>