<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <form action="<?php echo FRONT_ROOT."Home/Login" ?>" method="post"
            class="login-form bg-dark-alpha p-5 text-white animate__animated animate__fadeInLeft">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control form-control-lg"
                    placeholder="Ingresar email">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control form-control-lg"
                    placeholder="Ingresar contraseña">
            </div>
            <button class="btn btn-dark btn-block btn-lg" type="submit">Login</button>
        </form>
    </div>

</main>