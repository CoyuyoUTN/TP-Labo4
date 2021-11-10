<?php

namespace Models;

use Models\JobPosition as JobPosition;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;

class JobOffer
{
    private $id;
    private $description;
    private $companyId;
    private $jobPositionId;
    private $jobPosition;
    private $active;
    private $company;
    private $date;

    public function __construct($id=NULL, $description=NULL, $companyId=NULL, $jobPositionId=NULL)
    {   
        $positionInstance = JobPositionDAO::getInstance();
        $companyInstance = new CompanyDAO();
        $this->id = $id;
        $this->description = $description;
        $this->companyId = $companyId;
        if(isset($this->companyId)){
            $this->company = $companyInstance->read($this->companyId);
        }
        $this->jobPositionId = $jobPositionId;
        if(isset($this->jobPositionId)){
            $this->jobPosition = $positionInstance->getById($this->jobPositionId);
        }
    }

    public static function fromArray($array)
    {
        $id=null;
        $description=null;
        $companyId=null;
        $jobPositionId=null;

        if (isset($array["id"])) {
            $id = $array["id"];
        } else {
            $id = null;
        }
        if (isset($array["Description"])) {
            $description = $array["Description"];
        } else {
            $description = null;
        }
        if (isset($array["CompanyId"])) {
            $companyId = $array["CompanyId"];
        } else {
            $companyId = null;
        }
        if (isset($array["JobPositionId"])) {
            $jobPositionId = $array["JobPositionId"];
        } else {
            $jobPositionId = null;
        }
        

        return new self($id, $description, $companyId, $jobPositionId);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
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
     * Get the value of companyId
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set the value of companyId
     *
     * @return  self
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get the value of jobPositionId
     */
    public function getJobPositionId()
    {
        return $this->jobPositionId;
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

    /**
     * Get the value of jobPosition
     */ 
    public function getJobPosition()
    {
        return $this->jobPosition;
    }

    /**
     * Set the value of jobPosition
     *
     * @return  self
     */ 
    public function setJobPosition($jobPosition)
    {
        $this->jobPosition = $jobPosition;

        return $this;
    }

    /**
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of company
     */ 
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of company
     *
     * @return  self
     */ 
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }
}
