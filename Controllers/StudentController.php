<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;

    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {
            $studentList = $this->studentDAO->GetAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        public function Add($studentId,$firstName,$lastName,$careerId,$dni,$fileNumber,$gender,$birthDate,$email,$phoneNumber,$active)
        {
            $student = new Student();
         

            $student->setStudentId($studentId);
            $student->setFirstName($firstName);
            $student->setLastName($lastName);
            $student->setCareerId($careerId);
            $student->setCareerId ($dni);
            $student->setFileNumber ($fileNumber);
            $student->setGender ($gender);
            $student->setBirthDate ($birthDate);
            $student->setEmail ($email);
            $student->setPhoneNumber ($phoneNumber);
            $student->setActive ($active);






            $this->studentDAO->Add($student);

            $this->ShowAddView();
        }
    }
?>