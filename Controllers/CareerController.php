<?php
    namespace Controllers;

    use DAO\CareerDao as CareerDao;
    use Models\Career as Career;

    class CareerController
    {
        private $careerDAO;

        public function __construct()
        {
            $this->careerDAO = new CareerDao();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."careerADD.php");
        }

        public function ShowListView()
        {
            $careerList = $this->careerDAO->GetAll();

            require_once(VIEWS_PATH."careerList.php");
        }

        public function Add($careerId, $description, $active)
        {
            $career = new Career($careerId, $description, $active);
            $career->setCareerId($careerId);
            $career->setDescription($description);
            $career->setActive($active);

            $this->CareerDao->Add($career);

            $this->ShowAddView();
        }
    }
?>