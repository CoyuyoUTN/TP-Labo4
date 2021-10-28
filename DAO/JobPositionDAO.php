<?php

namespace DAO;

use Models\JobPosition as JobPosition;

class JobPositionDAO
{
    private $jobPositionList;

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
            array_push($this->studentList, new JobPosition($value["jobPositionId"],$value["careerId"],$value["description"]));
        }
    }

    function getAll(){
        return $this->jobPositionList;
    }

    function getById($id){
        $ret = array();
        foreach ($this->jobPositionList as $value) {
            if($value->getJobPositionId() == $id){
                $ret = $value;
            }
        }
        return $ret;
    }
}
