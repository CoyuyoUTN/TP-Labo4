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
}
