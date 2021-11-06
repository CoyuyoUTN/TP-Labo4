<?php

use DAO\NavDAO as NavDAO;

NavDAO::getNav();
require_once("validate-session.php");
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Ofertas</h2>
               <a class="btn btn-default" href="AddForm" >Nueva Oferta</a>
               <br /><br />
               <form action="<?php echo FRONT_ROOT . "Offers/ShowAll" ?>" method="">

                    <button type=submit autofocus >Buscar</button>

                    <br />
                    <br />

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
                         </thead>
                         <tbody>
                              <?php
                              foreach ($offers as $offer) {
                              ?>
                                   <tr>
                                        <td><?php echo $offer->getId() ?></td>
                                        <td><?php echo $offer->getDescription() ?></td>
                                        <td><?php echo $this->companyDao->read($offer->getCompanyId())->getName() ?></td>
                                        <td><?php echo $offer->getJobPosition()->getDescription() ?></td>
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