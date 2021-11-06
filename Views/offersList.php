<?php

use DAO\NavDAO as NavDAO;

NavDAO::getNav();
require_once("validate-session.php");
if (isset($_SERVER["HTTP_REFERER"])) {
     $back = $_SERVER["HTTP_REFERER"];
 } else {
     $back = NULL;
 }
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Ofertas</h2>
               <a class="btn btn-default" href="AddForm" >Nueva Oferta</a>
               <br /><br />
               
            <a href="<?= $back ?>">Atras</a>
            <br />
            <form action="<?php echo FRONT_ROOT. "Offers/ShowOffersList" ?>" method="get">
            <input type="search" id="search" name="search" placeholder="Descripcion">
                <button type="submit">Buscar</button>
            </form>
               <form action="<?php echo FRONT_ROOT . "Offers/AddOffer" ?>" method="">

                   

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