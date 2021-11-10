<?php

use DAO\NavDAO as NavDAO;

NavDAO::getNav();
require_once("validate-session.php");
if (isset($_SERVER["HTTP_REFERER"])) {
    $back = $_SERVER["HTTP_REFERER"];
} else {
    $back = NULL;
}

$action = null;
$actionName = null;

if (get_class($_SESSION["loggedUser"]) == 'Models\Admin') {

    $action = "Offers/EditOffer";
    $actionName = "Editar";
} else {
    $action = "Offers/Postularse";
    $actionName = "Postularse";
}



?>


<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Ofertas</h2>
            <?php if(get_class($_SESSION["loggedUser"]) == 'Models\Admin'){ ?>
                <a class="btn btn-default" href="AddForm">Nueva Oferta</a>
            <?php } ?>
            <br /><br />

            <a href="<?= $back ?>">Atras</a>
            <br />

            <form action="<?php echo FRONT_ROOT . "Offers/ShowOffersList" ?>" method="get">
                <input type="search" id="search" name="search" placeholder="Descripcion">
                <button type="submit">Buscar</button>   
            </form>
            <br />
            
            <?php if(get_class($_SESSION["loggedUser"]) == 'Models\Admin'){ ?>
         
            <form action="<?php echo FRONT_ROOT . "Offers/ShowSubidaCurriculum" ?>" method="post" enctype="multipart/form-data">
		    <input type="file" name="curriculum">
		    <br><br>
		    <button>Subir Curriculum</button>
            <br />
	        </form>
            <?php } ?>
            <br /><br />
           
            
            
            <form action="<?php echo FRONT_ROOT . "Offers/showAllOffers" ?>" method="get">

                <button type="submit">Mostrar todas las ofertas</button>
            </form>
            <br />
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
                            <?php echo "CompañiaId" ?>

                        </th>
                        <th>
                            <?php echo "Posicion" ?>

                        </th>
                     
                        <th>
                            <?php echo "Postularse" ?>

                        </th>
                    </thead>
                    <tbody>
                        <?php
                        for ( $i=0; $i<count($offersList);$i++) {
                        ?>
                            <tr>
                                <td><?php echo $offersList[$i]->getId(); ?></td>
                                <td><?php echo $offersList[$i]->getDescription(); ?></td>
                                <td><?php echo $offersList[$i]->getCompanyId(); ?></td>
                                <td><?php echo $offersList[$i]->getJobPositionId(); ?></td>
                                
                                <td>
                                    <button type="submit" id="see-more" name="data" value="<?php echo $offersList[$i]->getId(); ?>"><?php echo $actionName ?></button>
                                </td>
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