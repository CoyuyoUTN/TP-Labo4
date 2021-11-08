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

            if($aplicantList !=null){

            $listaDatosReales=$this->aplicantDAO->datosRealesPorId($aplicantList);
            require_once(VIEWS_PATH . "aplicantList.php");
            }
            else{

                ?> <script language="javascript">
                alert("No hay postulaciones");
                
            </script>
        <?php
         require_once(VIEWS_PATH."adminList.php");

            }

        }

















    }

    ?>