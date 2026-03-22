<!--Carrousel-->
<section class="container animate__animated animate__fadeInUp">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div id="carousel" class="carousel slide" mb-4 style="max-width: 85%; margin: auto;">
            <div class="carousel-inner" style="border-radius: 15px; margin: 10px;">
                <div class="carousel-item active">
                    <img src="assets/img/carrusel1.png" class="d-block w-100" alt="carrusel1">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/carrusel2.png" class="d-block w-100" alt="carrusel2">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/carrusel3.png" class="d-block w-100" alt="carrusel3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
</section>

<!--Texto pagina principal-->
<div>
 <div class="text mt-5">
    <div class="row g-4 py-4 justify-content-center p-5">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

            <h4 class="fw-bold">¿QUIERES DESTACAR EN TUS REUNIONES CON AMIGOS O REGALAR UN DETALLE ESPECIAL? ¡NO BUSQUES MÁS!
                <p class="mt-3">SOMOS TU DESTINO PARA ENCONTRAR MATES ÚNICOS Y EXCLUSIVOS<p></h4>
            <h3 class="fst-italic">Únete a nuestra comunidad de amantes del mate y haz de cada momento de mateo una experiencia única y memorable.</h3>
    
            <div class="text-center mt-3">
                <h3 style="text-align:center; color:#592B02;"><em><strong>¡Descubre tu mate perfecto hoy mismo!</strong></em></h3>
                <a href="<?php echo base_url('view-catalogo'); ?>">
                    <button type="button" class="btn btn-primary btn-lg" style="--bs-btn-padding-y: .90rem;
                    --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" Id="botonPaginaPrincipal">VER CATÁLOGO <i class="fa-solid fa-arrow-right"></i></button>
                </a> 
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 d-none d-lg-flex justify-content-center align-items-center" id="ImagenPrincipal"> <!--en pantallas md, sm, xs la imagen se oculta-->
            <img src="assets/img/juegoMate.png" alt="Juego de mate" width="300px">
        </div>
    </div>
 </div>
</div>

<!--Productos destacados-->
<section class = "container">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
            border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-5">PRODUCTOS DESTACADOS</h1>

    <div class="row g-4 py-4 justify-content-center">
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mx-4">
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 600px;">
                    <img class="card-img-top" src="assets/img/productoDestacado1.jpeg" alt="mate imperial">
                    <div class="card-body">
                        <h3 class="card-title">Mate imperial croco grabado</h3>
                        <p class="card-text">Mate de calabaza. Forrado en cuero vacuno. Base de 4 patas reforzadas.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mx-4">
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 600px;">
                    <img class="card-img-top" src="assets/img/productoDestacado2.jpeg" alt="mate imperial">
                    <div class="card-body">
                        <h3 class="card-title">Box imperial grabado</h3>
                        <p class="card-text">Mate camionero personalizado. Bombilla pico de loro acero y caja de regalo inluida.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mx-4">
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 600px;">
                    <img class="card-img-top" src="assets/img/productoDestacado3.jpeg" alt="mate imperial">
                    <div class="card-body">
                        <h3 class="card-title">Bombilla pico de rey</h3>
                        <p class="card-text">Bombilla con filtro de pala y pico de bronce. Medida aprox 18/19cm</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mx-4">
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 600px;">
                    <img class="card-img-top" src="assets/img/productoDestacado4.jpeg" alt="mate imperial">
                    <div class="card-body">
                        <h3 class="card-title">Combo viajero</h3>
                        <p class="card-text">Este combo incluye: Mate imperial botas y bolitas, bombilla alpaca y porta mate para auto.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mx-4">
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 600px;">
                    <img class="card-img-top" src="assets/img/productoDestacado5.jpeg" alt="mate imperial">
                    <div class="card-body">
                        <h3 class="card-title">Canasta matera</h3>
                        <p class="card-text">Canasta premium confeccionada en cuero. Hecho a mano. Con capacidad para termo, mate y yerba/yerbera.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mx-4">
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 600px;">
                    <img class="card-img-top" src="assets/img/productoDestacado6.jpeg" alt="mate imperial">
                    <div class="card-body">
                        <h3 class="card-title">Mate argento</h3>
                        <p class="card-text">Mate de calabaza. Forrado en cuero vacuno. Base de 4 patas reforzadas. Apliques de bronce soldados en plata.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>