<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use DAO\JobOfferDAO as JobOfferDAO;

class CompanyController
{
    private $companyDAO;
    private $jobOffersDAO;
    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
        $this->jobOffersDAO = new JobOfferDAO();
    }


    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "companyADD.php");
    }

    public function ShowListView($onAction = "Company/Remove",$actionName = "Eliminar")
    {
        $companyList=null;
        if (isset($_GET['search'])) {
            $search=$_GET['search'];
            $companyList = $this->companyDAO->buscarNombre($search);
           
        } else {
            $companyList = $this->companyDAO->readAll();
        }
        if ($companyList==null){
            ?> <script language="javascript">
                        alert("Empresa no encontrada");
                        
                    </script>
                <?php
               
        }

       
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "companyList.php");
    }
    
       /**
         * Funcion utilizada para agregar una Company en la Base de Datos
         */
    public function Add($name, $cuil, $shortDesc = null, $ranking = null, $email = null, $phone = null, $city = null, $address = null, $jobOffers = null, $linkedin = null, $webpage = null, $facebook = null, $img = null, $bio = null)
    {
        require_once(VIEWS_PATH . "validate-session.php");

            $companyList=$this->companyDAO->verificarSiExisteEmpresa($name);
            $boolExist=$this->companyDAO->VerificarCuilExist($cuil);

            if($boolExist !=null){

                ?> <script language="javascript">
                alert("Cuil ya existente");
                </script>
                <?php
                 $this->ShowListView();
            }



            if($companyList==null){
        
            $company = new Company($name, $cuil, $img, $shortDesc, $ranking, $email, $phone, $city, $address, $jobOffers, $bio, $linkedin, $webpage, $facebook);
            
            $this->companyDAO->create($company);

            $this->ShowAdminView();
            }
            else{
               
                ?> <script language="javascript">
alert("Empresa ya existente");
</script>
<?php
        
        $this->ShowListView();
               
            }
    }
     /**
         * Funcion utilizada para modificar una Company en la Base de Datos
         */
    public function Modify($id, $name, $cuil, $shortDesc = null, $ranking = null, $email = null, $phone = null, $city = null, $address = null, $jobOffers = null, $linkedin = null, $webpage = null, $facebook = null, $img = null, $bio = null)
    {

        require_once(VIEWS_PATH . "validate-session.php");


        $boolExist=$this->companyDAO->VerificarCuilExist($cuil);

        $companyList=$this->companyDAO->verificarSiExisteEmpresa($name);

        if($companyList!=null){
            ?> <script language="javascript">
            alert("Empresa ya existente");
            </script>
            <?php
                    
                    $this->ShowListView();
        }

        if($boolExist !=null){

            ?> <script language="javascript">
                alert("Cuil ya existente");
                </script>
                <?php
                 $this->ShowListView();
        }


        $company = $this->companyDAO->read($id);
       
        if ($company == NULL) {
            $this->ShowAdminView();

            echo "<center><H3> 'Id no existe' </center></H3>";
        } else {
            
            if($name!=null){
            $company->setName($name);
            }
            if($cuil!=null){
            $company->setCuil($cuil);
            }
            if($shortDesc!=null){
                $company->setShortDesc($shortDesc);
            }
            if($ranking!=null){
                $company->setRanking($ranking);
            }
            if($email!=null){
                $company->setEmail($email);
            }
            if($phone!=null){
                $company->setPhone($phone);
            }
            if($city!=null){
                $company->setCity($city);
            }
            if($address!=null){
                $company->setAddress($address);
            }
            if($jobOffers!=null){
                $company->setJobOffers($jobOffers);
            }
            if($shortDesc!=null){
                $company->setShortDesc($shortDesc);
            }
            if($linkedin!=null){
                $company->setLinkedin($linkedin);
            }
            if($webpage!=null){
                $company->setWebpage($webpage);
            }
            if($facebook!=null){
                $company->setFacebook($facebook);
            }
            if($img!=null){
                $company->setImg($img);
            }
            if($bio!=null){
                $company->setBio($bio);
            }
            

            $this->companyDAO->update($company);
            $this->ShowAdminView();
        }
    }


   /**
         * Funcion utilizada para eliminar una Company en la Base de Datos
         */

    public function Remove($id)
    {
        require_once(VIEWS_PATH . "validate-session.php");

        $this->companyDAO->delete($id);

        $this->ShowAdminView();
    }

    public function ShowAdminView()
    {
        header("Location: ../Company/ShowListView");
    }


    public function showModifyView()
    {


        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "companyModify.php");
    }



    public function ShowAllOfersForCompany($id = null, $description = null, $company = null, $position = null)
    {
        $offersList = $this->jobOffersDAO->GetAll($id, $description, $company, $position);

        require_once(VIEWS_PATH . "offerListCompany.php");
    }
}