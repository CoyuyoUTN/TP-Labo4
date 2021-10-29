<?php

namespace DAO;


use interface\Crud;
use Models\Company as Company;


class CompanyDAO implements Crud{

    private $companyList=array();
    private $fileName = ROOT."Data/company.json";
    private $table="Company";
	private $connection;



    private function __construct()
	{
		
	}
	
    
    public function create ($company)
	{

        try
            {
               
                $query1 = "INSERT INTO ".$this->table." (name) VALUES (:name);";
                $query2 = "INSERT INTO ".$this->table." (cuil) VALUES (:cuil);";
                $query3 = "INSERT INTO ".$this->table." (id) VALUES (:id);";
                $query4 = "INSERT INTO ".$this->table." (img) VALUES (:img);";
                $query5 = "INSERT INTO ".$this->table." (shortDesc) VALUES (:shortDesc);";
                $query6 = "INSERT INTO ".$this->table." (ranking) VALUES (:ranking);";
                $query7 = "INSERT INTO ".$this->table." (email) VALUES (:email);";
                $query8 = "INSERT INTO ".$this->table." (phone) VALUES (:phone);";
                $query9 = "INSERT INTO ".$this->table." (city) VALUES (:city);";
                $query10 = "INSERT INTO ".$this->table." (address) VALUES (:address);";
                $query11 = "INSERT INTO ".$this->table." (jobOffers) VALUES (:jobOffers);";
                $query12 = "INSERT INTO ".$this->table." (bio) VALUES (:bio);";
                $query13 = "INSERT INTO ".$this->table." (linkedin) VALUES (:linkedin);";
                $query14 = "INSERT INTO ".$this->table." (webpage) VALUES (:webpage);";  
                $query15 = "INSERT INTO ".$this->table." (facebook) VALUES (:facebook);";
                $query16 = "INSERT INTO ".$this->table." (active) VALUES (:active);";


                $parameters1["name"] = $company->getName();
                $parameters2["cuil"] =$company->getCuil();
                $parameters3["id"] = $company->getId();
                $parameters4["img"] =$company->getImg();
                $parameters5["shortDesc"] = $company->getShortDesc();
                $parameters6["ranking"] = $company->getRanking();
                $parameters7["email"] = $company->getEmail();
                $parameters8["phone"] =$company->getPhone();
                $parameters9["city"] =$company->getCity();
                $parameters10["address"] = $company->getAddress();
                $parameters11["jobOffers"] =$company->getJobOffers();
                $parameters12["bio"] = $company->getBio();
                $parameters13["linkedin"] = $company->getLinkedin();
                $parameters14["webpage"] = $company->getWebpage();
                $parameters15["facebook"] =$company->getFacebook();
                $parameters16["active"] = $company->getActive();
              


                $this->connection = Connection::GetInstance();


                $this->connection->ExecuteNonQuery($query1, $parameters1);
                $this->connection->ExecuteNonQuery($query2, $parameters2);
                $this->connection->ExecuteNonQuery($query3, $parameters3);
                $this->connection->ExecuteNonQuery($query4, $parameters4);
                $this->connection->ExecuteNonQuery($query5, $parameters5);
                $this->connection->ExecuteNonQuery($query6, $parameters6);
                $this->connection->ExecuteNonQuery($query7, $parameters7);
                $this->connection->ExecuteNonQuery($query8, $parameters8);
                $this->connection->ExecuteNonQuery($query9, $parameters9);
                $this->connection->ExecuteNonQuery($query10, $parameters10);
                $this->connection->ExecuteNonQuery($query11, $parameters11);
                $this->connection->ExecuteNonQuery($query12, $parameters12);
                $this->connection->ExecuteNonQuery($query13, $parameters13);
                $this->connection->ExecuteNonQuery($query14, $parameters14);
                $this->connection->ExecuteNonQuery($query15, $parameters15);
                $this->connection->ExecuteNonQuery($query16, $parameters16);
            }              
 
            }
            }

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
                    $admin->setID($row["Id"]);
                    $admin->setEmail($row["Email"]);
                    $admin->setPassword($row["Password"]);
                    $admin->setNombre($row["Name"]);
                    
                    

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
                $category = null;

                $query = "SELECT * FROM ".$this->table." WHERE Id = :Id";

                $parameters["Id"] = $adminId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $admin = new Admin();
                    $admin->setID($row["Id"]);
                    $admin->setEmail($row["Email"]);
                    $admin->setPassword($row["Password"]);
                    $admin->setNombre($row["Name"]);
                }
                            
                return $admin;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    public function update ($admin){

        try
            {
                $query = "UPDATE ".$this->table." SET Name = :Name, Email = :Email, Password = :Password  WHERE Id = :Id";
                
                $parameters["Id"] = $admin->getId();
                $parameters["Name"] = $admin->getNombre();
                $parameters["Password"] = $admin->getPassword();
                $parameters["Email"] = $admin->getEmail();
                
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
                $query = "DELETE FROM ".$this->tableName." WHERE Id = :Id";
            
                $parameters["Id"] = $adminId;

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

        $this->RetrieveData();
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