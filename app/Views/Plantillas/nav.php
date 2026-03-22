<!--Barra de navegacion / Header -->
<header>

    <!--Obtener los datos de la sesion-->
    <?php
        $session = session();
        $idUsuario = $session->get('id_usuario');
        $nombre = $session->get('nombre');
        $apellido = $session->get('apellido');
        $usuario = $session->get('nombre_usuario');
        $email = $session->get('email');
        $telefono = $session->get('telefono');
        $perfil = $session->get('perfil_id');
    ?>


    <!--div class="scrolling-container"> -----------BARRA DESPLAZABLE ANULADA
        <span class="scrolling-text">25% OFF EN EFECTIVO</span>
        <span class="scrolling-text">3 CUOTAS SIN INTERES</span>
        <span class="scrolling-text">ENVIOS A TODO EL PAIS</span>
        <span class="scrolling-text">25% OFF EN EFECTIVO</span>
        <span class="scrolling-text">3 CUOTAS SIN INTERES</span>
        <span class="scrolling-text">ENVIOS A TODO EL PAIS</span>
        <span class="scrolling-text">25% OFF EN EFECTIVO</span>
        <span class="scrolling-text">3 CUOTAS SIN INTERES</span>
        <span class="scrolling-text">ENVIOS A TODO EL PAIS</span>
        <span class="scrolling-text">25% OFF EN EFECTIVO</span>
        <span class="scrolling-text">3 CUOTAS SIN INTERES</span>
        <span class="scrolling-text">ENVIOS A TODO EL PAIS</span>
    </div-->

    <!--BARRA SUPERIOR-->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="container-fluid" style="margin: 5px; color: #2D351E; font-size: 14px; text-align: center;">
                <span> <i class="fa-solid fa-bomb"></i> 25% OFF EN EFECTIVO  |</span>
                <span> <i class="fa-regular fa-credit-card"></i> 3 CUOTAS SIN INTERES  |</span>
                <span> <i class="fa-solid fa-truck"></i> ENVIOS A TODO EL PAIS  </span>

                <!--Si el usuario es cliente o administrador-->
                <?php if(session()->perfil_id == "2" || session()->perfil_id == "1") : ?>
                    <!--Boton cerrar sesion y ver perfil--> 
                    <div class= "d-none d-lg-flex" style="float: right;" id="BotonLoginCerrarSesion"> <!--en pantallas md, sm, xs se oculta-->
                        <span> <a style="color: black;"><i class="fa-regular fa-circle-user fa-lg"></i></a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#detallePerfil<?= $idUsuario ?>" style="color: black; text-decoration: none; margin:5px;">¡Hola, <?php echo $nombre; ?>!</a> | <a href="<?php echo base_url('cerrar-inicio'); ?>" style="color: black; text-decoration: none; margin:5px;"> Cerrar sesión</a></span>

                    </div>

                <!--Usuarios visitantes-->
                <?php else : ?>
                    <!--Boton iniciar sesion y crear cuenta--> 
                    <div class= "d-none d-lg-flex" style="float: right;" id="BotonLoginCrearCuenta"> <!--en pantallas md, sm, xs se oculta-->
                        <span> <a style="color: black;"><i class="fa-solid fa-right-to-bracket"></i></a> 
                            <a href="<?php echo base_url('login'); ?>" style="color: black;">Iniciar sesion</a> | <a href="<?php echo base_url('registro'); ?>" style="color: black;">Crear cuenta</a> </span>
                    </div>

                <?php endif ?>
            </div>
        </div>
    </div>

    <!--MODAL DETALLES DE PERFIL-->
    <div class="modal fade" id="detallePerfil<?= $idUsuario ?>" tabindex="-1" aria-labelledby="detallePerfilLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="detallePerfilLabel">Datos personales</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-10 col-md-10 col-lg-12 col-xl-12 mx-12 justify-content-center">
                        <div class="col-md-12" style="text-align: center; font-size:23px; text-transform: uppercase; font-weight: bold; font-family: Georgia;">
                            <label for="usuario" class="form-label"> <?php echo $nombre; ?> <?php echo $apellido; ?></label>
                        </div>

                        <div class="row justify-content-justify">
                            <div class="col-md-6 mt-2">
                                <label for="usuario" class="form-label"> <strong>Usuario:</strong> <h6 style="margin:5px;">@<?php echo $usuario; ?></h6></label>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="usuario" class="form-label"> <strong>Email:</strong> <h6 style="margin:5px;"><?php echo $email; ?></h6></label>
                            </div>
                            
                            <?php if(!empty($telefono)): ?>
                                <div class="col-md-6 mt-2">
                                    <label for="usuario" class="form-label"> <strong>Teléfono:</strong> <h6 style="margin:5px;"><?php echo $telefono; ?></h6></label>
                                </div>
                            <?php else : ?>
                                <div class="col-md-6 mt-2">
                                    <label for="usuario" class="form-label"> <strong>Teléfono:</strong> <h6 style="margin:5px; text-align:center;">-</h6></label>
                                </div>
                            <?php endif; ?>

                            <?php if($perfil == '1'): ?>
                                <div class="col-md-6 mt-2">
                                    <label for="usuario" class="form-label"> <strong>Perfil:</strong> <h6 style="margin:5px;">Administrador</h6></label>
                                </div>
                            <?php else : ?>
                                <div class="col-md-6 mt-2">
                                    <label for="usuario" class="form-label"> <strong>Perfil:</strong> <h6 style="margin:5px;">Cliente</h6></label>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo base_url('cerrar-inicio'); ?>" class="btn btn-danger"><i class="fa-solid fa-power-off"></i> Cerrar sesión</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


<!--BARRA NAVEGACION-->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #958C4B;"> <!-- Barra se expande-->
        <div class="container-fluid"> <!--Contenedor fluido-->

             <!--Logotipo o el nombre de la marca-->
                <a class="navbar-brand" href="<?php echo base_url('principal'); ?>" style="display: flex; align-items: center; font-family: 'homer simpson UI';">
                    <img src="<?= base_url('assets/img/logoProyecto.png') ?>" alt="logo" width="55px">
                    <span style="margin-left: 7px"> MATES NORESTES</span>
                </a>

             <!--Boton de alternancia en dispositivos chicos-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
            <!--Si el usuario es cliente-->
            <?php if(session()->perfil_id == "2") : ?>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!--alinea a la derecha las opciones-->
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo base_url('principal'); ?>"> Principal </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('quienes_somos'); ?>">Quienes somos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('view-catalogo'); ?>">Catálogo</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('comercializacion'); ?>">Comercialización</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('contacto'); ?>">Consulta</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('terminos_y_condiciones'); ?>">Términos y condiciones</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('ver-mis-ventas'); ?>">Mis compras</a>
                    </li>

                    <!--Cerrar sesion // aparecen en el boton de alternancia en pantallas pequeñas-->
                    <div class="nav-item d-lg-none d-xl-none" style="text-align: right; color: black; font-size: 15px;">
                        <span> <a style="color: black;"><i class="fa-regular fa-circle-user fa-lg"></i></a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#detallePerfil<?= $idUsuario ?>" style="color: black; text-decoration: none; margin:5px;">¡Hola, <?php echo $nombre; ?>!</a> | <a href="<?php echo base_url('cerrar-inicio'); ?>" style="color: black; text-decoration: none; margin:5px;"> Cerrar sesión</a></span>
                    </div>
                </ul>
            </div>

            <!--Si el usuario es administrador-->
            <?php elseif (session()->perfil_id == "1") : ?>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!--alinea a la derecha las opciones-->
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo base_url('principal'); ?>"> Principal </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('quienes_somos'); ?>">Quienes somos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('view-catalogo'); ?>">Catálogo</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('comercializacion'); ?>">Comercialización</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('contacto'); ?>">Contacto</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('terminos_y_condiciones'); ?>">Términos y condiciones</a>
                    </li>

                    <!--Cerrar sesion // aparecen en el boton de alternancia en pantallas pequeñas-->
                    <div class="nav-item d-lg-none d-xl-none" style="text-align: right; color: black; font-size: 15px;">
                        <span> <a style="color: black;"><i class="fa-regular fa-circle-user fa-lg"></i></a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#detallePerfil<?= $idUsuario ?>" style="color: black; text-decoration: none; margin:5px;">¡Hola, <?php echo $nombre; ?>!</a> | <a href="<?php echo base_url('cerrar-inicio'); ?>" style="color: black; text-decoration: none; margin:5px;"> Cerrar sesión</a></span>
                    </div>
                </ul>
            </div>

            <!--Usuarios visitantes-->
            <?php else : ?>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!--alinea a la derecha las opciones-->
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo base_url('principal'); ?>"> Principal </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('quienes_somos'); ?>">Quienes somos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('view-catalogo'); ?>">Catálogo</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('comercializacion'); ?>">Comercialización</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('contacto'); ?>">Contacto</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('terminos_y_condiciones'); ?>">Términos y condiciones</a>
                    </li>

                    <!--Login y registro // aparecen en el boton de alternancia en pantallas pequeñas-->
                    <div class="nav-item d-lg-none d-xl-none" style="text-align: right; color: black; font-size: 15px;">
                        <i class="fa-solid fa-circle-user"></i>
                        <a href="<?php echo base_url('login'); ?>" style="color: black;">INICIAR SESIÓN</a>
                        <a style="color: black;"> | </a>
                        <a href="<?php echo base_url('registro'); ?>" style="color: black;">CREAR CUENTA</a>
                    </div>
                </ul>
            </div>
            <?php endif ?>

        </div>
    </nav>


    <!--Si el usuario es administrador / 2da barra navegacion-->
    <?php if (session()->perfil_id == "1") : ?>

        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #ACBB78;">
            <div class="container-fluid">
                <!-- Botón de alternancia para dispositivos pequeños -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavSecundaria" aria-controls="navbarNavSecundaria" aria-expanded="false" aria-label="Toggle navigation">
                    <span id="toggle-icon" style="font-size:18px; color:#271201;">
                        <i class="fa-solid fa-plus fa-sm"></i> Menú
                    </span>
                </button>

                <!-- Contenido de la barra de navegación -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarNavSecundaria">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-black mx-2 mx-md-3" style="font-size:15px;" href="<?php echo base_url('crud-usuarios'); ?>"> CRUD USUARIOS </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black mx-2 mx-md-3" style="font-size:15px;" href="<?php echo base_url('crud-productos'); ?>"> CRUD PRODUCTOS </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black mx-2 mx-md-3" style="font-size:15px;" href="<?php echo base_url('ver-ventas'); ?>"> VENTAS </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black mx-2 mx-md-3" style="font-size:15px;" href="<?php echo base_url('ver-consultas'); ?>"> CONSULTAS </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black mx-2 mx-md-3" style="font-size:15px;" href="<?php echo base_url('registro'); ?>"> AGREGAR NUEVO ADMIN </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php endif; ?>

</div>
</header>


<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const toggleButton = document.querySelector('.navbar-toggler');
        const toggleIcon = document.getElementById('toggle-icon');

        toggleButton.addEventListener('click', function () {
            if (toggleButton.getAttribute('aria-expanded') === 'true') {
                // Barra de navegación está abierta, cambiar icono a "plus"
                toggleIcon.innerHTML = '<i class="fa-solid fa-plus fa-sm"></i> Menú';
            } else {
                // Barra de navegación está cerrada, cambiar icono a "minus"
                toggleIcon.innerHTML = '<i class="fa-solid fa-minus fa-sm"></i> Menú';
            }
        });

        // Opcional: para asegurarte de que el icono se actualiza cuando la barra de navegación cambia de estado
        document.getElementById('navbarNavSecundaria').addEventListener('shown.bs.collapse', function () {
            toggleIcon.innerHTML = '<i class="fa-solid fa-minus fa-sm"></i> Menú';
        });

        document.getElementById('navbarNavSecundaria').addEventListener('hidden.bs.collapse', function () {
            toggleIcon.innerHTML = '<i class="fa-solid fa-plus fa-sm"></i> Menú';
        });
    });
</script>
