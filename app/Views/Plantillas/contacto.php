<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos-->
  <?php if (session()->getFlashdata('success')) {
      echo "
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
      </div>";
    } ?>
</div>

<!--Formulario de contacto y mapa-->
<div class="container mt-5 animate__animated animate__fadeInUp">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
            border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-5">Contactanos</h1>
    <div class="row g-4 py-4 justify-content-center">

        <!--Informacion de contacto-->
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto" style="text-align:center">
                <div class="container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.079674195451!2d-58.83479252517414!3d-27.4667788165806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456dfbe42afae7%3A0xfa3b183afdc6b74d!2s9%20de%20Julio%201449%2C%20W3400%20Corrientes!5e0!3m2!1ses-419!2sar!4v1713394725334!5m2!1ses-419!2sar"
                                width="450" height="300" style="border:0;" allowfullscreen="" lading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div> 
            <div class="row mx-auto">
                <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 mt-3" style="text-align: justify">
                    <ul>
                        <li><strong>Titular:</strong> Sofía García</li>
                        <li><strong>Razón social:</strong> Mates Norestes S.A.</li>
                        <li><strong>Domicilio legal:</strong> 9 de Julio 1449, Corrientes, Argentina</li>
                        <li><strong>Teléfono:</strong> +54 9 379 422-6743</li>
                        <li><strong>E-mail:</strong> info@matesnorestes.com</li>
                    </ul>
                </div>
                <!--Si el usuario es visitante-->
                <?php if(session()->perfil_id != "2") : ?>
                <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 mt-3" style="text-align: justify">
                    <ul>Otros medios de contacto:
                        <li><a class="text-black text-decoration-none" href="https://www.instagram.com/tupagina" target="_blank"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
                        <li><a class="text-black text-decoration-none" href="https://www.facebook.com/tupagina" target="_blank"><i class="fa-brands fa-facebook"></i> Facebook</a></li>
                        <li><a class="text-black text-decoration-none" href="https://twitter.com/tupagina" target="_blank"><i class="fa-brands fa-twitter"></i> Twitter</a></li>
                        <li><a class="text-black text-decoration-none" href="https://www.tiktok.com/tupagina" target="_blank"><i class="fa-brands fa-tiktok"></i> TikTok</a></li>
                        <li><a class="text-black text-decoration-none" href="https://web.whatsapp.com/" target="_blank"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a></li>
                    </ul>
                </div>
                <?php endif ?>
            </div>
        </div>

        <?php $validation = \Config\Services::validation(); ?>

        <!--Si el usuario es cliente-->
        <?php if(session()->perfil_id == "2") : ?>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-6">
            <p class="fw-semibold" style="font-size: 27px;">Escribinos un mensaje</p>
            <form class="row g-3" action="<?php echo base_url('enviar-consulta'); ?>" method="post">

                <div class="col-md-6">
                    <label for="seleccOpciones" class="form-label">Seleccionar:</label>
                    <select class="form-select" name="asunto" id="asunto" required>
                        <option selected disabled>Motivo de contacto</option>
                        <option value="1">Consulta</option>
                        <option value="2">Sugerencia</option>
                        <option value="3">Reclamo</option>
                        <option value="4">Arrepentimiento de compra</option>
                    </select>
                    <!--Error-->
                    <?php if($validation->getError('asunto')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('asunto'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-12">
                    <label for="comentario" class="form-label">Comentario</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" style="height: 155px; resize: none;" required><?php echo set_value('mensaje')?></textarea>
                    <!--Error-->
                    <?php if($validation->getError('mensaje')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('mensaje'); ?>
                        </div>
                    <?php } ?>
                </div>

                
                <div class="col-md-12 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="validacion" required>
                        <label class="form-check-label" for="validacion">He leído los términos y condiciones de la página</label>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary">ENVIAR</button>
                </div>
            </form>
        </div>

        <!--Si el usuario es administrador-->
        <?php elseif (session()->perfil_id == "1") : ?>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-6">
            <p class="fw-semibold" style="font-size: 27px;">Escribinos un mensaje</p>
            <form class="row g-3">
                <div class="col-md-12">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Paula" required>
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" placeholder="paula@ejemplo.com" required>
                </div>
                <div class="col-md-6">
                    <label for="numeroTelefono" class="form-label">Número de teléfono</label>
                    <input type="text" class="form-control" id="numeroTelefono" placeholder="+54 9 379 422-2222">
                </div>
                <div class="col-md-6">
                    <label for="seleccOpciones" class="form-label">Seleccionar:</label>
                    <select class="form-select" id="seleccOpciones" required>
                        <option select>Motivo de contacto</option>
                        <option value="1">Consulta</option>
                        <option value="2">Sugerencia</option>
                        <option value="3">Reclamo</option>
                        <option value="4">Arrepentimiento de compra</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="comentario" class="form-label">Comentario</label>
                    <textarea class="form-control" id="comentario" style="height: 155px; resize: none;" required></textarea>
                </div>
            </form>
            <div class="col-md-12 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="validacion" required>
                    <label class="form-check-label" for="validacion">He leído los términos y condiciones de la página</label>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">ENVIAR</button>
            </div>
        </div>

        <!--Formulario usuario visitante-->
        <?php else : ?>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-6">
            <p class="fw-semibold" style="font-size: 27px;">Escribinos un mensaje</p>
            <form class="row g-3" action="<?php echo base_url('enviar-consulta-visitante'); ?>" method="post">

                <div class="col-md-12">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?php echo set_value('nombre')?>" id="nombre" placeholder="Paula" required>
                    <!--Error-->
                    <?php if($validation->getError('nombre')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('nombre'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" value="<?php echo set_value('email')?>" id="email" placeholder="paula@ejemplo.com" required>
                    <!--Error-->
                    <?php if($validation->getError('email')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="numeroTelefono" class="form-label">Número de teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="<?php echo set_value('telefono')?>" id="telefono" placeholder="+54 9 379 422-2222">
                    <!--Error-->
                    <?php if($validation->getError('telefono')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('telefono'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="seleccOpciones" class="form-label">Seleccionar:</label>
                    <select class="form-select" name="asunto" id="asunto" required>
                        <option selected disabled>Motivo de contacto</option>
                        <option value="1">Consulta</option>
                        <option value="2">Sugerencia</option>
                        <option value="3">Reclamo</option>
                        <option value="4">Arrepentimiento de compra</option>
                    </select>
                    <!--Error-->
                    <?php if($validation->getError('asunto')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('asunto'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-12">
                    <label for="comentario" class="form-label">Comentario</label>
                    <textarea class="form-control" name="mensaje" id="mensaje" style="height: 155px; resize: none;" required><?php echo set_value('mensaje')?></textarea>
                    <!--Error-->
                    <?php if($validation->getError('mensaje')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('mensaje'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="validacion" required>
                        <label class="form-check-label" for="validacion">He leído los términos y condiciones de la página</label>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary">ENVIAR</button>
                </div>
            </form>
        </div>
        <?php endif ?>
    </div>
</div>