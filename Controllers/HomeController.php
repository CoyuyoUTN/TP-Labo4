<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class HomeController
    {
        private $studentDAO;
        private $companyDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->companyDAO= new CompanyDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."loguin.php");
        }

        public function PhpInfo(){
            phpinfo();
        }

        public function Login($email=NULL, $password=NULL)
        {
            if($email==NULL){
                if( $_SESSION["loggedUser"]){
                    $email= $_SESSION["loggedUser"]->getEmail();
                    
                }
                else{
                    $this->Index("Logueate");
                }
            }
          
            if($email=="admin@gmail.com"){
                $_SESSION["loggedUser"] = $email;
                $this->ShowAdminView();


            }
            else{

            $student = $this->studentDAO->GetByStudentMail($email);

            if($student != null)
            {
                $_SESSION["loggedUser"] = $student;
                $this->ShowStudentView($email);
            }
            else{
                $this->Index("Usuario y/o Contraseña incorrectos");
            }
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
    
        
        public function ShowCompanyListStudent(){
            if(isset($_GET['search'])){
                $companyList = $this->companyDAO->GetAll($_GET['search']);
            }
            else{
                $companyList = $this->companyDAO->GetAll();
            }
            
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."studentCompanyList.php");
        }


        public function ShowFullData($companyID)
        {
            $company = $this->companyDAO->searchId($companyID);
            require_once(VIEWS_PATH."companyFullData.php");
        }

        public function ShowStudentView($email)
        {
            $studentList = $this->studentDAO->getStudentData($email);
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."student-Info.php");
        }

        public function ShowAdminView() 
        {
            $companyList=$this->companyDAO->GetAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."companyList.php");
        }



        public function Add($studentId,$firstName,$lastName,$careerId,$dni,$fileNumber,$gender,$birthDate,$email,$phoneNumber,$active)
        {
            $student = new Student($studentId,$firstName,$lastName,$careerId,$dni,$fileNumber,$gender,$birthDate,$email,$phoneNumber,$active);

            $this->studentDAO->Add($student);

            $this->ShowAddView();
        }


        public function Remove($name)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->companyDAO->Remove($name);

            $this->ShowAdminView();
        }



        public function AddToDataBase(){
                require_once (VIEWS_PATH."studentADDtoDB.php");



        }


    }
