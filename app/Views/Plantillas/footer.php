        <footer>
            <div class="container-fluid">
                <div class="row p-5 pb-2" style="background-color: #958C4B; color: #000;" id="filasFooter">
                    <!--Opciones de navegacion-->

                <!--Si el usuario es cliente-->
                <?php if(session()->perfil_id == "2") : ?>
                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <p class="h5 mb-2" style="border-bottom: 1px solid #592B02; text-align:center; margin: 5px;">NAVEGACION</p>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('principal'); ?>">Principal</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('quienes_somos'); ?>">Quienes somos</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('catalogo'); ?>">Catálogo</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('comercializacion'); ?>">Comercializacion</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('contacto'); ?>">Consulta</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('terminos_y_condiciones'); ?>">Terminos y condiciones</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('ver-mis-ventas'); ?>">Mis compras</a>
                            </div>
                    </div>


                <!--Si el usuario es administrador-->
                <?php elseif (session()->perfil_id == "1") : ?>
                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <p class="h5 mb-2" style="border-bottom: 1px solid #592B02; text-align:center; margin: 5px;">NAVEGACION</p>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('principal'); ?>">Principal</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('quienes_somos'); ?>">Quienes somos</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('catalogo'); ?>">Catálogo</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('comercializacion'); ?>">Comercializacion</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('contacto'); ?>">Contacto</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('terminos_y_condiciones'); ?>">Terminos y condiciones</a>
                            </div>
                    </div>

                

                <!--Usuarios visitantes-->
                <?php else : ?>
                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <p class="h5 mb-2" style="border-bottom: 1px solid #592B02; text-align:center; margin: 5px;">NAVEGACION</p>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('principal'); ?>">Principal</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('quienes_somos'); ?>">Quienes somos</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('catalogo'); ?>">Catálogo</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('comercializacion'); ?>">Comercializacion</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('contacto'); ?>">Contacto</a>
                            </div>
                            <div class="mb-2" id="navegacion">
                                <a class="text-black text-decoration-none" href="<?php echo base_url('terminos_y_condiciones'); ?>">Terminos y condiciones</a>
                            </div>
                    </div>
                <?php endif ?>

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <p class="h5 mb-2" style="border-bottom: 1px solid #592B02; text-align:center; margin: 5px;">MEDIOS DE PAGO</p>
                            <div class="mb-2">
                                <img class="mt-2" src="<?= base_url('assets/img/tarjetaVisa.png') ?>" alt="logo" width="50px">
                                <img class="mt-2" src="<?= base_url('assets/img/tarjetaNaranja.png') ?>" alt="logo" width="50px">
                                <img class="mt-2" src="<?= base_url('assets/img/tarjetaMastercard.png') ?>" alt="logo" width="50px">
                                <img class="mt-2" src="<?= base_url('assets/img/tarjetaCabal.png') ?>" alt="logo" width="50px">
                                <img class="mt-2" src="<?= base_url('assets/img/mercadoPago.png') ?>" alt="logo" width="50px">
                                <img class="mt-2" src="<?= base_url('assets/img/tarjetaGalicia.jpg') ?>" alt="logo" width="50px">
                            </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <p class="h5 mb-2" style="border-bottom: 1px solid #592B02; text-align:center; margin: 5px;">CONTACTANOS</p>
                            <div class="mb-2">
                                <a class="text-black text-decoration-none"><i class="fa-solid fa-phone"></i> +54 9 379 422-6743</a>
                            </div>
                            <div class="mb-2">
                                <a class="text-black text-decoration-none"><i class="fa-solid fa-envelope"></i> info@matesnorestes.com.ar</a>
                            </div>
                            <div class="mb-2">
                                <a class="text-black text-decoration-none"><i class="fa-solid fa-location-dot"></i> 9 de Julio 1449, Corrientes capital</a>
                            </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <p class="h5 mb-2" style="border-bottom: 1px solid #592B02; text-align:center; margin: 5px;">REDES SOCIALES</p>
                            <div class="mb-1" id="redesSociales">
                                <a class="text-black text-decoration-none" href="https://www.instagram.com/tupagina" target="_blank"><i class="fa-brands fa-instagram"></i> Instagram</a>
                            </div>
                            <div class="mb-2" id="redesSociales">
                                <a class="text-black text-decoration-none" href="https://www.facebook.com/tupagina" target="_blank"><i class="fa-brands fa-facebook"></i> Facebook</a>
                            </div>
                            <div class="mb-2" id="redesSociales">
                                <a class="text-black text-decoration-none" href="https://twitter.com/tupagina" target="_blank"><i class="fa-brands fa-twitter"></i> Twitter</a>
                            </div>
                            <div class="mb-2" id="redesSociales">
                                <a class="text-black text-decoration-none" href="https://www.tiktok.com/tupagina" target="_blank"><i class="fa-brands fa-tiktok"></i> TikTok</a>
                            </div>
                    </div>

                    <!--Derechos de autor-->
                    <div class="col-xs-12 pt-4">
                        <p class="text-black text-center">Copyright - Priscila Rodriguez © 2024</p>
                    </div>
                </div>
            </div>
        </footer>
        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    </body>
</html>