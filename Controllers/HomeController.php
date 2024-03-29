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
       /**
         * Funcion utilizada para Loguearse trayendo los datos de la Base de Datos y de la Api
         */

    public function Login($email, $password)
    {
           
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
                $userCompany= $this->companyDAO->getCompanyByEmail($email, $password);

                if($userCompany !=null && $userCompany->getEmail() == $email  && $userCompany->getPassword() == $password){
                      
                    $_SESSION["loggedUser"] = $userCompany;
                    $this->ShowFullData();
        
                } else {
                ?> <script language="javascript">
                        alert("Usuario y/o Contraseña incorrectos o usuario no activo");
                    </script>
                <?php
                $this->Index("Usuario y/o Contraseña incorrectos");
                        }
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
        /**
         * Funcion utilizada para registrarse al programa, fijandose si ya hay un usuario con ese mail en la Base de Datos y la Api
         */

    public function Check($email, $password)
    {

        $companyExist= $this->companyDAO->VerificarCompanyExsistInDb($email);

            if($companyExist!= null){

                foreach($companyExist as $company){

                    if($company->getPassword() != null){

                        ?> <script language="javascript">alert("Empresa ya existente");</script>
                        <?php
                        require_once(VIEWS_PATH."loguin.php");
                    }
                    else{
                        $company->setPassword($password);
                        $this->companyDAO->altaCompany($company);
                        ?> <script language="javascript">
                        alert("Cuenta dada de alta con exito");
                        </script>
                    <?php
                    require_once(VIEWS_PATH . "loguin.php");

                    }

                }

          }

             else{

        

                    $studentIdApi = $this->studentDAO->existsMailPorId($email);
                
                    if($this->studentDAO->VerificarStudentExsistInDb($studentIdApi) != null){

                        ?> <script language="javascript">alert("Usuario ya existente");</script>
                        <?php
                        require_once(VIEWS_PATH."loguin.php");

                    }
                    else{
                        $student= $this->studentDAO-> getStudentForIdApi($studentIdApi);
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

        /**
         * Funcion utilizada para listar las Company para que el Student pueda filtrarlas
         */

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


    public function ShowFullData()
    {   
       $companyID= $_SESSION["loggedUser"]->getId(); 
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


     /**
         * Funcion utilizada para agregar Student a la Base de Datos 
         */

    public function Add($studentId, $firstName, $lastName, $careerId, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active)
    {
        $student = new Student($studentId, $firstName, $lastName, $careerId, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active);

        $this->studentDAO->Add($student);

        $this->ShowAddView();
    }

 /**
         * Funcion utilizada para eliminar Student de la Base de Datos 
         */
    public function Remove($name)
    {
        require_once(VIEWS_PATH . "validate-session.php");

        $this->companyDAO->Remove($name);

        $this->ShowAdminView();
    }


}
