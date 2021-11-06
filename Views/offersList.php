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
 if(get_class($_SESSION["loggedUser"]) == 'Models\Admin') {
     
     $action = "Offers/AddOffer";
 }
 else{
     $action="Offers/postularse";
 }

    
 
?>






<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Ofertas</h2>
            <a class="btn btn-default" href="AddForm">Nueva Oferta</a>
            <br /><br />

            <a href="<?= $back ?>">Atras</a>
            <br />
            <form action="<?php echo FRONT_ROOT. "Offers/ShowOffersList" ?>" method="get">
                <input type="search" id="search" name="search" placeholder="Descripcion">
                <button type="submit">Buscar</button>

            </form>

            <form action="<?php echo FRONT_ROOT. "Offers/showAllOffers" ?>" method="get">

                <button type="submit">Mostrar todas las ofertas</button>
          </form>
                <form action="<?php echo FRONT_ROOT . $action ?>" method="">



                    <br />
                    <br />

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
                            <th>
                                <?php echo "Postularse" ?>

                            </th>
                        </thead>
                        <tbody>
                            <?php
                              foreach ($offersList as $offer) {
                              ?>
                            <tr>
                                <td><?php echo $offer->getId(); ?></td>
                                <td><?php echo $offer->getDescription(); ?></td>
                                <td><?php echo $offer->getCompanyId(); ?></td>
                                <td><?php echo $offer->getJobPositionId(); ?></td>
                                <td>
                                    <button type="submit" id="see-more" name="data"
                                        value="<?php echo $offer->getJobPositionId(); ?>">Postularse</button>
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