<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;
use DAO\CompanyDAO as CompanyDAO;
use DAO\AdminDAO as AdminDAO;
use DAO\JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use Models\JobPosition;

class HomeController
{
    private $studentDAO;
    private $companyDAO;
    private $adminDAO;


    public function __construct()
    {
        $this->studentDAO = new StudentDAO();
        $this->companyDAO = new CompanyDAO();
        $this->adminDAO = new AdminDAO();
    }

    public function Index($message = "")
    {
        require_once(VIEWS_PATH . "loguin.php");
    }

    public function PhpInfo()
    {
        phpinfo();
    }


    public function Login($email, $password)
    {
           // $password= md5($password);
        
        $userAdmin= $this->adminDAO->GetByEmail($email, $password);
        
        if ($userAdmin!=null && $userAdmin->getEmail() == $email  && $userAdmin->getPassword() == $password ) {
            $_SESSION["loggedUser"] = $userAdmin;
            $this->ShowAdminView();

        } else {
            $dbId = $this->studentDAO->existsMailPorId($email); //valida si exite por api y devuelve studentId, sino null
            $user=null;

            if ($dbId != null) {
                $user = $this->studentDAO->GetByUserId($dbId, $password);
            }


            if (($user != null) && ($user->getPassword() == $password)) {
                $_SESSION["loggedUser"] = $user;
    
                $this->ShowStudentView($email);
            } else {
                ?> <script language="javascript">
                        alert("Usuario y/o Contraseña incorrectos o usuario no activo");
                    </script>
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

    public function BackToLogin()
    {
        require_once(VIEWS_PATH . "loguin.php");
    }

    public function Check($email, $password)
    {


        $student = $this->studentDAO->existsMailPorId($email);


        if ($student != null) {
            $student->setPassword($password);

            $this->studentDAO->create($student);
            ?> <script language="javascript">
                alert("Cuenta creada exitosamente, inicie sesion");
            </script>
        <?php
            require_once(VIEWS_PATH . "loguin.php");
        } else {
        ?> <script language="javascript">
                alert("No existe Mail");
            </script>
<?php
            require_once(VIEWS_PATH . "loguin.php");
        }
    }






    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "student-add.php");
    }

    public function ShowListView()
    {
        $studentList2=array();
        $studentList2 = $this->studentDAO->getAllBdd();
        $studentList= $this->studentDAO->getAllApiId($studentList2);

        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "student-list.php");

        /*$studentList = $this->studentDAO->GetAll();
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "student-list.php");*/
    }


    public function ShowCompanyListStudent()
    {
        $companyList=null;
        if (isset($_GET['search'])) {
            $companyList = $this->companyDAO->buscarNombre($_GET['search']);
           
        } else {
            $companyList = $this->companyDAO->readAll();
        }
        if ($companyList==null){
            ?> <script language="javascript">
                        alert("Empresa no encontrada");
                        
                    </script>
                <?php
               
        }
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "studentCompanyList.php");
    }


   
    public function ShowRegisterView()
    {

        require_once(VIEWS_PATH . "registro1.php");
    }


    public function ShowFullData($companyID)
    {
        $company = $this->companyDAO->read($companyID);
        require_once(VIEWS_PATH . "companyFullData.php");


    }



 


    public function ShowStudentView($email)
    {
        $studentList = $this->studentDAO->getStudentData($email);
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "student-Info.php");
    }

    public function ShowAdminView()
    {
        header("Location: ../Admin/ShowAll");
    }



    public function Add($studentId, $firstName, $lastName, $careerId, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active)
    {
        $student = new Student($studentId, $firstName, $lastName, $careerId, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active);

        $this->studentDAO->Add($student);

        $this->ShowAddView();
    }


    public function Remove($name)
    {
        require_once(VIEWS_PATH . "validate-session.php");

        $this->companyDAO->Remove($name);

        $this->ShowAdminView();
    }


}
