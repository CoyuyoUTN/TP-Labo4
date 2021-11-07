<?php
require_once('navADMIN.php');
require_once("validate-session.php");
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modificar Oferta Laboral</h2>
            <form action="<?php echo FRONT_ROOT ?>Offers/jobOfferModify" method="post" class="bg-light-alpha p-5">




                <div class="row">
                <div class="col-lg-4">
                        <div class="form-group">
                            <label for="id">Id</label>
                            <input type="number" name="id" id="id" min="1" max="9999" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" name="Description" id="Description" class="form-control" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="companyId">CompanyId</label>
                            <input type="number" name="companyId" id="companyId" min="1" max="9999" class="form-control" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="jobPositionId">JobPositionId</label>
                            <input type="number" name="jobPositionId" id="jobPositionId" min="1" max="9999" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="active">Activar o eliminar 1/0</label>
                            <input type="number" name="active" id="active" min="0" max="1" class="form-control" required >
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn" value="Modificar" style="background-color:#DC8E47;color:white;" />
            </form>
        </div>
    </section>
</main>