<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos-->
  <?php if (session()->getFlashdata('success')) {
      echo "
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
      </div>";
    } ?>
</div>

<div class="container mt-5" id="ContenedorCrudProductos"> 
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-4">LISTA DE CATEGORIAS</h1>

<div class="table-container">
<div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
    <table class="table custom-table mt-2" id="TablaCategorias">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre categoria</th>
                <th scope="col">Activo</th>
                <th scope="col">Cantidad de productos</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            <!-- Fila para agregar nueva categoría -->
            <tr class="prueba">
                <form method="POST" action="<?php echo base_url('enviar-categoria'); ?>">
                    <td><!-- ID será asignado automáticamente por la base de datos --></td>
                    <td><input type="text" name="nombre_categoria" id= "nombre_categoria" placeholder="Agregar nueva categoría" required></td>
                    <!-- Error -->
                    <?php if(isset($validation) && $validation->getError('nombre_categoria')) { ?>
                        <div class='alert alert-danger mt-2 form-control is-invalid'>
                            <?= $validation->getError('nombre_categoria'); ?>
                        </div>
                    <?php } ?>
                    <td>
                    <select name="activo" required>
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                    </td>
                    <td>
                        <input type="hidden" name="cantidad_productos" value="0">
                        0
                    </td>
                    <td><button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> AGREGAR CATEGORIA</button></td>
                </form>
            </tr>

            <!--foreach recorre cada elemento del array $categorias, cada elemento del array se asigna a la variable $categoria en cada iteración-->
            <?php foreach($categorias as $categoria ):?>

                <!--Detalles de categoria-->
                <tr>
                    <th><?php echo $categoria['id_categoria'] ?></th>
                    <th><?php echo $categoria['nombre_categoria'] ?></th>
                    <!--mostrar "SI" si el valor de activo es 1 y "NO" si es 0-->
                    <th><?php echo $categoria['activo'] == "1" ? "SI" : "NO"; ?></th>
                    <th><?php echo $productos_por_categoria[$categoria['id_categoria']]; ?></th>
                    <!--Acciones-->
                    <th>
                        <?php if ($categoria['activo'] == "1"): ?>

                            <button type="button" class="btn btn-warning mb-2 edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
                            data-id="<?php echo $categoria['id_categoria']; ?>"
                            data-nombre="<?php echo $categoria['nombre_categoria']; ?>"
                            data-activo="<?php echo $categoria['activo']; ?>">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                            </button>

                            <a href="<?php echo base_url();?>eliminar-categoria/<?php echo $categoria['id_categoria'];?>" class="btn btn-danger mb-2"><i class="fa-solid fa-trash"></i> Dar de baja</a>
                        <?php elseif ($categoria['activo'] == "0"): ?>
                            <a href="<?php echo base_url();?>restaurar-categoria/<?php echo $categoria['id_categoria'];?>" class="btn btn-success mb-2"><i class="fa-solid fa-trash-arrow-up"></i> Restaurar</a>
                        <?php endif; ?>
                    </th>
                </tr>       

            <?php endforeach;?>

        </tbody>
    </table>
    </div>
    </div>

    <div class="d-flex justify-content-between mt-3 mb-5" style="text-align:center;">
        <div>
            <a href="<?php echo base_url('crud-productos'); ?>" class="btn btn-dark"><i class="fa-solid fa-arrow-left mx-2"></i> VOLVER</a>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="post" action="<?php echo base_url('editar-categoria/' . $categoria['id_categoria']);?>">
          <input type="hidden" id="editId" name="id_categoria">
          <div class="form-group">
            <label for="editNombreCategoria">Nombre de la categoría</label>
            <input type="text" class="form-control" id="editNombreCategoria" name="nombre_categoria" required>
          </div>
          <div class="form-group">
            <label for="editActivo">Activo</label>
            <select name="activo" id="editActivo" class="form-control" required>
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">CERRAR</button>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
$(document).ready(function() {
    $('.edit-btn').on('click', function() {
        // Obtén los datos de los atributos de datos del botón
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');
        var activo = $(this).data('activo');

        // Rellena el formulario del modal con los datos
        $('#editId').val(id);
        $('#editNombreCategoria').val(nombre);
        $('#editActivo').val(activo);

        // Actualiza la acción del formulario
        $('#editForm').attr('action', '<?php echo base_url('editar-categoria'); ?>/' + id);
    });
});
</script>

