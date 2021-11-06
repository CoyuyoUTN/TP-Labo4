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
               <h2 class="mb-4">Listado de Admins</h2>
              
               <form action="<?php echo FRONT_ROOT ."Admin/ShowAll" ?>" method="get">
                <input type="search" id="search" name="search">
                <button type="submit">Buscar</button>
            
               <br />
               
               <table class="table bg-light-alpha" border="3">
               <thead>
                        <th>
                        <?php echo "Id" ?>
                              
                         </th>
                        <th>
                        <?php echo "Email" ?>
                         </th>
                        <th>
                        <?php echo "Password" ?>
                         </th>
                        <th>
                        <?php echo "Name" ?>
                         </th>
                         <th>
                         <?php echo "Active" ?>
                             
                         </th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($adminList as $admin)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $admin->getId() ?></td>
                                             <td><?php echo $admin->getEmail() ?></td>
                                             <td><?php echo $admin->getPassword() ?></td>
                                             <td><?php echo $admin->getName() ?></td>
                                             <td><?php echo $admin->getActive() ?></td>

                                             
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