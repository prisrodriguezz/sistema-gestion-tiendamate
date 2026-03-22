<div>
        <!--recuperamos datos con la función Flashdata para mostrarlos-->
        <?= csrf_field(); ?>

        <?php if (session()->getFlashdata('success')) {
            echo "
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
        </div>";
        } ?>
    </div>

<div class="container mt-5" id="ContenedorCrudProductos">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-4">LISTA PRODUCTOS DADOS DE BAJA</h1>
     
    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">

    <?php 
        // Filtrar productos eliminados
        $productosEliminados = array_filter($productos, function($producto) {
            return $producto['eliminado'] == "SI";
        });
    ?>

    <table class="table custom-table mt-2">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
                <th scope="col">Precio venta</th>
                <th scope="col">Stock</th>
                <th scope="col">Imagen</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($productosEliminados)): ?>
                <tr>
                    <td colspan="8" class="text-center">No hay productos dados de baja</td>
                </tr>
            <?php endif; ?>
            
            <!--foreach recorre cada elemento del array, cada elemento del array se asigna a la variable $producto en cada iteración-->
            <?php foreach($productosEliminados as $producto ):?>

                <?php $precioFormateado2 = number_format($producto['precio'], 2, ',', '.');?>
                <?php $precioFormateado = number_format($producto['precio_venta'], 2, ',', '.');?>

                <!--Detalles del producto-->
                <tr>
                    <th><?php echo $producto['id_producto']?></th>
                    <th><?php echo $producto['nombre_producto']?></th>
                    <th><?php echo $producto['nombre_categoria']?></th>
                    <th><?= $precioFormateado2 ?></th>
                    <th><?= $precioFormateado ?></th>
                    <th><?php echo $producto['stock']?></th>
                    <th><img height="80px" src="assets\uploads\<?= $producto['url_imagen']?>"></th>

                    <!--Acciones-->
                    <th>
                        <a href="<?php echo base_url();?>restaurar-producto/<?php echo $producto['id_producto'];?>" class="btn btn-success"><i class="fa-solid fa-trash-arrow-up"></i> Restaurar</a>
                    </th>
                </tr>

            <?php endforeach;?>
        </tbody>
    </table>
    </div>
    <div class="d-flex justify-content-between mt-3 mb-5">
        <a href="<?php echo base_url('crud-productos'); ?>" class="btn btn-dark"><i class="fa-solid fa-arrow-left"></i> VOLVER</a>
    </div>
</div>