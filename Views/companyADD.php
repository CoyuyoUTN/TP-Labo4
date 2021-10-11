<?php
    require_once('navADMIN.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar empresa</h2>
            <form action="<?php  echo FRONT_ROOT?>Company/Add" method="post" class="bg-light-alpha p-5">




                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Cuil</label>
                            <input type="text" name="cuil" id="cuil" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>