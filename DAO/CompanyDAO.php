<?php

namespace DAO;


use Models\Company as Company;
USE FFI\Exception as Exception;
use DAO\Crud;

class CompanyDAO implements Crud{

    private $companyList=array();
    private $fileName = ROOT."Data/company.json";
    private $table="Company";
	private $connection;
    private $db;



    public function __construct()
	{
        $this->connection = Connection::getInstance();	
	}
	

    private function insertBuilder($company)
    {
        $query = "INSERT INTO Company (";
        $values = ") VALUES (";


        $query = $query . "name, cuil, img, shortDesc, ranking, email, phone, city, address, jobOffers, bio, linkedIn, webpage, facebook";
        $values = $values . '"' .strval($company->getName()) . ','  . strval($company->getCuil()) . ',' . strval($company->getImg()) . ',' . strval($company->getShortDesc()) . ',' . strval($company->getRanking()) . ',' . strval($company->getEmail()) . ',' . strval($company->getPhone()) . ',' . strval($company->getCity()) . ',' . strval($company->getAddress()) . ',' . strval($company->getJobOffers()) . ',' . strval($company->getBio()) . ',' . strval($company->getLinkedIn()) . ',' . strval($company->getWebpage()) . ',' . strval($company->getFacebook()) . ')';

        return $query.$values;
    }
    
    public function create ($company)
	{
       
       /* try
        {
            $result = array();

        $result = $this->db->ExecuteNonQuery($this->insertBuilder($company));

        
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
*/
      try
            {
                $query0 = "INSERT INTO".$this->table." (name, cuil, img, shortDesc, ranking, email, phone, city, address, jobOffers, bio, linkedIn, webpage, facebook) VALUES (:name, :cuil, :img, :shortDesc, :ranking, :email, :phone, :city, :address, :jobOffers, :bio, :linkedIn, :webpage, :facebook) ";

                
                $parameters["name"] = $company->getName();
                $parameters["cuil"] = $company->getCuil();
                $parameters["img"] = $company->getImg();
                $parameters["shortDesc"] = $company->getShortDesc();
                $parameters["ranking"] = $company->getRanking();
                $parameters["email"] = $company->getEmail();
                $parameters["phone"] = $company->getPhone();
                $parameters["city"] = $company->getCity();
                $parameters["address"] = $company->getAddress();
                $parameters["jobOffers"] = $company->getJobOffers();
                $parameters["bio"] = $company->getBio();
                $parameters["linkedin"] = $company->getLinkedin();
                $parameters["webpage"] = $company->getWebpage();
                $parameters["facebook"] =$company->getFacebook();
             
              


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
                $companyList = array();

                $query = "SELECT * FROM ".$this->table. " WHERE active = 1 ";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setName($row["name"]);
                    $company->setCuil($row["cuil"]);
                    $company->setId($row["id"]);
                    $company->setImg($row["img"]);
                    $company->setShortDesc($row["shortDesc"]);
                    $company->setRanking($row["ranking"]);
                    $company->setEmail($row["email"]);
                    $company->setPhone($row["phone"]);
                    $company->setCity($row["city"]);
                    $company->setAddress($row["address"]);
                    $company->setJobOffers($row["jobOffers"]);
                    $company->setBio($row["bio"]);
                    $company->setLinkedin($row["linkedin"]);
                    $company->setWebpage($row["webpage"]);
                    $company->setFacebook($row["facebook"]);
                    $company->setActive($row["active"]);
                    
                    

                    array_push($companyList, $company);
                }

                return $companyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function read($companyId)
        {
            try
            {
                $company = null;

                $query = "SELECT * FROM ".$this->table." WHERE id = :id";

                $parameters["id"] = $companyId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $company = new Company();
                    $company->setName($row["name"]);
                    $company->setCuil($row["cuil"]);
                    $company->setId($row["id"]);
                    $company->setImg($row[" img"]);
                    $company->setShortDesc($row["shortDesc"]);
                    $company->setRanking($row["ranking"]);
                    $company->setEmail($row["email"]);
                    $company->setPhone($row["phone"]);
                    $company->setCity($row["city"]);
                    $company->setAddress($row["address"]);
                    $company->setJobOffers($row["jobOffers"]);
                    $company->setBio($row["bio"]);
                    $company->setLinkedin($row["linkedin"]);
                    $company->setWebpage($row["webpage"]);
                    $company->setFacebook($row["facebook"]);
                    $company->setActive($row["active"]);
                }
                            
                return $company;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
   
   
        public function update ($company){

        try
            {
                $query = "UPDATE ".$this->table." SET name = :name, cuil = :cuil, img = :img, shortDesc = :shortDesc,
                          ranking = :ranking, email = email, phone = :phone,  city = :city, address = :address, jobOffers = :jobOffers,
                          bio = :bio, linkedin = :linkedin, webpage = :webpage, facebook = :facebook, active = :active WHERE Id = :Id";



                $parameters["id"] = $company->getId(); 
                $parameters["name"] = $company->getName();
                $parameters["cuil"] =$company->getCuil();
                $parameters["img"] =$company->getImg();
                $parameters["shortDesc"] = $company->getShortDesc();
                $parameters["ranking"] = $company->getRanking();
                $parameters["email"] = $company->getEmail();
                $parameters["phone"] =$company->getPhone();
                $parameters["city"] =$company->getCity();
                $parameters["address"] = $company->getAddress();
                $parameters["jobOffers"] =$company->getJobOffers();
                $parameters["bio"] = $company->getBio();
                $parameters["linkedin"] = $company->getLinkedin();
                $parameters["webpage"] = $company->getWebpage();
                $parameters["facebook"] =$company->getFacebook();
                $parameters["active"] = $company->getActive();
                
             
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

    }
    
     public function delete($id)
        {
            try
            {
                $query = "UPDATE ".$this->table." SET active = 0 WHERE id = :id";
            
                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            }            
        }
   
   




       function Add(Company $company){

        
        $this->RetrieveData();
        $company->setId($this->GetNextId());
        array_push($this->companyList, $company);
        $this->SaveData();


         }


    public function Edit(Company $company){

        
        $this->RetrieveData();
        
        array_push($this->companyList, $company);
        $this->SaveData();


    }
    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->companyList as $company)
        {
            $valuesArray = array();
            $valuesArray["Name"] = $company->getName();
            $valuesArray["CUIL"] = $company->getCuil();
            $valuesArray["id"] = $company->getId();
            
            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }

    public function Remove($id)
    {            
        $this->RetrieveData();
        
        $this->companyList = array_filter($this->companyList, function($company) use($id){                
            return $company->getId() != $id;
        });
        
        $this->SaveData();
    }

    public function searchId($id)
    {            
        $this->RetrieveData();

        $return = array();

        for ($i=0; $i < count($this->companyList); $i++) { 
            if($this->companyList[$i]->getId() == $id){
               
                $return = $this->companyList[$i];
                
            }
        }
       
        return $return;
    }

   
    public function ifExistsData($name,$cuil){

       
        $answer=false;
    
        for ($i=0; $i < count($this->companyList); $i++) { 
            if($this->companyList[$i]->getName() == $name  ){
               
                $answer=true;
                
            }
            if($this->companyList[$i]->getCuil() == $cuil ){
               
                $answer=true;
                
            }
        
        }
        return $answer;
    }




    function GetAll($filter=NULL){

        $this->RetrieveData();

        if($filter != NULL){
            $ret = array_filter($this->companyList, function($company) use($filter){
                return str_contains($company->getName(),$filter);
            });
        }
        else{
            $ret = $this->companyList;
        }

        return $ret;
    }





  private function RetrieveData()
        {
             $this->companyList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                    $company = Company::fromJson($content);

                     array_push($this->companyList, $company);
                 }
             }
        }




        private function GetNextId()
        {
            $id = 0;

            foreach($this->companyList as $company)
            {
                $id = ($company->getId() > $id) ? $company->getId() : $id;
            }

            return $id + 1;
        }






}




?>