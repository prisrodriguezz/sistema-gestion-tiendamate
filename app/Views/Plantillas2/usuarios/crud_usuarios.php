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
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-4">LISTA DE USUARIOS DADOS DE ALTA</h1>
    
    <div class="row py-2 d-flex justify-content-between">
        <!-- Formulario de búsqueda y filtro -->
        <div class="col-md-8">
            <form method="GET" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Buscar por nombre de usuario" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <select class="form-select" name="select" id="select" required>
                        <option value="" selected disabled>Todos los usuarios</option>
                        <option value="1" <?php echo isset($_GET['select']) && $_GET['select'] == '1' ? 'selected' : ''; ?>>Administradores</option>
                        <option value="2" <?php echo isset($_GET['select']) && $_GET['select'] == '2' ? 'selected' : ''; ?>>Clientes</option>
                    </select>
                    <button class="btn btn-dark" type="submit">Buscar</button>
                    <?php if (isset($_GET['search']) || isset($_GET['select'])) : ?>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-warning">Borrar filtros</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
        <table class="table custom-table mt-2">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                <!--foreach recorre cada elemento del array $usuarios, cada elemento del array se asigna a la variable $usuario en cada iteración-->
                <?php 
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $filter = isset($_GET['select']) ? $_GET['select'] : '';
                    $userFound = false; // Bandera para verificar si se encontraron usuarios
                
                    foreach($usuarios as $usuario ):

                        // Verifica si el usuario no está marcado como eliminado y si coincide con los filtros
                        $matchesSearch = empty($search) || stripos($usuario['nombre_usuario'], $search) !== false;
                        $matchesFilter = empty($filter) || $usuario['perfil_id'] == $filter;

                    if($usuario['baja'] == "NO" && $matchesSearch && $matchesFilter):
                        
                        $userFound = true; // Se encontró al menos un usuario
                    ?>
                
                        <!--Detalles del usuario-->
                        <tr>
                            <th><?php echo $usuario['id_usuario']?></th>
                            <th><?php echo $usuario['nombre']?></th>
                            <th><?php echo $usuario['apellido']?></th>
                            <th><?php echo $usuario['nombre_usuario']?></th>
                            <th><?php echo $usuario['email']?></th>
                            <th><?php echo $usuario['telefono']?></th>
                            <th><?php echo $usuario['descripcion']?></th>


                            <!--Acciones-->
                            <th>
                                <?php if(session()->id_usuario != $usuario['id_usuario']) : ?> 
                                    <a href="<?php echo base_url();?>eliminar-usuario/<?php echo $usuario['id_usuario'];?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Dar de baja</a>
                                <?php endif ?>
                            </th>
                        </tr>
                    <?php endif;            
                    endforeach;

                    if (!$userFound) : ?>
                        <tr>
                            <td colspan="8" class="text-center">Nombre de usuario inexistente</td>
                        </tr>
                <?php endif;?> 
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-3 mb-5">
        <a href="<?php echo base_url('usuarios-eliminados'); ?>" class="btn btn-danger">VER USUARIOS DADOS DE BAJA</a>
    </div>
</div>