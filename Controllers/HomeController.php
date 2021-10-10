<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;

    class HomeController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."loguin.php");
        }

   

        public function Login($email)
        {
            $student = $this->studentDAO->GetByStudentMail($email);

            if($student != null)
            {
                $_SESSION["loggedUser"] = $student;
                $this->ShowStudentView($student);
            }
            else{
                $this->Index("Usuario y/o Contraseña incorrectos");
            }
        }
        
        public function Logout()
        {
            session_destroy();

            $this->Index();
        }


        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {
            $studentList = $this->studentDAO->GetAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."student-list.php");
        }


        public function ShowStudentView($email)
        {
            $studentList = $this->studentDAO->getStudentData($email);
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."student-Info.php");
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