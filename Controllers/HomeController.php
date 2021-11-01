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


        public function Login($email, $password)
    {


            
            if($email=="admin@gmail.com" && $password== "123456"){
                $_SESSION["loggedUser"] = $email;
                $this->ShowAdminView();
            }


            else
        {
            $dbId=$this->studentDAO->existsMailPorId($email); //valida si exite por api y devuelve studentId, sino null
            $user=null;
            
            if($dbId != null){
            $user = $this->studentDAO->GetByUserId($dbId);
            var_dump($user);
            } 
           
        
            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;
                $this->ShowStudentView($email);
            }
            else
            {
            ?> <script language="javascript">alert("Usuario y/o Contraseña incorrectos");</script>
            <?php
                $this->Index("Usuario y/o Contraseña incorrectos");
            }
        
        }
    }



        public function Logout()
        {
            session_destroy();

            $this->Index();
        }

        public function BackToLogin(){
            require_once(VIEWS_PATH."loguin.php");
        }

        public function Check($email, $password){
           
            
           $student= $this->studentDAO->existsMail($email);
            
           
            if($student != null){
                $student->setPassword($password);
                
                $this->studentDAO->create($student);
                ?> <script language="javascript">alert("Cuenta creada exitosamente, inicie sesion");</script>
               <?php
                 require_once(VIEWS_PATH."loguin.php");
            }
            else{
               ?> <script language="javascript">alert("No existe Mail");</script>
               <?php
                 require_once(VIEWS_PATH."loguin.php");
            }


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

        public function ShowRegisterView(){
            
                require_once(VIEWS_PATH."registro1.php");
            

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
            $companyList=$this->companyDAO->readAll();
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
