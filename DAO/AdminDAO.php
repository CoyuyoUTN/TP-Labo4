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