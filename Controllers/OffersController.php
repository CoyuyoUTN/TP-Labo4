<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;

    class OffersController{
        private $jobOffersDao;

        public function __construct()
        {
            $this->jobOffersDao = new JobOfferDAO();
        }

        public function ShowAll(){
            $offers = $this->jobOffersDao->GetAll();

            require_once(VIEWS_PATH."offersList.php");
        }
    }
?>