<?php

namespace Controllers;

use DAO\JobOfferDAO as JobOfferDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\StudentDAO as StudentDAO;

class OffersController
{
    private $jobOffersDAO;
    private $companyDAO;
    private $jobPositionDAO;
    private $StudentDAO;

    public function __construct()
    {
        $this->jobOffersDAO = new JobOfferDAO();
        $this->companyDAO = new CompanyDAO();
        $this->jobPositionDAO = JobPositionDAO::getInstance();
        $this->StudentDAO = new StudentDAO();
    }

    public function ShowAll($id = null, $description = null, $company = null, $position = null)
    {
        $offersList = $this->jobOffersDAO->GetAll($id, $description, $company, $position);
        $reset = false;

        if ($id != null || $description != null || $company != null || $position != null) {
            $reset = true;
        }

        require_once(VIEWS_PATH . "offersList.php");
    }

    public function CarreerOffers($careerId)
    {
        $jobPosition = $this->jobPositionDAO->getByCareerId($careerId);

        $this->ShowAll(null, null, null, $jobPosition);
    }

    public function AddForm($id = NULL)
    {
        $company = "Elija compañia";

        if ($id != null) {
            $company = $this->companyDAO->read($id)->getName();
        }

        $positionList = $this->jobPositionDAO->getAll();

        require_once(VIEWS_PATH . "offersNew.php");
    }

    public function AddOffer($position, $description, $companyId)
    {
        if ($companyId == "" || $companyId == NULL) {
            $this->AddForm();
        } else {
            $this->jobOffersDAO->Add($description, $companyId, $position);
            $this->ShowAll();
        }
    }

    public function ShowJobPositionList()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        $id = $_SESSION["loggedUser"]->getStudentId();


        $careerId = $this->StudentDAO->getCareerIdForStudent($id);



        $listJobsPosition = $this->jobPositionDAO->getByCareerId($careerId);
        $offersList = $this->jobOffersDAO->getJobOfferByPositionId($listJobsPosition);
        $nameCompanyList = $this->companyDAO->getNameCompanyForId($offersList); //ACA

        require_once(VIEWS_PATH . "offersList.php");
    }


    public function Postularse($data)
    {
        echo "WAWAWA";
        require_once(VIEWS_PATH . "validate-session.php");
        $idStudent =  $_SESSION["loggedUser"]->getDbId();



        if ($this->jobOffersDAO->verificarPostulacionExists($idStudent, $data) == null) {

            $this->jobOffersDAO->postularse($idStudent, $data);

            ?>
            <script language="javascript">
                alert("Postulado con exito");
            </script>
            <?php

            header("Location: ../Offers/ShowAll");
        } else {
            ?>
            <script language="javascript">
                alert("Error!, ya se encuentra postulado");
            </script>
            <?php
            
            header("Location: ../Offers/ShowAll");
        }
    }

    public function showAllOffers()
    {

        $offersList = $this->jobOffersDAO->readAll();

        if ($offersList != null) {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "offersList.php");
        } else {
        ?> <script language="javascript">
                alert("Error!, no se encuentran ofertas disponibles");
            </script>
            <?php
            require_once(VIEWS_PATH . "student-info.php");
        }
    }




    /* public function showMisPostulaciones()
    {


        require_once(VIEWS_PATH . "validate-session.php");
        $idStudent =  $_SESSION["loggedUser"]->getDbId();
        $idList = $this->jobOffersDAO->misPostulaciones($idStudent);

        if ($idList != null) {
            $DescrptionList =   $this->jobOffersDAO->getDescrptionPostulaciones($idList);
            if ($DescrptionList != null) {

                require_once(VIEWS_PATH . "misPostulaciones.php");
            } else {
            ?> <script language="javascript">
                    alert("Error!, no se encuentran postulaciones");
                </script>
            <?php
                $this->ShowOffersList();
            }
        } else {

            ?> <script language="javascript">
                alert("Error!, no se encuentran postulaciones");
            </script>
<?php
            $this->ShowOffersList();
        }
    }*/

    public function EditOffer(){
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "JobOfferModify.php");
      
    }

    public function jobOfferModify($id, $Description, $companyId, $jobPositionId, $active )
    {

        
        $jobOffer = $this->jobOffersDAO->read($id);
       
        if ($jobOffer == NULL) {
        ?>
        <script language="javascript">
            alert("Id no existe");
        </script>
        <?php
            header("Location: ../Offers/ShowAll");

           
        } else {
            
            if($id != null){
            $jobOffer->setId($id);
            }
            if($Description!=null){
            $jobOffer->setDescription($Description);
            }
            if($companyId!=null){
                $jobOffer->setCompanyId($companyId);
            }
            if($jobPositionId!=null){
                $jobOffer->setJobPositionId($jobPositionId);
            }
            if($active!=null){
                $jobOffer->setActive($active);
            }
           
            

            $this->jobOffersDAO->update($jobOffer);
            header("Location: ../Offers/ShowAll");
        }
    }














}
?>