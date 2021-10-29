<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\JobOffer as JobOffer;

use DAO\JobPositionDAO as JobPositionDAO;


class JobOfferDAO
{
    private $db;

    function __construct(){
        $this->db = Connection::getInstance();
    }

    function GetAll($id=null,$description=null,$company=null,$position=null){
        $result = array();
        $list=array();

        $result = $this->db->Execute($this->queryBuilder($id,$description,$company,$position));

        foreach ($result as $value) {
            array_push($list,JobOffer::fromArray($value));
        }

        return $list;
    }

    function queryBuilder($id=null,$description=null,$company=null,$position=null){
        $query = "SELECT * FROM JobsOffer WHERE active=".strval(1);

        if(isset($id) && $id != ""){
            $query = $query." && id=".$id;
        }
        if(isset($description) && $description != ""){
            $query = $query.' && Description="'.$description.'"';
        }
        if(isset($company) && $company != ""){
            $query = $query." && CompanyId=".$company;
        }
        if(isset($position) && $position != ""){
            $possible = JobPositionDAO::getInstance()->searchByDescription($position);
            foreach($possible as $posibility){
                $query = $query." && JobPositionId=".$posibility->getCareerId();
            }
        }

        return $query;
    }

    function GetById($id){
        $result = $this->db->Execute('SELECT * FROM JobsOffer WHERE id='.$id." && active=1");
        $list=array();

        foreach ($result as $value) {
            array_push($list,JobOffer::fromArray($value));
        }

        return $list;
    }
}
