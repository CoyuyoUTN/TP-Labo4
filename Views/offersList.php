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
    $action = "EditOffer";
    $actionName = "Editar";
} else {
    $action = "Postularse";
    $actionName = "Postularse";
}

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Ofertas</h2>
            <?php if (get_class($_SESSION["loggedUser"]) == 'Models\Admin') { ?>
                <a class="btn btn-default" href="AddForm">Nueva Oferta</a>
            <?php } ?>
            <br /><br />

            <a href="<?= $back ?>">Atras</a>
            <br />
            <?php
                if($reset){
            ?>
                    <a class="btn btn-default" href="../Offers/ShowAll">Mostrar Todos</a>
            <?php
                }
            ?>
            <!-- <form action="<?php echo FRONT_ROOT . "Offers/ShowOffersList" ?>" method="get">
                <input type="search" id="search" name="search" placeholder="Descripcion">
                <button type="submit">Buscar</button>

            </form>

            <form action="<?php echo FRONT_ROOT . "Offers/showAllOffers" ?>" method="get">

                <button type="submit">Mostrar todas las ofertas</button>
            </form> 
            <br />
            <br />-->
            <form action="<?php echo FRONT_ROOT . 'Offers/ShowAll' ?>" method="">
                <table class="table bg-light-alpha" border="3">
                    <thead>
                        <th>
                            ID
                            <input class="form-control" type="text" id="id" name="id">
                        </th>
                        <th>
                            Descripcion
                            <input class="form-control" type="text" id="description" name="description">
                        </th>
                        <th>
                            Compañia
                            <input class="form-control" type="text" id="company" name="company">
                        </th>
                        <th>
                            Posicion
                            <input class="form-control" type="text" id="position" name="position">
                        </th>
                        <!-- <th>

                        </th> -->
                    </thead>
                    <tbody>
                        <?php
                        foreach ($offersList as $offer) {
                        ?>
                            <tr>
                                <td><?php echo $offer->getId(); ?></td>
                                <td><?php echo $offer->getDescription(); ?></td>
                                <td><?php echo $offer->getCompany()->getName(); ?></td>
                                <td><?php echo $offer->getJobPosition()->getDescription(); ?></td>
                                <td>
                                    <!--<button type="submit" id="see-more" name="data" value="<?php echo $offer->getId(); ?>"><?php echo $actionName ?></button>-->
                                    <a class="btn btn-default" href="<?php echo "../Offers/".$action."?data=". $offer->getId()?>"><?php echo $actionName ?></a>
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