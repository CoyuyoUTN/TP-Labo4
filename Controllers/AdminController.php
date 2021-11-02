<?php
    namespace Controllers;

    use DAO\AdminDAO as AdminDAO;
    use Models\Admin as Admin;

    class AdminController
    {
        private $adminDAO;
        
        public function __construct()
        {
            $this->adminDAO = new AdminDAO();
        }

        public function ShowAll($id=null,$email=null,$password=null, $name=null){
            $admins = $this->adminDAO->readAll($id,$email,$password, $name);

            require_once(VIEWS_PATH."adminList.php");
        }



        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."adminADD.php");
        }



       
        public function ShowAdminView() 
        {
           
            $companyList=$this->companyDAO->GetAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."adminadminList.php");
        }


        public function showModifyView(){
            
         
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."companyModify.php");
            
        }


        public function addADMIN($email,$password,$name){
            require_once(VIEWS_PATH."validate-session.php");
            $admin= new Admin($email,$password,$name);
            $this->adminDAO->create($admin);
            ?> <script language="javascript">alert("Usuario creado con exito");</script>
            <?php
            require_once(VIEWS_PATH."adminADD.php");


            
        }

    }
?>