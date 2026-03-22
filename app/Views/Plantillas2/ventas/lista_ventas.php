<div class="container mt-5">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-5">LISTA DE VENTAS</h1>

    <div class="mb-3 mt-3">
        <form action="<?php echo base_url('filtrar-ventas'); ?>" method="post">
            <label for="fechaInicio" class="form-label">Filtrar por fecha:</label>
            <input type="date" id="fechaInicio" name="fechaInicio" value="<?= isset($fechaInicio) ? $fechaInicio : '' ?>">

            <label for="fechaFin" class="form-label">a</label>
            <input type="date" id="fechaFin" name="fechaFin" value="<?= isset($fechaFin) ? $fechaFin : '' ?>">
            
            <button type="submit" class="btn btn-dark">Filtrar</button>
            <?php if (!empty($fechaInicio) || !empty($fechaFin)) : ?>
                <a href="<?= base_url('filtrar-ventas') ?>" class="btn btn-warning">Borrar filtros</a>
            <?php endif; ?>
        </form>
    </div>


    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
        <table class="table custom-table mt-2">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Total</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($v_ventas_cabecera)): ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay ventas realizadas</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($v_ventas_cabecera as $venta_cabecera): ?>

                    <?php $precioFormateado = number_format($venta_cabecera['total_venta'], 2, ',', '.');?>
                    <tr>
                            <td>
                                <?= $venta_cabecera['id_ventas'] ?>
                            </td>
                            <td>
                                <?= $venta_cabecera['fecha'] ?>
                            </td>
                            <td>
                                <?= $venta_cabecera['nombre'] . ' ' . $venta_cabecera['apellido'] ?>
                            </td>
                            <td>
                                $ <?= $precioFormateado ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url(); ?>ver-detalle/<?php echo $venta_cabecera['id_ventas']; ?>" class="btn btn-dark"> Ver detalle</a>
                            </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btnFiltrar').on('click', function() {
            var fechaInicio = $('#fechaInicio').val();
            var fechaFin = $('#fechaFin').val();

            $.ajax({
                url: '<?php echo base_url('filtrar-ventas'); ?>',
                method: 'POST',
                data: { fechaInicio: fechaInicio, fechaFin: fechaFin },
                dataType: 'html',
                success: function(response) {
                    $('#tablaVentas').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error al filtrar ventas:', error);
                }
            });
        });
    });
</script>