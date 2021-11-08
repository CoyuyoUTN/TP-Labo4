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
            <h2 class="mb-4">Listado de postulaciones</h2>
  
            <a href="<?= $back ?>">Atras</a>
            
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
                                <?php echo "Date" ?>

                            </th>
                        </thead>
                        <tbody>
                            <?php
                              foreach ($DescrptionList as $offer) {
                              ?>
                            <tr>
                                <td><?php echo $offer->getId(); ?></td>
                                <td><?php echo $offer->getDescription(); ?></td>
                                <td><?php echo $offer->getDate(); ?></td>
                            </tr>
                            <?php
                              }
                              ?>
                            </tr>
                        </tbody>
                    </table>
        </div>
    </section>
</main>