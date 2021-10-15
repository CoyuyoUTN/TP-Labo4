<?php

     include("nav.php");
     require_once("validate-session.php");

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de empresas</h2>
           
                <table class="table bg-light-alpha" border="3">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>CUIL</th>

                    </thead>
                    <tbody>
                        <?php
                              foreach($companyList as $company)
                              {
                                   ?>
                        <tr>
                            <td><?php echo $company->getId() ?></td>
                            <td><?php echo $company->getName() ?></td>
                            <td><?php echo $company->getCuil() ?></td>


                        </tr>
                            
                        <?php
                              }
                         ?>
                        </tr>
                        
                    </tbody>
                    <a href="<?=$_SERVER["HTTP_REFERER"]?>">Atras</a>
                    <input type="search" id="search" name="search">
                    <a href="<?=  echo FRONT_ROOT."Home/ShowCompanyListStudent"?>">BUSCAR</a>

                </table>
              
           
        </div>
    </section>
</main>