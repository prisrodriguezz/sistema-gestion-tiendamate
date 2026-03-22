<div class="container mt-5">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua;
        border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-5">DETALLE VENTA</h1>

    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
        <table class="table custom-table mt-2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">PRODUCTO</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">PRECIO UNITARIO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $contador = 1; 
                    $sumaPrecios = 0;
                ?>

                <?php foreach ($venta_detalle as $detalle): ?>

                    <?php $precioFormateado = number_format($detalle['precio'], 2, ',', '.');?>
                    <tr>
                            <td>
                                <?= $contador ?>
                            </td>
                            <td>
                                <?= $detalle['nombre_producto'] ?>
                            </td>
                            <td>
                                <?= $detalle['cantidad'] ?>
                            </td>
                            <td>
                                $ <?= $precioFormateado ?>
                            </td>
                    </tr>
                    <?php
                        $contador++; 
                        $sumaPrecios += ($detalle['precio']*$detalle['cantidad']); 
                    ?>
                <?php endforeach ?>

                <?php if ($sumaPrecios == $total_venta) : ?>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total compra:</strong></td>
                        <td><strong>$<?php echo number_format($total_venta, 2, ',', '.'); ?></strong></td>
                    </tr>
                <?php elseif ($sumaPrecios > $total_venta) : ?>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Descuento:</strong></td>
                        <td style="color: red;">$<?php echo number_format(($sumaPrecios - $total_venta), 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total compra:</strong></td>
                        <td><strong>$<?php echo number_format($total_venta, 2, ',', '.'); ?></strong></td>
                    </tr>
                <?php elseif ($sumaPrecios < $total_venta) : ?>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Recargo:</strong></td>
                        <td style="color: red;">$<?php echo number_format(($total_venta - $sumaPrecios), 2, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total compra:</strong></td>
                        <td><strong>$<?php echo number_format($total_venta, 2, ',', '.'); ?></strong></td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between mb-3">
            <a href="<?php echo base_url('ver-ventas'); ?>" class="btn btn-dark"><i class="fa-solid fa-arrow-left"></i> VOLVER</a>
        </div>
    </div>
</div>