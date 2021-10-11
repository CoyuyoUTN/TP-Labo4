<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController
    {
        private $companyDAO;
        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }


        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."companyADD.php");
        }

        public function ShowListView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."companyList.php");
        }

        public function Add($name, $cuil)
        {
            require_once(VIEWS_PATH."validate-session.php");
            $company = new Company();
            $company->setName($name);
            $company->setCuil($cuil);
            $this->companyDAO->Add($company);
            $this->ShowAdminView();
        }



        public function Remove($name)
        {
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->companyDAO->Remove($name);

            $this->ShowAdminView();
        }

        public function ShowAdminView() 
        {
           
            $companyList=$this->companyDAO->GetAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."companyList.php");
        }


        public function showModifyView($name){
            
           $bool=$this->companyDAO->searchName($name);
            if($bool==NULL){
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."CompanyModificar.php");
            }
            else{
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH."companyADD.php");
            }



        }

    }
?>