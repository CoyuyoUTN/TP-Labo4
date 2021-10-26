<?php
    require_once('navADMIN.php');
    require_once("validate-session.php");

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
                            <label for="cuil">Cuil</label>
                            <input type="text" name="cuil" id="cuil" class="form-control" required>
                        </div>
                    </div>
                    <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;"/>
                </div>
               
               
            </form>
        </div>
    </section>
</main>
