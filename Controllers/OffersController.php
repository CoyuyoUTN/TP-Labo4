<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\StudentDAO as StudentDAO;

    class OffersController{
        private $jobOffersDAO;
        private $companyDAO;
        private $jobPositionDAO;
        private $StudentDAO;

        public function __construct()
        {
            $this->jobOffersDAO = new JobOfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->jobPositionDAO = JobPositionDAO::getInstance();
            $this->StudentDAO= new StudentDAO();
        }

        public function ShowAll($id=null,$description=null,$company=null,$position=null){
            $offers = $this->jobOffersDAO->GetAll($id,$description,$company,$position);

            require_once(VIEWS_PATH."offersList.php");
        }

        public function AddForm($id=NULL){
            $company="Elija compañia";

            if($id != null){
                $company=$this->companyDAO->read($id)->getName();
            }

            require_once(VIEWS_PATH."offersNew.php");
        }

        public function AddOffer($position,$description,$companyId){
            if($companyId=="" || $companyId==NULL){
                $this->AddForm();
            }else{
                $this->jobOffersDAO->Add($description,$companyId,$position);
                $this->ShowAll();
            }
        }


public function ShowOffersList(){
    $offersList=null;
        if (isset($_GET['search'])) {
            
            $description = $_GET['search'];
            var_dump($description);
            $offersList = $this->jobOffersDAO->buscarDescription($description);
           
        } else {
            $offersList = $this->jobOffersDAO->GetAll();
        }
        if ($offersList==null){
            ?> <script language="javascript">
                        alert("Empresa no encontrada");
                        
                    </script>
                <?php
               
        }
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "offersList.php");
}

        public function ShowJobPositionList()
    {   
        $id=$_SESSION["loggedUser"]->getStudentId();
        
       
        $careerId= $this->StudentDAO->getCareerIdForStudent($id);
      
        if($careerId != null){

           $listJobsPosition= $this->jobPositionDAO->getJobsPositionsForCareerId($careerId);
           $offersList=$this->jobOffersDAO->getJobOfferByPositionId($listJobsPosition);
           require_once(VIEWS_PATH."offersList.php");
         }
        else{
            echo "todo mal";
            
        }


      /*  require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "studentJobPositionList.php");*/
    
    }


    public function postularse($data){
        require_once(VIEWS_PATH . "validate-session.php");
      $idStudent =  $_SESSION["loggedUser"]->getDbId();
         $this->jobOffersDAO->postularse($idStudent, $data);
         ?> <script language="javascript">
         alert("Postulado con exito");
         
     </script>
 <?php
     $this->ShowJobPositionList();



    }










    }
?>