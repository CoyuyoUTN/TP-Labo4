<?php
require_once('navADMIN.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar alumno</h2>
            <form action= "StudentDAO/toDataBase" method="get" class="bg-light-alpha p-5">
             <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Id estudiante</label>
                            <input type="text" name="StudentId" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" value="" class="form-control">
                        </div>
                    </div>

                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>