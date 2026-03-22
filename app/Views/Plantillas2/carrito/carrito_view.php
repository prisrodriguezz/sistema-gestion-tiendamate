<div class="offcanvas offcanvas-start w-75" tabindex="-1" id="miOffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" style="font-size: 28px; border-bottom: 2px solid #7DA128;"><strong>Mi carrito</strong></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="text-center">
            <?php 
                $session = session();
                $cart = \Config\Services::cart();
                $cart = $cart->contents();
                $gran_total = 0;

                if (empty($cart)) {
                    echo 'Tu carrito está vacío';
                }
            ?>
        </div>
        <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
            <table class="table table-hover mt-2">

                <?php if (!empty($cart)): ?>
                    <thead>
                        <tr>
                            <td style="color: #592B02;"><strong>IMAGEN</strong></td>
                            <td style="color: #592B02;"><strong>DETALLE</strong></td>
                            <td style="color: #592B02;"><strong>CANTIDAD</strong></td>
                            <td style="color: #592B02;"><strong>SUBTOTAL</strong></td>
                            <td style="color: #592B02;"><strong>Acción</strong></td>
                        </tr>
                    </thead>
                    
                    <?php 
                    foreach ($cart as $item):
                        echo form_hidden('cart[' . $item['id'] . '][id]', strval($item['id'])); 
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', strval($item['rowid'])); 
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', strval($item['price']));
                        echo form_hidden('cart[' . $item['id'] . '][qty]', strval($item['qty']));
                    ?>
                        <tr>
                            <td>
                            <img src="<?php echo base_url('assets/uploads/' . $item['imagen'])?>" style="width: 50px; height: auto;">
                            </td>

                            <td>
                                <strong><?php echo $item['name']; ?></strong>
                                <br>
                                $ <?php echo number_format($item['price'], 2); ?>
                            </td>

                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-danger btn-sm mx-1" style="border-radius: 50%;" href="<?php echo base_url();?>restar-a-carrito/<?php echo $item['rowid']; ?>">-</a>
                                    <span class="mx-2"><?php echo $item['qty']; ?></span>
                                    <a class="btn btn-success btn-sm mx-1" style="border-radius: 50%;" href="<?php echo base_url(); ?>sumar-a-carrito/<?php echo $item['rowid']; ?>">+</a>
                                </div>
                            </td>

                            <td>
                                <strong>$ <?php echo number_format($item['subtotal'], 2); ?></strong>
                            </td>

                            <?php $gran_total += $item['price'] * $item['qty']; ?> 

                            <td>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url();?>remover-producto/<?php echo $item['rowid'];?>">Eliminar</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>

        <?php if (!empty($cart)): ?>
            <b style="margin: 20px;">TOTAL COMPRA: $
                <?php echo number_format($gran_total, 2); ?>
            </b>
        <?php endif; ?>
    </div>

    <?php if (!empty($cart)): ?>
        <div class="offcanvas-footer">
            <div class="d-flex justify-content-between" style="margin: 10px;">
                <a class="btn btn-danger mt-2" href="<?php echo base_url('eliminar-carrito')?>">Borrar carrito</a>
                <button type="button" class="btn btn-warning mt-2" onclick="closeOffcanvas()">Seguir comprando</button>
                <a href="<?= base_url('finalizar-compra') ?>" class="btn btn-success mt-2">Finalizar compra <i class="fa-solid fa-check"></i></a>
            </div>
        </div>
    <?php endif; ?>
</div>



