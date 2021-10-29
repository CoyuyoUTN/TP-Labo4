<?php
<<<<<<< Updated upstream
    namespace DAO;

    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;

    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();

        public function Add(Student $student)
        {
            $this->RetrieveData();                              // de momento no es necesaria porque se baja todo de la api
            
            array_push($this->studentList, $student);

           
=======

namespace DAO;
namespace interface;

use Models\Student as Student;
use interface\Crud as Crud;
use DAO\Connection as connection;



class StudentDAO implements Crud
{



    private $studentList = array();
    private $table = "student";
    private $connection;

      
    private function __construct()
	{
		
	}


    public function create(Student $student)
    {

        try {
            $query1 = "INSERT INTO " . $this->table . " (apiId) VALUES (:apiId);";
            $query2 = "INSERT INTO " . $this->table . " (Password) VALUES (:id);";
            $query3 = "INSERT INTO " . $this->table . " (id) VALUES (:id);";
            $query4 = "INSERT INTO " . $this->table . " (active) VALUES (:active);";




            $parameters1["apiId"] = $student->getId();
            $parameters2["Password"] = $student->getPassword();
            $parameters3["id"] = $student->getDbId();
            $parameters4["active"] = $student->getActive();




            $this->connection = Connection::GetInstance();


            $this->connection->ExecuteNonQuery($query1, $parameters1);
            $this->connection->ExecuteNonQuery($query2, $parameters2);
            $this->connection->ExecuteNonQuery($query3, $parameters3);
            $this->connection->ExecuteNonQuery($query4, $parameters4);
        } catch (Exception $ex) {
            throw $ex;
        }
    }




    public function readAll()
    {
        try {
            $studentList = array();

            $query = "SELECT * FROM " . $this->table;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $student = new Student();
                $student->setId($row["studentId"]);
                $student->setActive($row["active"]);

                array_push($studentList, $student);
            }

            return $studentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }



    public function read($StudentId)
    {
        try {
            $student = null;

            $query = "SELECT * FROM " . $this->table . " id = :id";

            $parameters["id"] = $StudentId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $student = new Student();
                $student->setId($row["id"]);
                $student->setActive($row["active"]);
            }

            return $student;
        } catch (Exception $ex) {
            throw $ex;
        }
    }



    public function update($student)
    {

        try {
            $query1 = "UPDATE " . $this->table . " SET name = :name WHERE  id = :id";
            $query2 = "UPDATE " . $this->table . " SET name = :name WHERE  active = :active";

            $parameters1["id"] = $student->getStudentId();
            $parameters2["active"] = $student->getActive();



            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query1, $parameters1);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    


    public function delet($StudentId)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";

            $parameters["id"] = $StudentId;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
>>>>>>> Stashed changes
        }
    }



<<<<<<< Updated upstream
        public function GetAll()
        {
            $this->RetrieveData();
=======



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
>>>>>>> Stashed changes

            return $this->studentList;
        }
<<<<<<< Updated upstream
=======
    }

    
    
    private function RetrieveData2($email)
    {
        $this->studentList = array();
>>>>>>> Stashed changes

   
        public function getStudentData($email){

            $this->RetrieveData2($email);
            return $this->studentList;
        }

        public function GetByStudentMail($mail)
        {
            $student = null;

            $this->RetrieveData();

            $students = array_filter($this->studentList, function($student) use($mail){
                return $student->getEmail() == $mail;
            });

            $students = array_values($students); //Reordering array indexes

            return (count($students) > 0) ? $students[0] : null;
        }
<<<<<<< Updated upstream



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
              
              $aux=file_get_contents("https://utn-students-api.herokuapp.com/api/Student", false, $ctx);
              $array=($aux) ? json_decode($aux, true) : array();

             
                foreach($array as $valuesArray)
                {
                    $student = new Student();
                    $student->setStudentId($valuesArray["studentId"]);
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);
                    $student->setCareerId($valuesArray["careerId"]);
                    $student->setCareerId ($valuesArray["dni"]);
                    $student->setFileNumber ($valuesArray["fileNumber"]);
                    $student->setGender ($valuesArray["gender"]);
                    $student->setBirthDate ($valuesArray["birthDate"]);
                    $student->setEmail ($valuesArray["email"]);
                    $student->setPhoneNumber ($valuesArray["phoneNumber"]);
                    $student->setActive ($valuesArray["active"]);
                    

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
              
              $aux=file_get_contents("https://utn-students-api.herokuapp.com/api/Student", false, $ctx);
              $array=($aux) ? json_decode($aux, true) : array();

             
                foreach($array as $valuesArray)
                    {
                        if($email==$valuesArray["email"]){
                    $student = new Student();

                        
                    $student->setStudentId($valuesArray["studentId"]);
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);
                    $student->setCareerId($valuesArray["careerId"]);
                    $student->setCareerId ($valuesArray["dni"]);
                    $student->setFileNumber ($valuesArray["fileNumber"]);
                    $student->setGender ($valuesArray["gender"]);
                    $student->setBirthDate ($valuesArray["birthDate"]);
                    $student->setEmail ($valuesArray["email"]);
                    $student->setPhoneNumber ($valuesArray["phoneNumber"]);
                    $student->setActive ($valuesArray["active"]);
                    

                    array_push($this->studentList, $student);
                }
            }
            
        
        }
                
        function toDataBase ()
        {
                        
                
            try
         {
             $pdo = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
             if ($_GET && isset($_GET['studentId'])) {
                 //Execute INSERT statement
                 $insertStatement = $pdo->prepare("INSERT INTO Students (studentId, careerId, password )
                                             VALUES (:studentId, :CareerId, :Password)");
     
                 $studentId = $_GET["studenId"];
                 $CareerId = $_GET["CareerId"];
                 $Password = $_GET["lastName"];
     
                 $insertStatement->bindParam(":studentId", $studentId);
                 $insertStatement->bindParam(":CareerId", $CareerId);
                 $insertStatement->bindParam(":Password", $Password);
         
                 $insertStatement->execute();
             }
             }
             catch(PDOException $ex)
             {
                 echo $ex->getMessage();
             }
            }
    }
?>
=======
    }
}
>>>>>>> Stashed changes
