<div class="container mt-5">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
            border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-5">CATALOGO DE PRODUCTOS</h1>

    <?php if(session()->perfil_id == "2") : ?>
        <!--Icon flotante del carrito-->
        <div id="contenedor-icono-flotante" class="fixed-bottom" style="cursor: pointer; margin: 20px; width: 50px; height: 50px; position: fixed; bottom: 20px; right: 20px;">
            <div style="width: 100%; height: 100%; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.50); color: #592B02; background-color: #ACBB78; padding: 10px; border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                <i id="enlace-flotante" class="fa-solid fa-cart-shopping fa-2xl" style="position: relative; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.50); color: #592B02; background-color: #ACBB78;  padding: 30px; border-radius: 50%; width: 50px; height: 50px; justify-content: center; align-items: center; display: inline-flex;">
                    <span id="contador-carrito" class="badge rounded-pill bg-danger" style="position: absolute; top: 5px; right: 5px; transform: translate(50%, -50%); padding: 5px 10px; font-size: 0.75rem;">
                        <?= count(\Config\Services::cart()->contents()) ?>
                    </span>
                </i>
            </div>
        </div> 
    <?php endif ?>

    <!--Incluye el offcanvas del carrito-->
    <?php require APPPATH . 'Views/Plantillas2/carrito/carrito_view.php'; ?>

    <!--Filtro por categoria-->
    <div class="row g-2 py-2 justify-content-end">
        <div class="justify-content-center" style="width: 300px;">
            <form id="categoryForm" method="get" action="">
                <select class="form-select" name="categoria" id="select" required style="background-color: #ACBB78; border-color: #ACBB78;">
                    <option value="todos" <?= $selectedCategory == 'todos' ? 'selected' : '' ?>>Todos los productos</option>
                    <?php foreach($categorias as $categoria): ?>
                        <?php if ($categoria['cantidad_productos'] > 0): ?>
                            <option value="<?= $categoria['id_categoria'] ?>" <?= $selectedCategory == $categoria['id_categoria'] ? 'selected' : '' ?>><?= $categoria['nombre_categoria'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </div> 

    <div class="row g-3 py-3 justify-content-center">
        <?php foreach($productos as $producto ):?>

            <?php $precioFormateado = number_format($producto['precio_venta'], 2, ',', '.');?>


                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mx-4 animate__animated animate__fadeInUp" data-categoria="<?= $producto['categoria_id'] ?>">
                    <div class="d-flex justify-content-center">

                        <form id="form-<?= $producto['id_producto'] ?>" action="<?php echo base_url();?>agregar-al-carrito/<?php echo $producto['id_producto'];?>" method="post">
                            
                            <div class="card card-catalogo" style="width: 300px; height: 450px;" data-bs-product-id="<?= $producto['id_producto'] ?>">
                                
                                <img class="card-img-top-catalogo" style="width: calc(100% - 20px); height: 250px; object-fit: cover; margin: 10px; border-radius: 15px;" src="assets\uploads\<?= $producto['url_imagen']?>">
                                
                                <div class="card-body card-body-catalogo text-center" style="padding-bottom: 0;">
                                    <h4 class="card-title sans-serif" style="font-size: 22px; color:#592B02; overflow: hidden;"><?php echo strtoupper($producto['nombre_producto'])?></h4>
                                </div>

                                <div class="d-flex justify-content-around" style="margin-top: 0; margin-bottom: 0; display: flex; justify-content: space-around; align-items: center;">
                                    <h4 class="fw-bold" style="margin: 0; font-size: 1,5rem;">$ <?= $precioFormateado ?></h4>
                                </div>

                                <?php if(session()->perfil_id == "2") : ?> <!--Usuario cliente-->
                                    <div style="display: flex; justify-content: center; margin-bottom: 10px; padding-top: 0; gap: 5px;"> <!-- Contenedor flex para centrar el botón -->
                                        <a class="btn btn-dark d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#productoModal<?= $producto['id_producto'] ?>" style="font-size: 0.9rem; width: 50%; margin: 10px 10px;">VER DETALLES</a>
                                        <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center" data-bs-product-id="<?= $producto['id_producto'] ?>" style="font-size: 0.9rem; width: 50%; margin: 10px 10px;"><i class="fa-solid fa-cart-shopping"></i> AÑADIR AL CARRITO</button>
                                    </div>

                                <?php else : ?> <!--Usuario visitante-->
                                    <div style="display: flex; justify-content: center; margin-bottom: 10px; padding-top: 0;"> <!-- Contenedor flex para centrar el botón -->
                                        <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#productoModal<?= $producto['id_producto'] ?>" style="font-size: 0.9rem; width: 70%; margin: 10px 10px;"> VER DETALLES</a>
                                    </div> 
                                <?php endif ?>
                            </div> 
                        </form>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="productoModal<?= $producto['id_producto'] ?>" tabindex="-1" aria-labelledby="productoModalLabel<?= $producto['id_producto'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-dark" style="background-color: #ACBB78;">
                            <div class="modal-header">
                                <h5 class="modal-title sans-serif" style="color:#592B02; overflow: hidden;" id="productoModalLabel<?= $producto['id_producto'] ?>"><?= strtoupper($producto['nombre_producto']) ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <img src="assets/uploads/<?= $producto['url_imagen'] ?>" class="img-fluid mb-3" style="object-fit: cover; border-radius: 15px; max-height: 450px;" alt="<?= $producto['nombre_producto'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="text-align: justify;">
                                            <p>Descripción del producto: <br><strong><?= $producto['descripcion'] ?></strong></p>
                                            <p>Productos disponibles: <?= $producto['stock'] ?></p>
                                            <p class="text-end" style="font-size: 25px; color:#592B02;"><strong>$ <?= $precioFormateado ?></strong></p>
                                        </div>
                                        <?php if(session()->perfil_id != "2" && session()->perfil_id != "1") : ?>
                                            <div class="form-text mt-3" style="color:black;">
                                                ¿Deseas realizar una compra? <a href="<?php echo base_url('registro'); ?>" style="color: red;">Registrate</a> o <a href="<?php echo base_url('login'); ?>" style="color: red;">Inicia sesion</a>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <?php if(session()->perfil_id == "2") : ?>
                                    <button type="button" class="btn btn-success" data-bs-product-id="<?= $producto['id_producto'] ?>" onclick="document.getElementById('form-<?= $producto['id_producto'] ?>').submit();"><i class="fa-solid fa-cart-shopping"></i> Añadir al carrito</button>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>               
        <?php endforeach;?>
    </div>

    <!--Paginacion-->
    <nav aria-label="Page navigation example" style="border-top: 2px solid #7DA128;">
        <ul class="pagination pagination-sm justify-content-center mt-3">
            <?= $pager->links('default', 'bootstrap') ?>
        </ul>
    </nav>

</div>

<script>
    //Conecta el boton "añadir al carrito" del Modal con el formulario
    document.addEventListener('DOMContentLoaded', function () {
        var modals = document.querySelectorAll('.modal');
        modals.forEach(function (modal) {
            modal.addEventListener('shown.bs.modal', function (event) {
                var productId = event.relatedTarget.getAttribute('data-bs-product-id');
                var modalSubmitButton = modal.querySelector('.btn-success');

                // Asignar la función de envío del formulario al botón del modal
                if (modalSubmitButton) {
                    modalSubmitButton.setAttribute('data-bs-product-id', productId);
                }
            });
        });
    });

    // Espera a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        var enlaceFlotante = document.getElementById('enlace-flotante');
        var miOffcanvas = new bootstrap.Offcanvas(document.getElementById('miOffcanvas'));

        // Agrega un evento click al enlace flotante para mostrar el offcanvas
        enlaceFlotante.addEventListener('click', function() {
            miOffcanvas.toggle(); // Muestra u oculta el offcanvas
        });

        //cierra el offcanvas al presionar "Seguir comprando" en el carrito
        window.closeOffcanvas = function() {
            miOffcanvas.hide();
        }

        // Función para abrir el offcanvas
        function openOffcanvas() {
            miOffcanvas.show();
        }

        // Verificar si hay productos en el carrito para decidir si abrir el offcanvas en cada actualizacion de pantalla
        <?php if ($cart == TRUE): ?>
            openOffcanvas();
        <?php endif; ?>
    });


    // Función para enviar el formulario cuando se selecciona una categoría
    document.getElementById('select').addEventListener('change', function() {
        document.getElementById('categoryForm').submit();
    });

</script>