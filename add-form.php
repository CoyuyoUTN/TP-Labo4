<?php
     include('header.php');
     include('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <form>
               <div class="container">
                    <h3 class="mb-3">Agregar Canción</h3>
                    
                    <div class="mb-3">
                         <label for="">Id</label>
                         <input type="number" name="" class="form-control form-control-ml" required value="">
                    </div>

                    <div class="mb-3">
                         <label for="">Nombre</label>
                         <input type="text" name="" class="form-control form-control-ml" required value="">
                    </div>

                    <div class="mb-3" >
                         <label for="">Artista</label>

                         <div class="form-group">
                              <select name="" class="custom-select" required>
                                   <option value="">Artista</option>
                                   <option value="">Artista</option>
                                   <option value="">Artista</option>
                              </select>
                         </div>
                    </div>

                    <div class="mb-3">
                         <label for="">Año</label>
                         <input type="number" name="" class="form-control form-control-ml" required value="">
                    </div>

                    <div class="mb-3">
                         <button type="submit" name="" class="btn btn-primary ml-auto d-block">Agregar</button>
                    </div>
               </div>
          </form>
     </section>
</main>

<?php include('footer.php'); ?>
