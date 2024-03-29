<?php

namespace DAO;
   
    
    use DAO\Connection as Connection;
    use Models\Student as Student;
    use DAO\Crud as Crud;
    use Exception as Exception;

    class StudentDAO implements Crud
    {



        private $studentList = array();
        private $table="Student";
	    private $connection;


      
        public function __construct(){
            $this->connection = Connection::getInstance();
        }






        public function create($student)
	    {

          try
            {
                
                $query = "INSERT INTO ".$this->table." ( Password, apiId) VALUES ( :Password, :apiId ) ";
               
                $parameters["Password"] = $student->getPassword();
                $parameters["apiId"] = $student->getStudentId();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
	    }
    
    
    
    
     public function readAll(){
        try
            {
                $studentList = array();

                $query = "SELECT * FROM ".$this->table;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $student = new Student();
                    $student->setStudentId($row["Id"]);
                    $student->setFirstName($row["Name"]);
                    $student->setActive($row["Active"]);
                    $student->setEmail($row["Email"])   ;
                    $student->setEmail($row["Password"]);

                    array_push($studentList, $student);
                }

                return $studentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

       public function read($studentId)
        {
            try
            {
                $artist = null;

                $query = "SELECT * FROM ".$this->table." WHERE Id = :Id";

                $parameters["Id"] = $studentId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $student = new Student();
                    $student->setStudentId($row["studentId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                }
                            
                return $student;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        
    public function update($student){

        try
            {
                $query = "UPDATE ".$this->table." SET Name = :Name, Active = :Active, Email  = :Email, Password = :Password  WHERE Id = :Id";
                
                
                $parameters["Active" ] = $student->getActive();
                $parameters["Email" ] = $student->getEmail();
                $parameters["Password" ] = $student->getPassword();
                $parameters["Name" ] = $student->getName();

                
                

                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

     }


  
  
      public function delete($StudentId)
        {
            try
            {
                $query = "DELETE FROM ".$this->table." WHERE Id = :Id";
            
                $parameters["Id"] = $StudentId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            }            
        }


     


/**
 * Devuelve un estudiante por mail
 * param Mail
 */
    public function getStudentData($email)
    {

        $this->RetrieveData2($email);
        return $this->studentList;
    }

   /**
    * Recibe un mail  y busca dentro de la lista cargada por la api estudiantes
    *@param mail del estudiante a buscar
    *Si no lo encuentra retorna null
    */
   
    public function GetByStudentMail($mail)
    {
        $students = null; // cambio

        $this->RetrieveData();

        $students = array_filter($this->studentList, function ($student) use ($mail) {
            return $student->getEmail() == $mail;
        });

        $students = array_values($students); //Reordering array indexes

        return (count($students) > 0) ? $students[0] : null;
    }


/**
 * carga la lista de la clase con los datos de la api
 */
    private function RetrieveData()
    {
        $this->studentList = array();

        $opt = array(
            "http" => array(
                "method" => "GET",
                "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
            )
        );

        $ctx = stream_context_create($opt);

        $aux = file_get_contents("https://utn-students-api.herokuapp.com/api/Student", false, $ctx);
        $array = ($aux) ? json_decode($aux, true) : array();


        foreach ($array as $valuesArray) {
            $student = new Student();
            $student->setStudentId($valuesArray["studentId"]);
            $student->setFirstName($valuesArray["firstName"]);
            $student->setLastName($valuesArray["lastName"]);
            $student->setCareerId($valuesArray["careerId"]);
            $student->setDni($valuesArray["dni"]);
            $student->setFileNumber($valuesArray["fileNumber"]);
            $student->setGender($valuesArray["gender"]);
            $student->setBirthDate($valuesArray["birthDate"]);
            $student->setEmail($valuesArray["email"]);
            $student->setPhoneNumber($valuesArray["phoneNumber"]);
            $student->setActive($valuesArray["active"]);


            array_push($this->studentList, $student);
        }
    }

    private function RetrieveData2($email)
    {
        $this->studentList = array();

        $opt = array(
            "http" => array(
                "method" => "GET",
                "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
            )
        );

        $ctx = stream_context_create($opt);

        $aux = file_get_contents("https://utn-students-api.herokuapp.com/api/Student", false, $ctx);
        $array = ($aux) ? json_decode($aux, true) : array();


        foreach ($array as $valuesArray) {
            if ($email == $valuesArray["email"]) {
                $student = new Student();

                $student->setStudentId($valuesArray["studentId"]);
                $student->setFirstName($valuesArray["firstName"]);
                $student->setLastName($valuesArray["lastName"]);
                $student->setCareerId($valuesArray["careerId"]);
                $student->setCareerId($valuesArray["dni"]);
                $student->setFileNumber($valuesArray["fileNumber"]);
                $student->setGender($valuesArray["gender"]);
                $student->setBirthDate($valuesArray["birthDate"]);
                $student->setEmail($valuesArray["email"]);
                $student->setPhoneNumber($valuesArray["phoneNumber"]);
                $student->setActive($valuesArray["active"]);

                array_push($this->studentList, $student);
            }
        }

    }


    public function Add(Student $student)
    {
        $this->RetrieveData();                              // de momento no es necesaria porque se baja todo de la api

        array_push($this->studentList, $student);
    }
    /**
     * Obtiene todos los datos de la api y los carga en la lista de la clase
     */
    public function GetAll()
    {
        $this->RetrieveData();

        return $this->studentList;
    }

    

/**
 * Devuelve un estudiante buscandolo en la base de datos por el id de la api
 * @param apiId
 */
    public function GetByUserId($apiId)
    {
        $student = null;

        $query = "SELECT * from ".$this->table. " WHERE apiId = ".$apiId." AND active = '1'";
        
        $this->connection = Connection::GetInstance();

        $results = $this->connection->Execute($query);
       
        foreach($results as $row)
        {
            $student = new Student();
            $student->setDbId($row["id"]);
            $student->setPassword($row["Password"]);
            $student->setStudentId($row["apiId"]);
        }

        return $student;
    }  


    /**
     * Buscan un estudiante en la api por mail
     * @param mail
     */
    public function existsMailPorId($mail){

        $this->RetrieveData();
        $return=null; 
       
        for ($i=0; $i < count($this->studentList); $i++) { 
            if(($this->studentList[$i]->getEmail() == $mail) && ($this->studentList[$i]->getActive() == true) ){
               
                $return = $this->studentList[$i]->getStudentId();
                
            }
        }
        
        return $return;
    }

    /**
     * Busca un estudiante por id en la api
     * @param id del estudiante
     */
    public function getStudentForIdApi($id){

        $this->RetrieveData();
        $return=null; 
       
        for ($i=0; $i < count($this->studentList); $i++) { 
            if(($this->studentList[$i]->getStudentId() == $id) && ($this->studentList[$i]->getActive() == true) ){
               
                $return = $this->studentList[$i];
                
            }
        }
        
        return $return;
    }

    /**
     * Retorna un estudiante buscandolo en la abse de datos por el apiId
     * @param apiId
     * 
     */
    public function VerificarStudentExsistInDb($apiId)
    {
        try
        {
            

            $query = "SELECT apiId FROM ".$this->table." WHERE apiId like '".$apiId."' ";

           

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            
            return $resultSet;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }







    
    /**
     * busca y retorna un estudiante de la api por el careerId
     * @param careerId 
     */

    public function existsCareerId($careerId){

        $this->RetrieveData();
        
        $return=null;
        for ($i=0; $i < count($this->studentList); $i++) { 
            if($this->studentList[$i]->getCareerId() == $careerId){
               
                $return = $this->studentList[$i];
                
            }
        }

        
        return $return;



    }

   /**
     * busca y retorna un estudiante de la api por id
     * @param id
     */

    public function getCareerIdForStudent($id){


        $this->RetrieveData();
        
        $return=null;


        for ($i=0; $i < count($this->studentList); $i++) { 
            if($this->studentList[$i]->getStudentId() == $id){
               
             
                $return = $this->studentList[$i]->getCareerId(); // retorna el idCareer del alumno
                
            }
        }

        
        return $return;


    }


/**
 * Obtiene todos los apiId de la base de datos de estudiantes 
 * 
 */


    public function getAllBdd()
    {
        $student = null;
        $studentList2=array();

        $query = "SELECT apiId from ".$this->table. " WHERE active = '1'";
        
        $this->connection = Connection::GetInstance();

        $results = $this->connection->Execute($query);
       
        foreach($results as $row)
        {
            $student = new Student();
            $student->setDbId($row["apiId"]);

            array_push($studentList2, $student); // devuelve una lista unicametne con los apiId
           
        }

      
        return $studentList2;
    }  


/**
 * Obtiene una lista con los o el estudainte que coincida con la apiId
 * @param lista estudiantes
 */

    public function getAllApiId($studentList2){

       
        $this->RetrieveData();
        $studentListaFull=array();
        $return=null;


        for($j=0; $j < count($studentList2); $j++) {
         for ($i=0; $i < count($this->studentList); $i++) { 
           
            if($this->studentList[$i]->getStudentId() == $studentList2[$j]->getDbId() ){
               
                array_push($studentListaFull, $this->studentList[$i] );
                
            }
        }
    }

        
        return $studentListaFull;
    }


  













}
