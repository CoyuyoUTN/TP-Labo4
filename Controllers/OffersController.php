<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\JobPositionDAO as JobPositionDAO;

    class OffersController{
        private $jobOffersDao;
        private $companyDao;
        private $jobPositionDao;

        public function __construct()
        {
            $this->jobOffersDao = new JobOfferDAO();
            $this->companyDao = new CompanyDAO();
            $this->jobPositionDao = JobPositionDAO::getInstance();
        }

        public function ShowAll($id=null,$description=null,$company=null,$position=null){
            $offers = $this->jobOffersDao->GetAll($id,$description,$company,$position);

            require_once(VIEWS_PATH."offersList.php");
        }

        public function AddForm($id=NULL){
            $company="Elija compañia";

            if($id != null){
                $company=$this->companyDao->read($id)->getName();
            }

            require_once(VIEWS_PATH."offersNew.php");
        }

        public function AddOffer($position,$description,$companyId){
            if($companyId=="" || $companyId==NULL){
                $this->AddForm();
            }else{
                $this->jobOffersDao->Add($description,$companyId,$position);
                $this->ShowAll();
            }
        }
    }
?>