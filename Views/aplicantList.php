<?php
use DAO\NavDAO as NavDAO;
NavDAO::getNav();
NavDAO::getTableNav1('Admin');
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
               <h2 class="mb-4">Listado de Postulaciones</h2>
              
               <?php /*<form action="<?php echo FRONT_ROOT ."Aplicant/showAllPostulations" ?>" method="get">
                <input type="search" id="search" name="search">
                <button type="submit">Buscar</button> */?>
            
               <br />
               
               <table class="table bg-light-alpha" border="3">
               <thead>
                        <th>
                        <?php echo "Legajo" ?>
                              
                         </th>
                        <th>
                        <?php echo "Nombre Oferta" ?>
                         </th>
                        <th>
                        <?php echo "Fecha" ?>
                         </th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($listaDatosReales as $aplicant)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $aplicant->getStudentId() ?></td>
                                             <td><?php echo $aplicant->getJobOfferId() ?></td>
                                             <td><?php echo $aplicant->getDate() ?></td>
                                         
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table></form>
               <a href="<?= $back ?>">Atras</a>
            <br />
          </div>
     </section>
</main>