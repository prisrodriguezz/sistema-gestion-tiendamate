<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos-->
  <?php if (session()->getFlashdata('success')) {
      echo "
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
      </div>";
    } ?>
</div> 

<!-- Instancia del servicio de validación de CodeIgniter -->
<?php $validation = session()->get('validation'); ?>

<div class="container mt-4 animate__animated animate__fadeInUp" id="ContenedorLogin">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-4">INICIAR SESIÓN</h1> 

    <div class="row g-4 py-4 justify-content-center">

        <!--LOGIN-->
        <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7 mx-7">
            <!--Envio de datos a la ruta 'procesar-inicio'-->
            <form class="row g-3" action="<?php echo base_url('procesar-inicio'); ?>" method="post">

                <div class="col-md-12">
                    <label for="usuario" class="form-label"> Nombre de usuario</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input name="nombre_usuario" type="text" class="form-control" value="<?php echo set_value('nombre_usuario')?>" id="nombre_usuario" autocomplete="usuario" placeholder="ej: paularod" required>
                    </div>
                    <!--Error-->
                    <?php if (isset($validation) && (is_object($validation) || is_array($validation)) && isset($validation->nombre_usuario)): ?>
                        <div class="alert alert-danger mt-2 form-control is-invalid">
                        <?= $validation->nombre_usuario ?>
                        </div>
                    <?php endif; ?> 
                </div>

                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label"><i class="fa-solid fa-key"></i> Contraseña</label>
                    <input name="contrasenia" type="password" id="contrasenia" class="form-control" aria-describedby="passwordHelpBlock" autocomplete="current-password" placeholder="********************" required>
                    <!--Error-->
                    <?php if (isset($validation) && (is_object($validation) || is_array($validation)) && isset($validation->contrasenia)): ?>
                        <div class="alert alert-danger mt-2 form-control is-invalid">
                        <?= $validation->contrasenia ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-12 mt-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">INICIAR SESION</button>

                    <div id="passwordHelpBlock" class="form-text mt-3">
                        ¿No tienes cuenta? <a href="<?php echo base_url('registro'); ?>" style="color: black;">Registrate</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>