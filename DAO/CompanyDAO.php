<?php

namespace DAO;

use DAO\ICompanyDAO as ICompanyDAO;
use Models\Company as Company;

class CompanyDAO implements ICompanyDAO{

    private $companyList=array();
    private $fileName = ROOT."Data/company.json";

    function Add(Company $company){

        
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
            
            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }


    public function Remove($name)
    {            
        $this->RetrieveData();
        
        $this->companyList = array_filter($this->companyList, function($company) use($name){                
            return $company->getName() != $name;
        });
        
        $this->SaveData();
    }




    public function searchName($name)
    {            
        $this->RetrieveData();
        
        $companySearch = array_filter($this->companyList, function($company) use($name){                
            return $company->getName() == $name;
        });
        
        return $companySearch;
    }






    function GetAll(){

        $this->RetrieveData();

        return $this->companyList;
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
                     $company = new Company();
                     $company->setName($content["Name"]);
                     $company->setCuil($content["CUIL"]);
                     

                     array_push($this->companyList, $company);
                 }
             }
        }











}




?>