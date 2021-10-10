<?php
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

           
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->studentList;
        }

   
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


    }
?>