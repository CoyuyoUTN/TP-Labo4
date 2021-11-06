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

        public function ShowAll(){
            $adminList=null;
            if (isset($_GET['search'])) {
                $adminList = $this->adminDAO->buscarEmail($_GET['search']);
               
            } else {
                $adminList = $this->adminDAO->readAll();
            }
            if ($adminList==null){
                ?> <script language="javascript">
                            alert("Admin no encontrado");
                            
                        </script>
                    <?php
                   
            }
            require_once(VIEWS_PATH . "validate-session.php");
            
            

            require_once(VIEWS_PATH."adminList.php");
        }



        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."adminADD.php");
        }

        public function showModifyView(){
            
         
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."companyModify.php");
            
        }


        public function addADMIN($email,$password,$name){

            if($this->adminDAO->VerificarAdminExsist($email) != null){

                ?> <script language="javascript">alert("Usuario ya existente");</script>
                <?php
                require_once(VIEWS_PATH."adminADD.php");

            }
            else{

            require_once(VIEWS_PATH."validate-session.php");
            $admin= new Admin($email,$password,$name);
            $this->adminDAO->create($admin);
            ?> <script language="javascript">alert("Usuario creado con exito");</script>
            <?php
            require_once(VIEWS_PATH."adminADD.php");
            }


            
        }















    }
?>