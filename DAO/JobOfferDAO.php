<?php

namespace DAO;

use DAO\Connection as Connection;
use Models\JobOffer as JobOffer;


class JobOfferDAO
{
    private $db;

    function __construct(){
        $this->db = Connection::getInstance();
    }

    function GetAll(){
        $result = $this->db->Execute('SELECT * FROM JobsOffer');
        $list=array();

        foreach ($result as $value) {
            array_push($list,JobOffer::fromArray($value));
        }

        return $list;
    }
}
