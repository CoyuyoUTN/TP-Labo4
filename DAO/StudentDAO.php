<?php
    namespace DAO;

    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;

    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();

        public function Add(Student $student)
        {
            $this->RetrieveData();
            
            array_push($this->studentList, $student);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->studentList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->studentList as $student)
            {
                $valuesArray["recordId"] = $student->getRecordId();
                $valuesArray["firstName"] = $student->getFirstName();
                $valuesArray["lastName"] = $student->getLastName();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/students.json', $jsonContent);
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
              $array=json_decode($aux);

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
    }
?>