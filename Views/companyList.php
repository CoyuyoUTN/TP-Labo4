<?php
use DAO\NavDAO as NavDAO;
NavDAO::getNav();
NavDAO::getTableNav('Company');
if (isset($_SERVER["HTTP_REFERER"])) {
    $back = $_SERVER["HTTP_REFERER"];
} else {
    $back = NULL;
}
require_once("validate-session.php");
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de empresas</h2>
            <a href="<?= $back ?>">Atras</a>
            <form action="<?php echo FRONT_ROOT. "Company/ShowListView" ?>" method="get">
                <input type="search" id="search" name="search">
                <button type="submit">Buscar</button>
            </form>
            <form action="<?php echo FRONT_ROOT . $onAction ?>" method="post">
                <table class="table bg-light-alpha" border="3">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>CUIL</th>
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
                                <button type="submit" class="btn" name="id" value="<?php echo $company->getId() ?>"><?php echo $actionName ?></button>
                                </td>
                                <td>
                                    <a class="btn btn-default" href="../Home/ShowFullData?data=<?php echo $company->getId() ?>" >Mostrar</a>
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