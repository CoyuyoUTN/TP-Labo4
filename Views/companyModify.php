<?php
require_once('navADMIN.php');
require_once("validate-session.php");
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modificar empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/Modify" method="post" class="bg-light-alpha p-5">




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
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="shortDesc">Descripcion Corta</label>
                            <input type="text" name="shortDesc" id="shortDesc" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="ranking">Ranking</label>
                            <input type="number" name="ranking" id="ranking" min="1" max="9999" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phone">Telefono</label>
                            <input type="number" name="phone" id="phone" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="city">Ciudad</label>
                            <input type="text" name="city" id="city" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="address">Direccion</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="jobOffers">N° de Trabajos Ofrecidos</label>
                            <input type="number" name="jobOffers" id="jobOffers" min="1" max="9999" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="linkedin">Linkedin</label>
                            <input type="text" name="linkedin" id="linkedin" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="webpage">Pagina Web</label>
                            <input type="text" name="webpage" id="webpage" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="img">Link de Imagen</label>
                            <input type="text" name="img" id="img" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" rows="4" cols="50" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn" value="Modificar" style="background-color:#DC8E47;color:white;" />
            </form>
        </div>
    </section>
</main>