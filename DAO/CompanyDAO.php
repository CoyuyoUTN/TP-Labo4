<?php

namespace DAO;

use DAO\ICompanyDAO as ICompanyDAO;
use Models\Company as Company;

class CompanyDAO implements ICompanyDAO{

    private $companyList=array();
    private $fileName = ROOT."Data/company.json";

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