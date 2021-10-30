<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Admin as Admin;
use DAO\Crud as Crud;
use Exception as Exception;

class AdminDAO implements Crud{

    private $db;

    function __construct(){
        $this->db = Connection::getInstance();
    }



    public function create($admin)
    {

      try
        {
            $result = array();

        $result = $this->db->ExecuteNonQuery($this->insertBuilder($admin->getEmail(),admin->getPassword(), admin->getName()));

        
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    private function selectBuilder($id=null,$email=null,$password=null, $name=null)
    {
        $query = "SELECT * FROM Admin WHERE active=" . strval(1);

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


    function GetAll($id=null,$email=null,$password=null, $name=null){
        $result = array();
        $list=array();

        $result = $this->db->Execute($this->selectBuilder($id,$email,$password,$name));

        foreach ($result as $value) {
            array_push($list,Admin::fromArray($value));
        }

        return $list;
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
