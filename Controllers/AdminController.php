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


        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."adminADD.php");
        }

        public function ShowListView()
        {
            $adminList = $this->adminDAO->GetAll();

            require_once(VIEWS_PATH."adminList.php");
        }

        public function Add($name, $cuil)
        {
            require_once(VIEWS_PATH."validate-session.php");
            $admin = new Admin();
            $admin->setName($name);
            $admin->setCuil($cuil);
            $this->adminDAO->Add($admin);
            $this->ShowAdminView();
        }

        public function Modify($id, $name, $cuil){
            
            require_once(VIEWS_PATH."validate-session.php");
            $admin = new Admin();
           $admin= $this->adminDAO->searchId($id);
            
           if($admin==NULL){
            $this->ShowAdminView();

            echo "<center><H3> 'Id no existe' </center></H3>";
           }
           else{
            $this->adminDAO->Remove($id);
          
            $admin->setName($name); 
            $admin->setCuil($cuil); 
         
             $this->adminDAO->Edit($admin);
             $this->ShowAdminView();
             
            }

        }




        public function Remove($id)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->companyDAO->Remove($id);

            $this->ShowAdminView();
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


    }
?>