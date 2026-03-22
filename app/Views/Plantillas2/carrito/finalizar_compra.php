<div class="container mt-5 animate__animated animate__fadeInUp">
    <h1 style="text-align: center; text-transform: uppercase; font-weight: bold; font-style: perpetua; border-bottom: 2px solid #7DA128; font-size: 25px;" class="mt-5">Finalizar compra</h1>
    
    <div class="row g-4 py-4 justify-content-center">
        <?php $total_compra = 0; ?>

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto">
            <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                <h5 class="mt-2">DETALLES DE COMPRA</h5>
                <table class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th scope="col" style="background-color: #ACBB78;">Producto</th>
                            <th scope="col" style="background-color: #ACBB78;">Precio</th>
                            <th scope="col" style="background-color: #ACBB78;">Cantidad</th>
                            <th scope="col" style="background-color: #ACBB78;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $item): ?>
                            <tr>
                                <td style="background-color: #ACBB78;"><?php echo $item['name']; ?></td>
                                <td style="background-color: #ACBB78;">$ <?php echo number_format($item['price'], 2); ?></td>
                                <td style="background-color: #ACBB78;"><?php echo $item['qty']; ?></td>
                                <td style="background-color: #ACBB78;">$ <?php echo number_format($item['subtotal'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                            <td style="background-color: #ACBB78;"><strong>Total compra:</strong> $ <?php echo number_format($total, 2); ?></td>
                    </tbody>
                </table>
            </div>
        </div>

        <?php $total_compra += $item['subtotal'] * (25/100); ?>

        <?php $total_compra += $item['subtotal'] / 6; ?>

        <?php $total_compra += $item['subtotal'] / 3; ?>

        <?php $total_compra += $item['subtotal'] + ((5/100) * $item['subtotal']); ?>

        <div class="col-md-11 mx-auto"style="text-align: center; border-bottom: 1px solid #3c3c3c;" class="mt-3"></div>

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto">
            <h5 class="mt-2">FORMAS DE PAGO</h5>

            <form class="mt-3" action="<?= base_url('realizar-compra') ?>" method="POST" id="payment-form">
                <div class="list-group">
                    <label class="list-group-item list-group-item-action" style="background-color: #ACBB78;">
                        <input type="radio" name="payment-method" class="form-check-input me-1" value="transferencia" required>
                        <span style="font-size:18px;"><strong>Transferencia</strong> (25% de descuento)</span>
                    </label>

                    <label class="list-group-item list-group-item-action" style="background-color: #ACBB78;">
                        <input type="radio" name="payment-method" class="form-check-input me-1" value="credito" required>
                        <span style="font-size:18px;"><strong>Tarjeta de credito</strong> (6 cuotas sin interés)</span>
                        <span><br> <img src="assets/img/tarjetaCabal.png" style="width: 50px; height: auto; margin-left:25px; margin-top:5px;" alt="cabal">
                            <img src="assets/img/tarjetaMastercard.png" style="width: 50px; height: auto; margin-top:5px;" alt="mastercard">
                            <img src="assets/img/tarjetaVisa.png" style="width: 50px; height: auto; margin-top:5px;" alt="visa">
                            <img src="assets/img/tarjetaGalicia.jpg" style="width: 50px; height: auto; margin-top:5px;" alt="galicia">
                        </span>
                    </label>

                    <label class="list-group-item list-group-item-action" style="background-color: #ACBB78;">
                        <input type="radio" name="payment-method" class="form-check-input me-1" value="naranja" required>
                        <span style="font-size:18px;"><strong>Con naranja</strong> (3 cuotas sin interés)</span>
                        <span><br><img src="assets/img/tarjetaNaranja.png" style="width: 50px; height: auto; margin-left:25px; margin-top:5px;" alt="naranja"><span>
                    </label>

                    <label class="list-group-item list-group-item-action" style="background-color: #ACBB78;">
                        <input type="radio" name="payment-method" class="form-check-input me-1" value="paypal" required>
                        <span style="font-size:18px;"><strong>PayPal</strong> (5% de recargo)</span>
                        <span><br><img src="assets/img/paypal.jpg" style="width: 50px; height: auto; margin-left:25px; margin-top:5px;" alt="paypal"><span>
                    </label>
                </div>

                <div class="d-flex justify-content-center mb-4">
                <button type="submit" class="btn btn-success mt-4" id="payment-button">PAGAR $ <span id="adjusted-total"><?php echo number_format($total, 2, ',', '.'); ?></span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentForm = document.getElementById('payment-form');
        const totalElement = document.getElementById('adjusted-total');
        const paymentButton = document.getElementById('payment-button');
        const total = <?php echo $total; ?>;

        paymentForm.addEventListener('change', function(event) {
            const selectedPaymentMethod = document.querySelector('input[name="payment-method"]:checked').value;
            let adjustedTotal = total;

            switch (selectedPaymentMethod) {
                case 'transferencia':
                    adjustedTotal = total * 0.75; // - 25%
                    buttonText = `PAGAR $ ${adjustedTotal.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    break;
                case 'credito':
                    adjustedTotal = total / 6; // 6 cuotas
                    buttonText = `PAGAR 6 cuotas de $ ${adjustedTotal.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    break;
                case 'naranja':
                    adjustedTotal = total / 3; // 3 cuotas
                    buttonText = `PAGAR 3 cuotas de $ ${adjustedTotal.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    break;
                case 'paypal':
                    adjustedTotal = total * 1.05; // + 5%
                    buttonText = `PAGAR $ ${adjustedTotal.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    break;
            }

            totalElement.textContent = adjustedTotal.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            paymentButton.textContent = buttonText;
        });
    });
</script>
