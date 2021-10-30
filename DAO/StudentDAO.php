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
                $query = "INSERT INTO ".$this->table." (Name) VALUES (Name), (Email) VALUES (:Email),(Password) VALUES (:Password),
                (Active) VALUES (:Active);";//DUDA, el ID es autoincrement
                                                                            //como le solicito el insert ??
                
                
                $parameters["Name"] = $student->getFirstName();
                $parameters["Email"] = $student->getEmail();
                $parameters["Password"] = $student->getPassword();
                $parameters["Active"] = $student->getActive();
               
                

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
                    $student->setPassword($row["Password"]);

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
                $student = null;

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


     



    public function getStudentData($email)
    {

        $this->RetrieveData2($email);
        return $this->studentList;
    }

   
   
    public function GetByStudentMail($mail)
    {
        $student = null;

        $this->RetrieveData();

        $students = array_filter($this->studentList, function ($student) use ($mail) {
            return $student->getEmail() == $mail;
        });

        $students = array_values($students); //Reordering array indexes

        return (count($students) > 0) ? $students[0] : null;
    }



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

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->studentList;
    }

    
}
