<?php

use DAO\NavDAO as NavDAO;

NavDAO::getNav();
require_once("validate-session.php");
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Ofertas</h2>
            <form action="<?php echo FRONT_ROOT . "Offers/AddOffer" ?>" method="">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="company">Compañia: </label>
                        <a class="btn btn-default" name="company" href="../Company/ShowListView"><?php echo $company ?></a>
                    </div>
                    <div class="col-lg-12">
                        <label for="position">Puesto: </label>
                        <select name="position" id="position">
                            <?php
                            foreach ($positionList as $position) {
                            ?>
                                <option value="<?php echo $position->getJobPositionId() ?>"><?php echo $position->getDescription() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label for="description">Descripcion</label>
                        <textarea id="description" name="description" rows="4" cols="50" class="form-control"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn" name="companyId" value="<?php echo $id ?>" style="background-color:#DC8E47;color:white;" >Enviar</button>
            </form>
        </div>
    </section>
</main>