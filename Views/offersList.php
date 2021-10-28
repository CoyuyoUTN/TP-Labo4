<?php

    include('nav.php');
    require_once("validate-session.php");

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Ofertas</h2>
               <form action="<?php echo FRONT_ROOT."Home/ShowListView" ?>"  method="">
               <table class="table bg-light-alpha" border="3">
                    <thead>
                        <th>ID</th>
                        <th>Descripcion</th>
                        <th>Compañia</th>
                        <th>Posicion</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($offers as $offer)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $offer->getId() ?></td>
                                             <td><?php echo $offer->getDescription() ?></td>
                                             <td><?php echo $offer->getCompanyId() ?></td>
                                             <td><?php echo $offer->getJobPosition()->getDescription() ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table></form>
          </div>
     </section>
</main>