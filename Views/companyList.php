<?php

     include("navADMIN.php");
     require_once("validate-session.php");

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de empresas</h2>
            <form action="<?php echo FRONT_ROOT."Company/Remove" ?>" method="post">
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

                            <td>
                                <button type="submit" class="btn" name="id" value="<?php echo $company->getId() ?>">
                                    Remove </button>


                            </td>

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