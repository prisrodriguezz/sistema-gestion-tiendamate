<!-- Validación -->
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

<?php $validation = \Config\Services::validation(); ?>

<div class="container mt-5" id="ContenedorAltaProductos">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-4">ALTA PRODUCTOS</h1>

    <div class="row g-4 py-4 justify-content-center">

        <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7 mx-7">

            <!--Envio de datos a la ruta 'enviar-producto'-->
            <form class="row g-3" action="<?php echo base_url('enviar-producto'); ?>" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <label for="nombreProducto" class="form-label">Nombre producto</label>
                    <input name="nombre_producto" id="nombre_producto" type="text" class="form-control" value="<?php echo set_value('nombre_producto')?>" required>
                    <!--Error-->
                    <?php if($validation->getError('nombre_producto')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('nombre_producto'); ?>
                        </div>
                    <?php } ?>
                </div> 

                <div class="col-md-12">
                    <label for="idCategoria" class="form-label">Categoria</label>
                    <select class="form-select" name="categoria_id" id="categoria_id" required>
                        <option selected disabled>-- Seleccionar categoria --</option>

                        <!--Se muestra el id_categoria y el nombre_categoria de cada categoría como opción, pero solo si la categoría no está eliminada-->
                        <?php foreach ($categorias as $categoria) : ?>
                            <?php if ( $categoria['activo'] == "1") : ?>
                                <option value="<?= $categoria['id_categoria'] ?>">
                                    <?= $categoria['id_categoria'] ?>-<?= $categoria['nombre_categoria'] ?>
                                </option>    
                            <?php endif ?>
                        
                        <?php endforeach ?>
                    </select>
                        <!--Si hay un error de validación para el campo cod_categoria, se muestra un mensaje de error-->
                        <?php if ($validation->getError('categoria_id')) { ?>
                            <div class='alert alert-danger mt-2 form-control is-invalid'>
                                <?= $error = $validation->getError('categoria_id'); ?>
                            </div>
                        <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="precio" class="form-label">Precio</label>
                    <input name="precio" id="precio" type="number" step="0.01" class="form-control" value="<?php echo set_value('precio')?>" required>
                    <!--Error-->
                    <?php if($validation->getError('precio')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('precio'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="precioVenta" class="form-label">Precio venta</label>
                    <input name="precio_venta" id="precio_venta" type="number" step="0.01" class="form-control" value="<?php echo set_value('precio_venta')?>" required>
                    <!--Error-->
                    <?php if($validation->getError('precio_venta')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('precio_venta'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input name="stock" id="stock" type="number" class="form-control" value="<?php echo set_value('stock')?>" required>
                    <!--Error-->
                    <?php if($validation->getError('stock')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('stock'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <label for="stockMin" class="form-label">Stock minimo</label>
                    <input name="stock_min" id="stock_min" type="number" class="form-control" value="<?php echo set_value('stock_min')?>" required>
                    <!--Error-->
                    <?php if($validation->getError('stock_min')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $error = $validation->getError('stock_min'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" style="resize: none;" rows="3" required><?php echo set_value('descripcion')?></textarea>
                    <!--Error-->
                    <?php if($validation->getError('descripcion')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $validation->getError('descripcion'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-12">
                    <label for="url_imagen" class="form-label">Carga de imagen:</label>
                    <input type="file" name="url_imagen" id="url_imagen" class="form-control" value="<?php echo set_value('url_imagen')?>" required>
                    <?php if ($validation->getError('url_imagen')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $validation->getError('url_imagen'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="d-flex justify-content-between mb-1">
                    <a href="<?php echo base_url('crud-productos'); ?>" class="btn btn-dark"><i class="fa-solid fa-arrow-left"></i> VOLVER</a>
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</div> 