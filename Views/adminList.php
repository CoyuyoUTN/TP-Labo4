<?php

    include('navADMIN.php');
    require_once("validate-session.php");

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Admins</h2>
               <form action="<?php echo FRONT_ROOT."Admin/ShowAll" ?>"  method="">

               <button type=submit >Buscar</button>

               <br />
               <br />
               
               <table class="table bg-light-alpha" border="3">
                    <thead>
                        <th>
                              ID
                              <input class="form-control" type="text" id="id" name="id">
                         </th>
                        <th>
                             Email
                             <input class="form-control" type="text" id="description" name="description">
                         </th>
                        <th>
                             Password
                             <input class="form-control" type="text" id="company" name="company">
                         </th>
                        <th>
                            Name
                             <input class="form-control" type="text" id="position" name="position">
                         </th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($admins as $admin)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $admin->getId() ?></td>
                                             <td><?php echo $admin->getEmail() ?></td>
                                             <td><?php echo $admin->getPassword() ?></td>
                                             <td><?php echo $admin->getName()->getDescription() ?></td>
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