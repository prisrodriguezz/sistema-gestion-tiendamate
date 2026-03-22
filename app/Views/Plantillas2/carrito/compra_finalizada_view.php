<div class="container mt-1 animate__animated animate__fadeInUp">
    <div class="text-center p-4">
        <h1>¡Gracias por su compra!</h1> 
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10 mx-auto card p-4">
            <div class="row">
                <div class="col-md-6">
                    <div style="display: flex; align-items: center; font-family: 'homer simpson UI';">
                        <img src="<?= base_url('assets/img/logoProyecto.png') ?>" alt="logo" width="55px">
                        <span style="margin-left: 7px; font-size:23px;"> <strong>MATES NORESTES</strong></span>
                    </div>
                    <p><br><strong>Mates Norestes S.A.</strong> <br> 9 de Julio 1449, Corrientes, Argentina <br> +54 9 379 422-6743 <br> info@matesnorestes.com</p>
                </div>
                <div class="col-md-6">
                    <br>
                    <h6>Nº COMPRA</h6>
                    <p>#<?php echo strtoupper($cabecera_id)?></p>
                    <h6>CLIENTE</h6>
                    <p><?php echo strtoupper($nombre_apellido)?> - <?php echo $email?></p>
                    <h6>FECHA</h6>
                    <p><?php echo $fecha?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <h2 class="text-center">Factura</h2>
            </div>
            <div class="table-responsive">
                <table class="table custom-table"> 
                    <thead>
                        <tr>
                            <th scope="col">Descripción</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio unitario</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas_detalle as $item) : ?>

                            <?php $precioFormateado = number_format($item['precio'], 2, ',', '.');?>
                            <?php $subtotalFormateado = number_format(($item['cantidad']  * $item['precio']), 2, ',', '.');?>

                            <tr>
                                <?php foreach ($productos as $producto) : ?>
                                    <?php if ($producto['id_producto'] == $item['producto_id']) : ?>
                                        <td><?php echo $producto['nombre_producto'] ?></td>
                                    <?php endif ?>
                                <?php endforeach ?>
                            
                            <td><?php echo $item['cantidad'] ?></td>
                            <td>$ <?= $precioFormateado ?></td>
                            <td>$ <?= $subtotalFormateado ?></td>
                        </tr>
                        <?php endforeach ?>
                        
                        <?php $totalFormateado = number_format($total, 2, ',', '.');?>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total compra:</strong></td>
                            <td> $ <?= $totalFormateado ?></td>
                        </tr>

                        <!-- Nueva fila para mostrar descuentos/recargos según el método de pago -->
                        <?php if ($metodo_pago == 'Transferencia') : ?>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Descuento (25%):</strong></td>
                                <td> - $ <?= number_format($descuento, 2, ',', '.') ?></td>
                            </tr>
                        <?php elseif ($metodo_pago == 'Tarjeta de Crédito') : ?>
                            <tr>
                                <td colspan="3" class="text-end"><strong>6 cuotas de:</strong></td>
                                <td> $ <?= number_format($nuevo_total / 6, 2, ',', '.') ?></td>
                            </tr>
                        <?php elseif ($metodo_pago == 'Con Naranja') : ?>
                            <tr>
                                <td colspan="3" class="text-end"><strong>3 cuotas de:</strong></td>
                                <td> $ <?= number_format($nuevo_total / 3, 2, ',', '.') ?></td>
                            </tr>
                        <?php elseif ($metodo_pago == 'PayPal') : ?>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Recargo (5%):</strong></td>
                                <td> + $ <?= number_format($recargo, 2, ',', '.') ?></td>
                            </tr>
                        <?php endif ?>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong> $ <?= number_format($nuevo_total, 2, ',', '.') ?> </strong></td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>

            
            
        </div>
    </div>
    <div class="container-fluid text-center p-4">
        <a class="btn btn-primary btn-block" href="<?php echo base_url('/') ?>">
            Volver al inicio
        </a>
    </div>
</div> 