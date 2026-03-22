<div class="container mt-5">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-5">MIS COMPRAS</h1>

    <div class="table-responsive animate__animated animate__fadeInUp" style="max-height: 450px; overflow-y: auto;">
        <table class="table custom-table mt-2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $contador = 1; 
                    $contador2 = 1; 
                ?>
                <?php if (empty($ventasConDetalle)): ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            No hay compras realizadas.
                            <strong>¿Deseas realizar una compra?</strong> <a href="<?php echo base_url('view-catalogo'); ?>" style="color: red;">Ir al catálogo</a>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($ventasConDetalle as $venta): ?>
                    <tr>
                        <td><?= $contador ?></td>
                        <td><?= $venta['ventaCabecera']['fecha'] ?></td>
                        <td>$<?= number_format($venta['ventaCabecera']['total_venta'], 2, ',', '.') ?></td>
                        <td>
                            <button type="button" class="btn btn-warning detailButton"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detalleVentaModal<?= $venta['ventaCabecera']['id_ventas'] ?>">
                                Ver detalles
                            </button> 
                        </td>
                    </tr>
                    <?php
                        $contador++; 
                    ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modales para mostrar detalle de cada venta -->
<?php foreach ($ventasConDetalle as $venta): ?>
<div class="modal fade" id="detalleVentaModal<?= $venta['ventaCabecera']['id_ventas'] ?>" tabindex="-1" aria-labelledby="detalleVentaModalLabel<?= $venta['ventaCabecera']['id_ventas'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleVentaModalLabel<?= $venta['ventaCabecera']['id_ventas'] ?>">Detalle de la compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                        </tr>
                    </thead>
                    <tbody id="detalleVentaContent<?= $venta['ventaCabecera']['id_ventas'] ?>">
                        <?php
                            $contador2 = 1; 
                        ?>
                        <?php foreach ($venta['ventaDetalle'] as $detalle): ?>
                            <tr>
                                <td><?= $contador2 ?></td>
                                <td><?= $detalle['nombre_producto'] ?></td>
                                <td><?= $detalle['cantidad'] ?></td>
                                <td>$<?= number_format($detalle['precio'], 2, ',', '.') ?></td>
                            </tr>
                            <?php
                                $contador2++; 
                            ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>

