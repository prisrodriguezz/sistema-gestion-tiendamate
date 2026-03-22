<div>
  <!--recuperamos datos con la función Flashdata para mostrarlos-->
  <?php if (session()->getFlashdata('success')) {
      echo "
      <div class='mt-3 mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('success') . "
      </div>";
    } ?>
</div>

<div class="container mt-5">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-5">LISTA DE CONSULTAS</h1>

    <!-- Filtro por asunto -->
    
    <form id="filterForm" method="get" action="">
        <div class="row g-2 py-1 justify-content-between">
            <div class="col-12 mt-3">
                <div class="d-flex flex-wrap">
                    <div class="form-check me-3 mb-2">
                        <input class="form-check-input" type="radio" name="asunto" id="consultas" value="1" <?= $asuntoFiltro == '1' ? 'checked' : '' ?> onchange="this.form.submit()">
                        <label class="form-check-label" for="consultas">Consultas</label>
                    </div>
                    <div class="form-check me-3 mb-2">
                        <input class="form-check-input" type="radio" name="asunto" id="sugerencias" value="2" <?= $asuntoFiltro == '2' ? 'checked' : '' ?> onchange="this.form.submit()">
                        <label class="form-check-label" for="sugerencias">Sugerencias</label>
                    </div>
                    <div class="form-check me-3 mb-2">
                        <input class="form-check-input" type="radio" name="asunto" id="reclamos" value="3" <?= $asuntoFiltro == '3' ? 'checked' : '' ?> onchange="this.form.submit()">
                        <label class="form-check-label" for="reclamos">Reclamos</label>
                    </div>
                    <div class="form-check me-3 mb-2">
                        <input class="form-check-input" type="radio" name="asunto" id="arrepentimientos" value="4" <?= $asuntoFiltro == '4' ? 'checked' : '' ?> onchange="this.form.submit()">
                        <label class="form-check-label" for="arrepentimientos">Arrepentimientos de compra</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="asunto" id="todas" value="0" <?= !$asuntoFiltro ? 'checked' : '' ?> onchange="this.form.submit()">
                        <label class="form-check-label" for="todas">Todos los mensajes</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-2 py-1">
            <div class="col-12 mt-3">
                <div class="d-flex flex-wrap justify-content-between">
                    <!-- Checkbox para filtrar consultas sin responder -->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="verSinResponder" id="verSinResponderCheckbox" <?= $verSinResponder ? 'checked' : '' ?> onchange="this.form.submit()">
                        <label class="form-check-label" for="verSinResponderCheckbox">Ver consultas sin responder</label>
                    </div>

                    <!-- Filtro por cliente -->
                    <select class="form-select" name="cliente" id="clienteSelect" required style="width: 300px; border: 1px solid #ACBB78;" onchange="this.form.submit()">
                        <option value="" <?= !$clienteFiltro ? 'selected' : '' ?>>Ver todos los mensajes</option>
                        <option value="1" <?= $clienteFiltro ? 'selected' : '' ?>>Consultas de clientes</option>
                    </select>
                </div>
            </div>
        </div>
    </form>


    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
        <table class="table custom-table mt-2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <?php if ($clienteFiltro): ?> 
                        <th scope="col">Usuario</th>
                    <?php endif; ?>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Respondido</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($consultas)): ?>
                    <tr>
                        <td colspan="8" class="text-center">La lista se encuentra vacía</td>
                    </tr>
                <?php endif; ?>

                <?php 
                    $asuntos = [
                        '1' => 'Consulta',
                        '2' => 'Sugerencia',
                        '3' => 'Reclamo',
                        '4' => 'Arrepentimiento de compra'
                    ];
                    ?>

                <?php foreach ($consultas as $consulta): ?>
                    <tr>
                        <!--?php if ($consulta['respondido'] == "SI"): ?-->
                            <td>
                                <?= $consulta['id_consulta'] ?>
                            </td>
                            <?php if ($clienteFiltro): ?> 
                                <td><?= $consulta['nombre_usuario'] ?></td>
                            <?php endif; ?>
                            <td>
                                <?= $consulta['nombre'] ?>
                            </td>
                            <td>
                                <?= $consulta['email'] ?>
                            </td>
                            <td>
                                <?= $consulta['telefono'] ?>
                            </td>
                            <td>
                                <?= $asuntos[$consulta['asunto']] ?>
                            </td>
                            <td>
                                <?= $consulta['respondido'] ?>
                            </td>
                            <td>
                                <button class="btn btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#messageModal" data-message="<?= htmlspecialchars($consulta['mensaje'], ENT_QUOTES, 'UTF-8') ?>" data-id="<?= $consulta['id_consulta'] ?>" data-respondido="<?= $consulta['respondido'] ?>">Ver mensaje</button>
                            </td>
                        <!--?php endif; ?-->
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div> 
</div>

<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="messageContent"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a id="respondButton" href="#" class="btn btn-success mb-2" style="display: none;">Responder</a>
            </div>
        </div>
    </div>
</div>

<!-- Script para manejar el clic en "Ver mensaje" y mostrar el modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var messageModal = document.getElementById('messageModal');
    messageModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Botón que activó el modal
        var message = button.getAttribute('data-message'); // Extraer información de los atributos data-*
        var id = button.getAttribute('data-id'); // Extraer el ID de la consulta
        var respondido = button.getAttribute('data-respondido'); // Extraer el estado de respuesta
        var modalBody = messageModal.querySelector('.modal-body #messageContent');
        var respondButton = messageModal.querySelector('.modal-footer #respondButton');
        
        modalBody.textContent = message;

        if (respondido === "NO") {
            respondButton.style.display = 'inline-block';
            respondButton.href = '<?php echo base_url(); ?>responder-consulta/' + id;
        } else {
            respondButton.style.display = 'none';
        }
    });

    // Manejar los cambios en los selects para enviar los formularios automáticamente
    var filterForm = document.getElementById('filterForm');
    document.getElementById('asuntoSelect').addEventListener('change', function() {
        filterForm.submit();
    });

    document.getElementById('flexSwitchCheckDefault').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
});

</script>