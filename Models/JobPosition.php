<?php

namespace Models;

class JobPosition
{
    private $jobPositionId;
    private $careerId;
    private $description;
    
    function __construct(
        $jobPositionId=NULL,
        $careerId=NULL,
        $description=NULL
    ){
        $this->jobPositionId=$jobPositionId;
        $this->careerId=$careerId;
        $this->description=$description;
    }

    static function byArray($value){
        $jobPositionId=null;
        $careerId=null;
        $description=null;

        if(isset($value["jobPositionId"])){
            $jobPositionId = $value["jobPositionId"];
        }

        if(isset($value["careerId"])){
            $careerId = $value["careerId"];
        }

        if(isset($value["description"])){
            $description = $value["description"];
        }

        return new self($jobPositionId,$careerId,$description);
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of careerId
     */ 
    public function getCareerId()
    {
        return $this->careerId;
    }

    /**
     * Get the value of jobPositionId
     */ 
    public function getJobPositionId()
    {
        return $this->jobPositionId;
    }


   




    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the value of jobPositionId
     *
     * @return  self
     */ 
    public function setJobPositionId($jobPositionId)
    {
        $this->jobPositionId = $jobPositionId;

        return $this;
    }
}
