<?php
    require_once('navADMIN.php');
    require_once("validate-session.php");
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modificar Empresa</h2>
            <form action="<?php  echo FRONT_ROOT?>Company/showModifyView" method="post" class="bg-light-alpha p-5">




                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        
                    </div>
                    <input type="submit" class="btn" name="name" value="Modificar" style="background-color:#DC8E47;color:white;"/>
                </div>
               
               
            </form>
        </div>
    </section>
</main>