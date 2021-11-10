<?php

namespace DAO;


use Models\Company as Company;
USE FFI\Exception as Exception;
use DAO\Crud;

class CompanyDAO implements Crud{

    private $companyList=array();
    private $table="Company";
	private $connection;
    private $db;



    public function __construct()
	{
        $this->connection = Connection::getInstance();	
	}
	

    
    
    public function create ($company)
	{
       
 

      try
            {
                $query0 = "INSERT INTO ".$this->table." ( name, cuil, img, shortDesc, ranking, email, phone, city, address, jobOffers, bio, linkedin, webpage, facebook ) VALUES ( :name, :cuil, :img, :shortDesc, :ranking, :email, :phone, :city, :address, :jobOffers, :bio, :linkedin, :webpage, :facebook ) ";

                
                $parameters["name"] = $company->getName();
                $parameters["cuil"] = $company->getCuil();
                if($company->getImg()==null){
                    $parameters["img"]=null;
                }
                else{
                 $parameters["img"] = $company->getImg();
                }

                if($company->getShortDesc()==null){
                 $parameters["shortDesc"] = null;
                }
                else{
                 $parameters["shortDesc"] = $company->getShortDesc();
                }

                if($company->getRanking()==null){
                $parameters["ranking"] = null;
                }
                else{
                    $parameters["ranking"] = $company->getRanking();
                }
                if($company->getEmail()==null){
                $parameters["email"] = null;
                 }
                else{
                    $parameters["email"] = $company->getEmail();
                }
                if($company->getPhone()==null){
                $parameters["phone"] = null;
                }
                else{
                    $parameters["phone"] = $company->getPhone();
                }

                if($company->getCity()==null){
                $parameters["city"] = null;
                }
                else{
                    $parameters["city"] = $company->getCity();
                }

                if($company->getAddress()==null){
                $parameters["address"] = null;
                }
                else{
                    $parameters["address"] = $company->getAddress();
                }

                if($company->getJobOffers()==null){
                $parameters["jobOffers"] = null;
                }
                else{
                    $parameters["jobOffers"] = $company->getJobOffers();
                }

                if($company->getBio()==null){
                $parameters["bio"] = null;
                }
                else{
                    $parameters["bio"] = $company->getBio();
                }

                if($company->getLinkedin()==null){
                $parameters["linkedin"] = null;
                }
                else{
                    $parameters["linkedin"] = $company->getLinkedin();
                }

                if( $company->getWebpage()==null){
                $parameters["webpage"] = null;
                }
                else{
                    $parameters["webpage"] = $company->getWebpage();
                }

                if($company->getFacebook()==null){
                $parameters["facebook"] =null;
                }
                else{
                    $parameters["facebook"] =$company->getFacebook();
                }
            

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

            } else {
                $parameters["webpage"] = $company->getWebpage();
            }

            if ($company->getFacebook() == null) {
                $parameters["facebook"] = null;
            } else {
                $parameters["facebook"] = $company->getFacebook();
            }


            $this->connection = Connection::GetInstance();


            $this->connection->ExecuteNonQuery($query0, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function selectBuilder($id = null, $name = null, $cuil = null)
    {
        $query = "SELECT * FROM Company WHERE active=" . strval(1);

        if (isset($id) && $id != "") {
            if (is_array($id)) {
                $query = $query . " && ";
                foreach ($id as $option) {
                    $query = $query . "id=" . $option . " OR ";
                }
                $query = substr($query, 0, -4);
            } else {
                $query = $query . " && id=" . $id;
            }
        }
        if (isset($name) && $name != "") {
            if (is_array($name)) {
                $query = $query . " && ";
                foreach ($name as $option) {
                    $query = $query . "name=" . $option . " OR ";
                }
                $query = substr($query, 0, -4);
            } else {
                $query = $query . ' && name="' . $name . '"';
            }
        }
        if (isset($cuil) && $cuil != "") {
            if (is_array($cuil)) {
                $query = $query . " && ";
                foreach ($cuil as $option) {
                    $query = $query . "cuil=" . $option . " OR ";
                }
                $query = substr($query, 0, -4);
            } else {
                $query = $query . " && cuil=" . $cuil;
            }
        }
        return $query;
    }

    public function readAll($id = null, $name = null, $cuil = null)
    {
        try {
            $companyList = array();

            $query = $this->selectBuilder($id, $name, $cuil);

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
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
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function verificarSiExisteEmpresa($name){


        try
                {
                    $companyList = array();
                   
                    $query = "SELECT name FROM ".$this->table." WHERE name like '".$name."' ";
    
                    
                    
                    $this->connection = Connection::GetInstance();
                   
                    $resultSet = $this->connection->Execute($query);
                   
                    foreach ($resultSet as $row)
                    {
                        $company = new Company();
                       
                        $company->setName($row["name"]);
                       
                      
                        array_push($companyList, $company);
                    }
                  
                    return $companyList;
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
    
        }
   

    public function buscarNombre($name){


        try
                {
                    $companyList = array();
                   
                    $query = "SELECT id, name, cuil FROM ".$this->table." WHERE name like '".$name."%' ";
    
                    
                    
                    $this->connection = Connection::GetInstance();
                   
                    $resultSet = $this->connection->Execute($query);
                   
                    foreach ($resultSet as $row)
                    {
                        $company = new Company();
                        $company->setId($row["id"]);
                        $company->setName($row["name"]);
                        $company->setCuil($row["cuil"]);
                      
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
                $query = "UPDATE ".$this->table." SET name = :name, cuil = :cuil, img = :img, shortDesc = :shortDesc, ranking = :ranking, email = :email, phone = :phone, city = :city, address = :address, jobOffers = :jobOffers, bio = :bio, linkedin = :linkedin, webpage = :webpage, facebook = :facebook, active = :active WHERE ( id = :id ) ";

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



    public function getNameCompanyForId($idList)
    {


        // select a.name from Company a inner join JobsOffer jo on a.id= jo.CompanyId; 
        $nameCompanyList = array();

        for ($i = 0; $i < count($idList); $i++) {

            $query = "SELECT b.name from Company b INNER JOIN JobsOffer a on  b.id = " . $idList[$i]->getCompanyId() . " limit 1 ";

            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query);

            foreach ($results as $row) {
                $company = new company();
                $company->setName($row["name"]);


                array_push($nameCompanyList, $company); // devuelve una lista unicametne con los names de company

            }
        }

        return $nameCompanyList;
    }



        public function VerificarCuilExist($cuil)
        {
            try
            {
                
    
                $query = "SELECT cuil FROM ".$this->table." WHERE cuil like '".$cuil."' ";
    
               
    
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
