<?php

     include('nav.php');
     require_once("validate-session.php");
    var_dump($student);
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de estudiantes</h2>
               <form action="<?php echo FRONT_ROOT."Home/ShowListView" ?>"  method="get">
               <table class="table bg-light-alpha" border="3">
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
                     
                         </tr>
                    </tbody>
               </table></form>
          </div>
     </section>
</main>
