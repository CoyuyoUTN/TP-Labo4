<?php
    require_once('navADMIN.php');
    require_once("validate-session.php");
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modificar empresa</h2>
            <form action="<?php  echo FRONT_ROOT?>Company/Modify" method="post" class="bg-light-alpha p-5">




                <div class="row">
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="id">Id empresa</label>
                            <input type="number" name="id" id="id" min="1" max="9999" class="form-control" required>
                        </div>
                        
                    </div>
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
                    <input type="submit" class="btn" value="Modificar" style="background-color:#DC8E47;color:white;"/>
                </div>
               
               
            </form>
        </div>
    </section>
</main>