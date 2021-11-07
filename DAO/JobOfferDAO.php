<?php

namespace DAO;

use Exception as Exception;
use DAO\Connection as Connection;
use Models\JobOffer as JobOffer;

use DAO\JobPositionDAO as JobPositionDAO;
use Models\JobPosition as JobPosition;

class JobOfferDAO
{
    private $db;
    private $jobPositionDao;
    private $table = 'JobsOffer';

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

    function GetByJobPosition($studentCareerId)
    {
        $result = $this->db->Execute('SELECT * FROM JobsOffer WHERE jobPositionId =' . $studentCareerId . " && active=1");
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

    public function buscarDescription($description){


        try
                {
                    $offersList = array();
                    
                    $query = "SELECT id, Description, JobPositionId, CompanyId  FROM ".$this->table." WHERE Description like '".$description."%' ";
    
                    
                    
                    $this->connection = Connection::GetInstance();
                   
                    $resultSet = $this->connection->Execute($query);
                   
                    foreach ($resultSet as $row)
                    {
                        $offer = new JobOffer();
                        $offer->setId($row["id"]);
                        $offer->setDescription($row["Description"]);
                        $offer->setJobPositionId($row["JobPositionId"]);
                        $offer->setCompanyId($row["CompanyId"]);
                        array_push($offersList, $offer);
                    }
                  
                    return $offersList;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
    
        }
    
        

        

        public function verificarPostulacionExists($studentId, $jobOfferId){

            try{
                $resultSet=null;
                $query0 = "SELECT StudentId FROM  Student_x_JobOffer WHERE JobOfferId like :JobOfferId ";
    
                    
                    
                    $parameters["JobOfferId"] = intval($jobOfferId);
    
                    $this->connection = Connection::GetInstance();
    
    
                    $resultSet= $this->connection->ExecuteNonQuery($query0, $parameters);
       
                        return   $resultSet;
            }
                catch(Exception $ex)
                {
                    throw $ex;
                }



        }





        public function postularse ($studentId, $jobOfferId){

          
            
        try{
            $query0 = "INSERT INTO Student_x_JobOffer ( StudentId, JobOfferId ) VALUES ( :StudentId, :JobOfferId ) ";

                
                $parameters["StudentId"] = intval($studentId);
                $parameters["JobOfferId"] = intval($jobOfferId);

                $this->connection = Connection::GetInstance();


                $this->connection->ExecuteNonQuery($query0, $parameters);
   
                       
        }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }



        public function readAll(){
            try
                {
                    $offersList = array();
    
                    $query = "SELECT * FROM ".$this->table. " WHERE active = 1 ";
    
                    $this->connection = Connection::GetInstance();
    
                    $resultSet = $this->connection->Execute($query);
                    
                    foreach ($resultSet as $row)
                    {                
                        $offer = new jobOffer();
                        $offer->setId($row["id"]);
                        $offer->setDescription($row["Description"]);
                        $offer->setJobPositionId($row["JobPositionId"]);
                        $offer->setCompanyId($row["CompanyId"]);
                       
                        
                        
    
                        array_push($offersList, $offer);
                    }
    
                    return $offersList;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
        }





        
    public function misPostulaciones($Id){

        
        $jobOffer = null;
        $idList=array();

        $query = "SELECT JobOfferId from Student_x_JobOffer WHERE StudentId = " .$Id. " ";
        
        $this->connection = Connection::GetInstance();
        
        $results = $this->connection->Execute($query);
        
        foreach($results as $row)
        {
            $jobOffer = new JobOffer();
            $jobOffer->setId($row["JobOfferId"]);
            

            array_push($idList, $jobOffer); // devuelve una lista unicametne con los apiId
           
        }

        return $idList;

    }




    public function getDescrptionPostulaciones ($idList){

       
        $postList=array();

        for($i=0; $i < count($idList); $i++){
           
            $query = "SELECT id, Description from " .$this->table. " WHERE id = " .$idList[$i]->getId(). " ";   

            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query);
            
            foreach($results as $row)
            {
                $jobOffer = new JobOffer();
                $jobOffer->setId($row["id"]);
                $jobOffer->setDescription($row["Description"]);
    
                array_push($postList, $jobOffer); // devuelve una lista unicametne con los apiId
               
            }
        }
        return $postList;
    }



    public function read($jobOfferId)
    {
        try
        {
            $JobOffer = null;

            $query = "SELECT * FROM ".$this->table." WHERE id = " .$jobOfferId. " ";

           

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {
                $JobOffer = new JobOffer();
                $JobOffer->setId($row["id"]);
                $JobOffer->setDescription($row["Description"]);
                $JobOffer->setCompanyId($row["CompanyId"]);
                $JobOffer->setJobPositionId($row["JobPositionId"]);
                $JobOffer->setJobPosition($row["active"]);
              
            }
                        
            return $JobOffer;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
   


 
    public function update ($jobOffer){

        try
            {
                $query = "UPDATE ".$this->table." SET Description = :Description, CompanyId = :CompanyId, JobPositionId = :JobPositionId, active = :active  WHERE ( id = :id ) ";

                 $parameters["id"] = $jobOffer->getId(); 
                $parameters["Description"] = $jobOffer->getDescription();
                $parameters["CompanyId"] =$jobOffer->getCompanyId();
                $parameters["JobPositionId"] =$jobOffer->getJobPositionId();
                $parameters["active"] = $jobOffer->getActive();
             
             
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

    }














}
