<?php
    namespace Controllers;

    use DAO\AplicantDAO as AplicantDAO;
    use Models\Aplicant as Aplicant;
    
   

    class AplicantController
    {
        private $aplicantDAO;
        
        public function __construct()
        {
            $this->aplicantDAO = new AplicantDAO();
        }






        public function showAllPostulations(){

            $aplicantList=$this->aplicantDAO->readAll();
            $listaDatosReales=$this->aplicantDAO->datosRealesPorId($aplicantList);
            require_once(VIEWS_PATH . "aplicantList.php");







        }

















    }

    ?>