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

    /**
     * Busca y retorna estudianes que se aplicaron a una oferta con sus datos completos y no por numero de id
     * @param lista de aplicantes.
     */

    public function datosRealesPorId($aplicantList){
 
        
       
        try
            {
                $datosRealesLis=array();

                for($i=0; $i < count($aplicantList); $i++){


                $query = "SELECT ( SELECT apiId from Student where id = " .$aplicantList[$i]->getStudentId(). "  ) as Nombre, ( SELECT Description from JobsOffer where id = " .$aplicantList[$i]->getJobOfferId(). " ) as Oferta, Date FROM ".$this->table. " where StudentId = " .$aplicantList[$i]->getStudentId(). " limit 1";

                
                   



                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $aplicant = new Aplicant();
                    $aplicant->setStudentId($row["Nombre"]);
                    $aplicant->setJobOfferId($row["Oferta"]);
                    $aplicant->setDate($row["Date"]);
                   
                    
                    

                    array_push($datosRealesLis, $aplicant);
                }
            }
            
                return $datosRealesLis;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }



    }



    public function getMailsForJobId($jobId){


        try
        {
            $mailsList = array();
    

            $query = "SELECT StudentId FROM Student_x_JobOffer WHERE JobOfferId = " .$jobId. " ";
    
           
    
            $this->connection = Connection::GetInstance();
    
            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $row)
            {
                $Aplicant = new Aplicant();
                $Aplicant->setStudentId($row["StudentId"]);

                array_push($mailsList,$Aplicant);
     
            }
                        
            return $mailsList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    
    }




}
?>