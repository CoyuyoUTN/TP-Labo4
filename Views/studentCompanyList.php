<?php

include("nav.php");
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
            <h2 class="mb-4">Listado de empresas</h2>
            <form action="<?php echo FRONT_ROOT . "Home/ShowFullData" ?>" method="get">

                <table class="table bg-light-alpha" border="3">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>CUIL</th>
                        <th>Ver Mas</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($companyList as $company) {
                        ?>
                            <tr>
                                <td><?php echo $company->getId() ?></td>
                                <td><?php echo $company->getName() ?></td>
                                <td><?php echo $company->getCuil() ?></td>
                                <td>
                                    <button type="submit" id="see-more" name="data" value="<?php echo $company->getId() ?>">Ver Mas</button>
                                </td>

                            </tr>

                        <?php
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </form>
            
            <a href="<?= $back ?>">Atras</a>
            <br />
            <form action="<?php echo FRONT_ROOT . "Home/ShowCompanyListStudent" ?>" method="get">
                <input type="search" id="search" name="search">
                <button type="submit">Buscar</button>
            </form>

        </div>
    </section>
</main>