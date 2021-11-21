<?php

use DAO\NavDAO as NavDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;

NavDAO::getNav();
require_once("validate-session.php");
if (isset($_SERVER["HTTP_REFERER"])) {
    $back = $_SERVER["HTTP_REFERER"];
} else {
    $back = NULL;
}

$companyDao = new CompanyDAO;
$jobPositionDao = JobPositionDAO::getInstance();

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Ofertas</h2>
         
            <br />
            <form action="<?php echo FRONT_ROOT . $action ?>" method="">
                <table class="table bg-light-alpha" border="3">
                    <thead>
                        <th>
                            <?php echo "ID" ?>

                        </th>
                        <th>
                            <?php echo "Descripcion" ?>

                        </th>
                    
                        <th>
                            <?php echo "Compañia" ?>

                        </th>
                        <th>
                            <?php echo "Posicion" ?>

                        </th>
                     
                     
                    
                    </thead>
                    <tbody>
                        <?php
                        for ( $i=0; $i<count($offersList);$i++) {
                        ?>
                            <tr>
                                <td><?php echo $offersList[$i]->getId(); ?></td>
                                <td><?php echo $offersList[$i]->getDescription(); ?></td>
                                <td><?php echo $companyDao->read($offersList[$i]->getCompanyId())->getName(); ?></td>
                                <td><?php echo $jobPositionDao->getById($offersList[$i]->getJobPositionId())->getDescription(); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </section>
</main>