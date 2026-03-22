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
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-4">LISTA PRODUCTOS DADOS DE ALTA</h1>
    
    <div class="row py-2 d-flex justify-content-between">
        <!-- Formulario de búsqueda y filtro -->
        <div class="col-md-8">
            <form method="GET" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Buscar por nombre de producto" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <select class="form-select" name="categoria" id="categoria" required>
                        <option value="todos" <?= $selectedCategory == 'todos' ? 'selected' : '' ?>>Todas las categorías</option>
                        <?php foreach($categorias as $categoria): ?>
                            <option value="<?= $categoria['id_categoria'] ?>" <?= $selectedCategory == $categoria['id_categoria'] ? 'selected' : '' ?>><?= $categoria['nombre_categoria'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-dark" type="submit">Buscar</button>
                    <?php if (isset($_GET['search']) || isset($_GET['categoria'])) : ?>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-warning">Borrar filtros</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="<?php echo base_url('view-agregar-producto'); ?>" class="btn btn-success mx-2"><i class="fa-solid fa-plus"></i> AGREGAR NUEVO PRODUCTO</a>
        <a href="<?php echo base_url('view-lista-categorias'); ?>" class="btn btn-warning mx-2"><i class="fa-solid fa-clipboard-list"></i> VER LISTA DE CATEGORIAS</a>
        <a href="<?php echo base_url('productos-eliminados'); ?>" class="btn btn-danger mx-2">VER PRODUCTOS DADOS DE BAJA</a>
    </div>

    <div class="table-responsive mt-3 mb-5" style="max-height: 450px; overflow-y: auto;">
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
            <?php if (empty($productos)): ?>
                <tr>
                    <td colspan="8" class="text-center">Lista vacía</td>
                </tr>
            <?php else: ?>
                <!--foreach recorre cada elemento del array $productos, cada elemento del array se asigna a la variable $producto en cada iteración-->
                <?php foreach($productos as $producto ):?>

                    <?php $precioFormateado2 = number_format($producto['precio'], 2, ',', '.');?>
                    <?php $precioFormateado = number_format($producto['precio_venta'], 2, ',', '.');?>

                    <!--verifica si el producto no está marcado como eliminado-->
                    <?php if($producto['eliminado'] == "NO"):?>
                
                        <!--Detalles del producto-->
                        <tr>
                            <th><?php echo $producto['id_producto']?></th>
                            <th><?php echo $producto['nombre_producto']?></th>
                            <th><?php echo $producto['nombre_categoria']?></th>
                            <th>$ <?= $precioFormateado2 ?></th>
                            <th>$ <?= $precioFormateado ?></th>
                            <th><?php echo $producto['stock']?></th>
                            <th><img height="80px" src="<?= base_url('assets/uploads/'.$producto['url_imagen']) ?>"></th>

                            <!--Acciones-->
                            <th>
                                <a href="<?php echo base_url();?>view-editar-producto/<?php echo $producto['id_producto'];?>" class="btn btn-warning mb-2"><i class="fa-solid fa-pen-to-square"></i> Modificar</a>
                                <br>
                                <a href="<?php echo base_url();?>eliminar-producto/<?php echo $producto['id_producto'];?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Dar de baja</a>
                            </th>
                        </tr>

                    <?php endif;?>                
                <?php endforeach;?>
            <?php endif;?> 
        </tbody>
    </table>
    </div>
</div>