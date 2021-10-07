<?php
     include('header.php');
     include('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de estudiantes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Legajo</th>
                         <th>Id Carrera</th>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>Dni</th>
                         <th>File Number</th>
                         <th>Genero</th>
                         <th>Fecha de nacimiento</th>
                         <th>Email</th>
                         <th>Numero Telefonico</th>
                         <th>Activo</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($studentList as $student)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $student->getStudentId() ?></td>
                                             <td><?php echo $student->getCareerId() ?></td>
                                             <td><?php echo $student->getFirstName() ?></td>
                                             <td><?php echo $student->getLastName() ?></td>
                                             <td><?php echo $student->getDni() ?></td>
                                             <td><?php echo $student->getFileNumber() ?></td>
                                             <td><?php echo $student->getGender() ?></td>
                                             <td><?php echo $student->getBirthDate() ?></td>
                                             <td><?php echo $student->getEmail() ?></td>
                                             <td><?php echo $student->getPhoneNumber() ?></td>
                                             <td><?php echo $student->getActive() ?></td>
                                             
                                             
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
<?php 
  include('footer.php');
?>