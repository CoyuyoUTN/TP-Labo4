<?php

namespace Models;

class JobOffer
{
    private $id;
    private $description;
    private $companyId;
    private $jobPositionId;

    public function __construct($id, $description, $companyId, $jobPositionId)
    {
        $this->id = $id;
        $this->description = $description;
        $this->companyId = $companyId;
        $this->jobPositionId = $jobPositionId;
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
}