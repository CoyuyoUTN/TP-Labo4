<?php

include("nav.php");
require_once("validate-session.php");
if (isset($_SERVER["HTTP_REFERER"])) {
    $back = $_SERVER["HTTP_REFERER"];
} else {
    $back = NULL;
}

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de oferta de posiciones</h2>
            

                <table class="table bg-light-alpha" border="3">
                    <thead>
                        <th>CareerId</th>
                        <th>descripcion</th>
                        
                    </thead>
                    <tbody>
                      
                      <?php
                       
                        foreach ($jobPositionList as $jobPosition) { 
                        ?>
                            <tr>
                                <td><?php echo $jobPosition->getCareerId() ?></td>
                                <td><?php echo $jobPosition->getDescription() ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </form>
            
            <a href="<?= $back ?>">Atras</a>
            <br />
            

        </div>
    </section>
</main>