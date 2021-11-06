<?php

namespace DAO;

use Models\JobPosition as JobPosition;

class JobPositionDAO
{
    private $jobPositionList;
    private static $instance;

    function __construct()
    {
        $this->jobPositionList = array();

        $opt = array(
            "http" => array(
                "method" => "GET",
                "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
            )
        );

        $ctx = stream_context_create($opt);

        $aux = file_get_contents("https://utn-students-api.herokuapp.com/api/JobPosition", false, $ctx);
        $array = ($aux) ? json_decode($aux, true) : array();

        foreach ($array as $value) {
            array_push($this->jobPositionList, new JobPosition($value["jobPositionId"],$value["careerId"],$value["description"]));
        }
    }

    static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    function getAll(){
        return $this->jobPositionList;
    }

    function getById($id){
        $ret = new JobPosition;
        foreach ($this->jobPositionList as $value) {
            if($value->getJobPositionId() == $id){
                $ret = $value;
            }
        }
        return $ret;
    }


    /*function getByCareerId($studentCareerId){
      
        $listByCareer = array();

        foreach ($this->jobPositionList as $value) {

            if($value->getCareerId() == $studentCareerId){
              
                $jobPosition = new JobPosition;
               
                $jobPosition["jobPositionID"] = $value->getJobPositionId();
                $jobPosition["careerId"] = $value->getCareerId();
                $jobPosition["description"] = $value->getJobPositionId();

                  array_push($listByCareer, $jobPosition);

             }
               
        }

     return $listByCareer;

    }*/


    
    }


    
    function searchByDescription($description){
        $prueba = $description;
        $ret = array();

        foreach ($this->jobPositionList as $value) {
            if(!is_array($prueba)){
                if(str_contains($value->getDescription(), $prueba)){
                    array_push($ret,$value);
                }
            }
        }
        return $ret;
    }



    public function getJobsPositionsForCareerId($careerId){

        $listJobsPosition=array();

        for($i=0;$i<count($this->jobPositionList);$i++){

            if($this->jobPositionList[$i]->getCareerId=$careerId){

                $jobPosition= new JobPosition();

                $jobPosition->setDescription($this->jobPositionList[$i]->getDescription());
                $jobPosition->setJobPositionId($this->jobPositionList[$i]->getJobPositionId());

                array_push($listJobsPosition,$jobPosition);

            }


        }

                return $listJobsPosition;

     }


















}
