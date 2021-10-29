<?php
<<<<<<< Updated upstream

namespace DAO;

use DAO\IStudentDAO as IStudentDAO;
use Models\Student as Student;
use DAO\Connection as Connection;

class StudentDAO implements IStudentDAO
{
    private $db;

    public function __construct(){
        $this->db = Connection::getInstance();
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
=======
    namespace DAO;
    namespace interface;


    
    use Models\Student as Student;
    use interface\Crud as Crud;

    class StudentDAO implements Crud
    {



        private $studentList = array();
        private $table="student";
	    private $connection;








        public function create(Student $student)
	{

        try
            {
                $query = "INSERT INTO ".$this->table." (name) VALUES (:name);";
                
                $parameters["name"] = $student->getName();
                

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
                    $student = new User();
                    $student->setID($row["studentId"]);
                    $student->setName($row[""]);

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

                $query = "SELECT * FROM ".$this->table." WHERE studentId = :studentId";

                $parameters["studentId"] = studentCode;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {
                    $student = new Student();
                    $student->setId($row["studentId"]);
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
                $query = "UPDATE ".$this->table." SET name = :name WHERE id_artist = :id_artist";
                
                $parameters["id_artist"] = $artist->getID();
                $parameters["name"] = $artist->getName();
                

                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

    }
    public function delet($artistCode)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE id_artist = :id_artist";
            
                $parameters["id_artist"] = $artistCode;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);   
            }
            catch(Exception $ex)
            {
                throw $ex;
            }            
        }


        public function GetAllfromAPI()
        {
            $this->RetrieveData();
>>>>>>> Stashed changes


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
<<<<<<< Updated upstream
    }

    function toDataBase()
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
            if (isset($_GET['studentId']) ==  $valuesArray["stuendtId"]) {
                $verify = $this->db->Execute('SELECT * FROM Studient WHERE apiId='.$valuesArray["stuendtId"]);
                if(empty($verify)){
                    //Registrarse
                }
            }
        }
    }
}
=======
                
        
?>
>>>>>>> Stashed changes
