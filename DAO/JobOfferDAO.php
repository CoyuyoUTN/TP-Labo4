<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\JobOffer as JobOffer;

use DAO\JobPositionDAO as JobPositionDAO;
use Models\JobPosition;

class JobOfferDAO
{
    private $db;
    private $jobPositionDao;

    function __construct()
    {
        $this->db = Connection::getInstance();
        $this->jobPositionDao = JobPositionDAO::getInstance();
    }

    function GetAll($id = null, $description = null, $company = null, $position = null)
    {
        $result = array();
        $list = array();
        $positionId = null;

        if($position != null){
            $positionId = $this->jobPositionDao->searchByDescription($position);
        }

        $result = $this->db->Execute($this->selectBuilder($id, $description, $company, $positionId));

        foreach ($result as $value) {
            array_push($list, JobOffer::fromArray($value));
        }

        return $list;
    }

    private function selectBuilder($id = null, $description = null, $company = null, $position = null)
    {
        $query = "SELECT * FROM JobsOffer WHERE active=" . strval(1);

        if (isset($id) && $id != "") {
            if(is_array($id)){
                $query = $query . " && ";
                foreach ($id as $option){
                    $query = $query . "id=" . $option ." OR ";
                }
                $query = substr($query, 0, -4);
            }
            else{
                $query = $query . " && id=" . $id;
            }
        }
        if (isset($description) && $description != "") {
            if(is_array($description)){
                $query = $query . " && ";
                foreach ($description as $option){
                    $query = $query . "Description=" . $option ." OR ";
                }
                $query = substr($query, 0, -4);
            }
            else{
                $query = $query . ' && Description="' . $description . '"';
            }
        }
        if (isset($company) && $company != "") {
            if(is_array($company)){
                $query = $query . " && ";
                foreach ($company as $option){
                    $query = $query . "CompanyId=" . $option ." OR ";
                }
                $query = substr($query, 0, -4);
            }
            else{
                $query = $query . " && CompanyId=" . $company;
            }
        }
        if (isset($position) && $position != "") {
            if(is_array($position)){
                $query = $query . " && ";
                foreach ($position as $option){
                    $query = $query . "JobPositionId=" . $option->getJobPositionId() ." OR ";
                }
                $query = substr($query, 0, -4);
            }
            else{
                $query = $query . " && JobPositionId=" . $position->getCareerId();
            }
        }
        return $query;
    }

    private function insertBuilder($description, $company, $position)
    {
        $query = "INSERT INTO JobsOffer (";
        $values = ") VALUES (";


        $query = $query . "Description,CompanyId,JobPositionId";
        $values = $values . '"' . $description . '",' . strval($company) . ',' . strval($position) . ')';

        return $query.$values;
    }

    private function updateBuilder($id, $description=NULL, $company=NULL, $position=NULL)
    {
        $query = "UPDATE JobsOffer SET ";
        $set = array();
        $first = true;

        if (isset($description) && $description != "") {
            array_push($set,'Description="' . $description . '"');
        }
        if (isset($company) && $company != "") {
            array_push($set,"CompanyId=" . $company);
        }
        if (isset($position) && $position != "") {
            $possible = JobPositionDAO::getInstance()->searchByDescription($position);
            foreach ($possible as $posibility) {
                array_push($set,"JobPositionId=" . $posibility->getCareerId());
            }
        }

        foreach ($set as $data) {
            if(!$first){
                $query = $query.',';
            }
            else{
                $first = false;
            }

            $query = $query.$data;
        }

        $query = $query.'WHERE id='.$id;

        return $query;
    }

    function GetById($id)
    {
        $result = $this->db->Execute('SELECT * FROM JobsOffer WHERE id=' . $id . " && active=1");
        $list = array();

        foreach ($result as $value) {
            array_push($list, JobOffer::fromArray($value));
        }

        return $list;
    }

    function Add(string $description, int $company, int $position)
    {
        $result = $this->db->Execute($this->insertBuilder($description, $company, $position));
    }


    function jobOfferByCareerId(){
       
        $jobPositionList = new JobPosition();
         
        $jobPositionList = $this->JobPositionDAO->getByCareerId();
        $newList = array();
         
        foreach($jobPositionList as $position){
          
             
            $result = $this->db->Execute('SELECT * FROM JobsOffer WHERE JobPositionId = ' . $position[" JobPositionId"] . " && active=1");
           
           
           
            array_push($newList, $result);  
             



        }
            //recorrer la lista de jobposition
                 // query a base de dato devolver lista por jobpositionID, devuelve lista 
                 //  recorrer la lista, nuevo dao con joboffer mas jobpositionList, guardar conjunto de datos
                        //nuevo bojeto cada vez que la recorra los datos, nueva lista del nuevo dao      
     









    }
    

}
