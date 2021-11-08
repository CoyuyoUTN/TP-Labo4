<?php

namespace DAO;

use DAO\Connection as Connection;
use Exception as Exception;
use Models\Aplicant as Aplicant;

class AplicantDAO {

    private $db;
    private $table='Student_x_JobOffer';
    private $aplicantList;

    function __construct(){
        $this->db = Connection::getInstance();
    }



    public function readAll(){

        /*select 
        (select apiId from Student where id=7) as Nombre, 
        (select Description from JobsOffer jo where id=3) as Oferta,
        Date 
        from Student_x_JobOffer sxjo 
        where StudentId=7 ;*/

        try
            {
                $aplicantList = array();

                $query = "SELECT * FROM ".$this->table. " where active = 1 ";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $aplicant = new Aplicant();
                    $aplicant->setStudentId($row["StudentId"]);
                    $aplicant->setJobOfferId($row["JobOfferId"]);
                    $aplicant->setDate($row["Date"]);
                   
                    
                    

                    array_push($aplicantList, $aplicant);
                }

                return $aplicantList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }





    }












}
?>