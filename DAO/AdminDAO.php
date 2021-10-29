<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\Admin as Admin;

class AdminDAO {

    private $db;

    function __construct(){
        $this->db = Connection::getInstance();
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