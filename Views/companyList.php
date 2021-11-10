<?php
use DAO\NavDAO as NavDAO;
NavDAO::getNav();
NavDAO::getTableNav('Company');
require_once("validate-session.php");
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de empresas</h2>
            <form action="<?php echo FRONT_ROOT . "Company/ShowListView" ?>" method="">
                <table class="table bg-light-alpha" border="3">
                    <thead>
                        <th>
                            Id
                            <input class="form-control" type="text" id="id" name="id">
                        </th>
                        <th>
                            Name
                            <input class="form-control" type="text" id="name" name="name">
                        </th>
                        <th>
                            CUIL
                            <input class="form-control" type="text" id="cuil" name="cuil">
                        </th>
                        <th>
                            <input type="submit" class="btn" value="Buscar" style="background-color:#DC8E47;color:white;" />
                        </th>
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