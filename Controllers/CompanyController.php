<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController
    {
        private $companyDAO;



        public function ShowAddView()
        {
            require_once(VIEWS_PATH."companyADD.php");
        }

        public function ShowListView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."companyList.php");
        }

        public function Add($nombre, $cuil)
        {
            $company = new Company($nombre,$cuil);
            $company->setName($nombre);
            $company->setCuil($cuil);
           

            $this->companyDAO->Add($company);

            $this->ShowAddView();
        }
    }
?>