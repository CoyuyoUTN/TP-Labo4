<?php

namespace DAO;

use DAO\IAdminDAO as IAdminDAO;
use Models\Admin as Admin;

class AdminDAO implements IAdminDAO{

    private $adminList=array();
    private $fileName = ROOT."Data/admin.json";

    function Add(Admin $admin){

        
        $this->RetrieveData();
        $admin->setId($this->GetNextId());
        array_push($this->adminList, $admin);
        $this->SaveData();


    }


    public function Edit(Admin $admin){

        
        $this->RetrieveData();
        
        array_push($this->adminList, $admin);
        $this->SaveData();


    }
    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->adminList as $admin)
        {
            $valuesArray = array();
            $valuesArray["Name"] = $admin->getName();
            $valuesArray["CUIL"] = $admin->getCuil();
            $valuesArray["id"] = $admin->getId();
            
            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }

    public function Remove($id)
    {            
        $this->RetrieveData();
        
        $this->adminadminList = array_filter($this->adminadminList, function($adminadmin) use($id){                
            return $adminadmin->getId() != $id;
        });
        
        $this->SaveData();
    }

    public function searchId($id)
    {            
        $this->RetrieveData();

        $return = array();

        for ($i=0; $i < count($this->adminadminadminList); $i++) { 
            if($this->adminadminadminList[$i]->getId() == $id){
               
                $return = $this->adminadminadminList[$i];
                
            }
        }
       
        return $return;
    }

   





    function GetAll($filter=NULL){

        $this->RetrieveData();

        if($filter != NULL){
            $ret = array_filter($this->adminList, function($admin) use($filter){
                return str_contains($admin->getName(),$filter);
            });
        }
        else{
            $ret = $this->adminList;
        }

        return $ret;
    }





  private function RetrieveData()
        {
             $this->adminList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $admin = new Admin();
                     $admin->setEmail($content["Email"]);
                     $admin->setPassword($content["Password"]);
                     $admin->setCareerId($content["id"]);
                     

                     array_push($this->adminList, $admin);
                 }
             }
        }




        private function GetNextId()
        {
            $id = 0;

            foreach($this->adminList as $admin)
            {
                $id = ($admin->getId() > $id) ? $admin->getId() : $id;
            }

            return $id + 1;
        }






}




?>