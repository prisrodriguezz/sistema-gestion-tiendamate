<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos-->
  <?php if (session()->getFlashdata('success')) {
      echo "
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
  </div>";
    } ?>
</div>

<!--obtiene una instancia del servicio de validación de CodeIgniter y la asigna a la variable $validation-->
<?php $validation = \Config\Services::validation(); ?>

<div class="container mt-4 animate__animated animate__fadeInUp" id="ContenedorRegistro">

    <!--Si el usuario es administrador-->
    <?php if(session()->perfil_id == "1") : ?>
        <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-4 mb-3">CREAR CUENTA ADMINISTRADOR</h1>
    
    <!--Si el suario es visitante-->
    <?php else : ?>
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-4">CREAR CUENTA</h1>
    <p class="fst-normal mt-4" style="text-align: center; font-size: 20px;">Comprá más rápido y llevá el control de tus pedidos, <strong>¡en un solo lugar!</strong></p>
    <?php endif ?>

    <div class="row g-3 py-3">
        <!--REGISTRO-->
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-12">

            <!--Envio de datos a la ruta 'procesar-registro'-->
            <form class="row g-3" action="<?php echo base_url('procesar-registro'); ?>" method="post">

                <div class="col-md-6">
                    <label for="nombre" class="form-label"><i class="fa-solid fa-user"></i> Nombre</label>
                    <!--Ingreso del nombre-->
                    <input name="nombre" type="text" class="form-control" value="<?php echo set_value('nombre')?>" id="nombre" autocomplete="nombre" placeholder="ej: Paula" required>
                    <!--Error-->
                    <?php if($validation->getError('nombre')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('nombre'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="apellido" class="form-label"><i class="fa-solid fa-user"></i> Apellido</label>
                    <!--Ingreso apellido-->
                    <input name="apellido" type="text" class="form-control" value="<?php echo set_value('apellido')?>" id="apellido" autocomplete="apellido" placeholder="ej: Rodriguez" required>
                    <!--Error-->
                    <?php if($validation->getError('apellido')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('apellido'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-12">
                    <label for="nombre_usuario" class="form-label"> Nombre de usuario</label>
                    <!--Ingreso usuario-->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input name="nombre_usuario" type="text" class="form-control" value="<?php echo set_value('nombre_usuario')?>" id="nombre_usuario" autocomplete="usuario" placeholder="ej: paularod" required>
                    </div>
                    <!--Error-->
                    <?php if($validation->getError('nombre_usuario')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('nombre_usuario'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i> E-mail</label>
                    <!--Ingreso de email-->
                    <input name="email" type="email" class="form-control" value="<?php echo set_value('email')?>" id="email" autocomplete="email" placeholder="ej: paula@ejemplo.com" required>
                    <!--Error-->
                    <?php if($validation->getError('email')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="telefono" class="form-label"><i class="fa-solid fa-phone"></i> Número de teléfono (opcional)</label>
                    <!--Ingreso nro telefono-->
                    <input name="telefono" type="text" class="form-control" value="<?php echo set_value('telefono')?>" id="telefono" autocomplete="telefono" placeholder="ej: +54 9 379 422-2222">
                    <!--Error-->
                    <?php if($validation->getError('telefono')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('telefono'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="contrasenia" class="form-label"><i class="fa-solid fa-lock"></i> Contraseña</label>
                    <!--Ingreso de contraseña-->
                    <input name="contrasenia" type="password" id="contrasenia" class="form-control" value="<?php echo set_value('contrasenia')?>" autocomplete="current-password" aria-describedby="passwordHelpBlock" placeholder="********************" required>
                    <div id="contrasenia" class="form-text">
                        Su contraseña debe tener entre 4 y 20 caracteres. No debe contener espacios, ni caracteres especiales.
                    </div>
                    <!--Error-->
                    <?php if($validation->getError('contrasenia')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('contrasenia'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="confirma_contrasenia" class="form-label"><i class="fa-solid fa-lock"></i> Confirmar contraseña</label>
                    <!--Confirmar contraseña-->
                    <input name="confirma_contrasenia" type="password" id="confirma_contrasenia" class="form-control" value="<?php echo set_value('confirma_contrasenia')?>" autocomplete="current-password" aria-describedby="passwordHelpBlock" placeholder="********************" required>
                    <!--Error-->
                    <?php if($validation->getError('confirma_contrasenia')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('confirma_contrasenia'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-12 mt-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">CREAR CUENTA</button>

                    <?php if(session()->perfil_id != "1") : ?> <!--Solo se visualiza para usuarios visitantes-->
                    <div id="passwordHelpBlock" class="form-text mt-3">
                        ¿Ya tienes cuenta? <a href="<?php echo base_url('login'); ?>" style="color: black;">Iniciar sesión</a>
                    </div>
                    <?php endif ?>
                </div>
            </form>
        </div>
    </div>
</div>
