<?php

namespace DAO;

use Exception as Exception;
use DAO\Connection as Connection;
use Models\JobOffer as JobOffer;

use DAO\JobPositionDAO as JobPositionDAO;
use Models\JobPosition;

class JobOfferDAO
{
    private $db;

    function __construct()
    {
        $this->db = Connection::getInstance();
    }

    function GetAll($id = null, $description = null, $company = null, $position = null)
    {
        $result = array();
        $list = array();

        $result = $this->db->Execute($this->selectBuilder($id, $description, $company, $position));

        foreach ($result as $value) {
            array_push($list, JobOffer::fromArray($value));
        }

        return $list;
    }

    private function selectBuilder($id = null, $description = null, $company = null, $position = null)
    {
        $query = "SELECT * FROM JobsOffer WHERE active=" . strval(1);

        if (isset($id) && $id != "") {
            $query = $query . " && id=" . $id;
        }
        if (isset($description) && $description != "") {
            $query = $query . ' && Description="' . $description . '"';
        }
        if (isset($company) && $company != "") {
            $query = $query . " && CompanyId=" . $company;
        }
        if (isset($position) && $position != "") {
            $possible = JobPositionDAO::getInstance()->searchByDescription($position);
            foreach ($possible as $posibility) {
                $query = $query . " && JobPositionId=" . $posibility->getCareerId();
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


  /*public function jobOfferByCareerId(){
       
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
     

    }*/
    


    public function getJobOfferByPositionId($listJobsPosition){

        try{
       //select a.id ,a.Description from JobsOffer a where jobPositionId = 8 order by a.id;
         $newList = array();
         
         foreach($listJobsPosition as $position){

            $query='SELECT * FROM JobsOffer WHERE JobPositionId  = ' . $position->getJobPositionId() . " && active=1";
            $result = $this->db->Execute($query);

            foreach($result as $row){
          
                $jobsOffer= new JobOffer();
                $jobsOffer->setId($row['id']);
                $jobsOffer->setDescription($row['Description']);
                $jobsOffer->setCompanyId($row['CompanyId']);
                $jobsOffer->setJobPositionId($row['JobPositionId']);
                
                
                array_push($newList, $jobsOffer);  
    
    
            }



        }

        return $newList;
    }
         catch(Exception $ex)
    {
        throw $ex;
    }

    }




   

}
