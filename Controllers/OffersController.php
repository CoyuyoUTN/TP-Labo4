<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;

    class OffersController{
        private $jobOffersDao;

        public function __construct()
        {
            $this->jobOffersDao = new JobOfferDAO();
        }

        public function ShowAll($id=null,$description=null,$company=null,$position=null){
            $offers = $this->jobOffersDao->GetAll($id,$description,$company,$position);

            require_once(VIEWS_PATH."offersList.php");
        }

        public function AddForm($message=NULL){
            require_once(VIEWS_PATH."offersNew.php");
        }
    }
?>