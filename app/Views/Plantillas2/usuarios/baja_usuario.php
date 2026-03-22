<div class="container mt-5" id="ContenedorCrudProductos">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-4">LISTA DE USUARIOS DADOS DE BAJA</h1>

<div class="table-responsive" style="max-height: 450px; overflow-y: auto;">

    <?php 
        // Filtrar usuarios eliminados
        $usuariosEliminados = array_filter($usuarios, function($usuario) {
            return $usuario['baja'] == "SI";
        });
    ?>

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
            <?php if (empty($usuariosEliminados)): ?>
                <tr>
                    <td colspan="8" class="text-center">No hay usuarios dados de baja</td>
                </tr>
            <?php endif; ?>

            <!--foreach recorre cada elemento del array $usuariosEliminados, cada elemento del array se asigna a la variable $usuario en cada iteración-->
            <?php foreach($usuariosEliminados as $usuario ):?>
            
                    <!--Detalles del producto-->
                    <tr>
                        <th><?php echo $usuario['id_usuario']?></th>
                        <th><?php echo $usuario['nombre']?></th>
                        <th><?php echo $usuario['apellido']?></th>
                        <th><?php echo $usuario['nombre_usuario']?></th>
                        <th><?php echo $usuario['email']?></th>
                        <th><?php echo $usuario['telefono']?></th>

                        <!--recorre un array de perfiles y compara el perfil_id de cada usuario con el id_perfil de cada perfil.
                        Si encuentra un perfil que coincida con el perfil_id del usuario, imprime la descripción del perfil-->
                        <?php foreach ($perfiles as $perfil) : ?>
                            <?php if ($usuario['perfil_id'] == $perfil['id_perfil']) : ?>
                                <th>
                                    <?= $perfil['descripcion'] ?>
                                </th>
                            <?php endif ?>
                        <?php endforeach ?>

                        <!--Acciones-->
                        <th>
                            <a href="<?php echo base_url();?>restaurar-usuario/<?php echo $usuario['id_usuario'];?>" class="btn btn-success"><i class="fa-solid fa-trash-arrow-up"></i> Restaurar</a>
                        </th>
                    </tr>
             
            <?php endforeach;?>
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-between mt-3 mb-5">
        <a href="<?php echo base_url('crud-usuarios'); ?>" class="btn btn-dark"><i class="fa-solid fa-arrow-left"></i> VOLVER</a>
    </div>
</div>