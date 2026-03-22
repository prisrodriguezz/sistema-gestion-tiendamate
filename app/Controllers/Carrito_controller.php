<?php

namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\producto_model;
use App\Models\usuario_model;
use App\Models\ventasCabecera_model;
use App\Models\ventasDetalle_model;

class Carrito_controller extends Controller {
    public function __construct(){
        helper(['form', 'url']);

        $session = session();
        $cart = \Config\Services::cart();
        $cart->contents();
    }

    //agrega al carrito
    public function agregar($id = null) {

        $cart = \Config\Services::Cart();
        $request = \Config\Services::request();

        $producto = new producto_model();
        $producto = $producto->where('id_producto', $id)->first();

        $cart->insert(array(
            'id'    => $producto['id_producto'],
            'qty'   => 1,
            'price' => $producto['precio_venta'],
            'name'  => $producto['nombre_producto'],
            'imagen' => $producto['url_imagen'],
        ));

        return redirect()->back()->withInput();
    }

    //visualizar carrito
    public function carrito_view(){
        $producto = new producto_model();

        $productos = $productoModel->orderBy('id_producto', 'DESC')->findAll();

        $data = [
            'productos' => $productos,
            'titulo' => 'Carrito - Mates Norestes'
        ];

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/carrito/carrito_view', $data);
        echo view('Plantillas/footer');
    }

    //actualiza el carrito
    public function actualizar_carrito(){
        $cart = \Config\Services::Cart();

        $request = \Config\Services::request();

        $cart->update(array(
            'id'    => $request->getPost('id'),
            'qty'   => 1,
            'price' => $request->getPost('precio_venta'),
            'name'  => $request->getPost('nombre_producto'),
        ));

        return redirect()->back()->withInput();
    }

    //suma un producto mas del seleccionado
    public function sumar_carrito($rowid = null){

        $cart = \Config\Services::cart();
        $item = $cart->getItem($rowid);

        if ($item) {
            $productoModel = new producto_model();
            $producto = $productoModel->where('id_producto', $item['id'])->first();

            if ($producto && $item['qty'] < $producto['stock']) {
                $cart->update(array(
                    'rowid' => $rowid,
                    'qty' => $item['qty'] + 1
                ));
            }
        }

        return redirect()->back()->withInput();
    }

    //resta un producto del seleccionado
    public function restar_carrito($rowid = null){

        $cart = \Config\Services::cart();
        $item = $cart->getItem($rowid);

        if ($item && $item['qty'] > 1) {
            $cart->update(array(
                'rowid' => $rowid,
                'qty' => $item['qty'] - 1
            ));
        }

        return redirect()->back()->withInput();
    }

    //elimina el producto del carrito
    public function remover_producto($rowid) {
   
        $cart = \Config\Services::Cart();
        $request = \Config\Services::request();

        //Si $rowid es "all" destruye el carrito
        if ($rowid==="all"){
            $cart->destroy();
        }else{ //Sino destruye sola fila seleccionada
            $cart->remove($rowid);
        }

        // Redirige a la misma página que se encuentra
        return redirect()->back()->withInput();
    }

    //elimina el carrito completo
    public function eliminar_carrito(){
        $cart = \Config\Services::cart();
        $session = session();

        $cart->destroy();
        $session->set('cart', 0);

        return redirect()->to(base_url('view-catalogo'));
    }

    //borra el carrito una vez finalizada la compra
    public function borrar_carrito(){
        $cart = \Config\Services::cart();//para que incluya el $cart
        $cart->destroy();

        return redirect()->back()->withInput();
    }

    //finaliza compra, redirige a la vista de pago
    public function procesar_compra(){

        // Obtener los datos del carrito
        $cart = \Config\Services::cart()->contents();

        // Calcular el total de la compra
        $total = 0;
        foreach ($cart as $item) {
            $total += floatval($item['subtotal']);
        }

        // Preparar los datos para mostrar en la vista finalizar_compra.php
        $data = [
            'cart' => $cart,
            'total' => $total,
        ];

        $data['titulo'] = 'Finalizar compra - Mates Norestes';
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/nav');
            echo view('Plantillas2/carrito/finalizar_compra', $data);
            echo view('Plantillas/footer');
    }

    //registra compra
    public function guardar_compra(){

        $session = session();
        $cart = \Config\Services::cart();
        $cart = $cart->contents();

		//Inicialización de Modelos
        $venta_detalle = new ventasDetalle_model();
        $venta_cabecera = new ventasCabecera_model();
        $producto = new producto_model();

        //Recorre cada elemento en el carrito y suma los subtotales para obtener el total de la compra
		$total = 0;
        foreach ($cart as $item):
            $total += floatval($item['subtotal']);
        endforeach;
       
        //Prepara un array con los datos de la cabecera de la venta (fecha, ID del usuario, total de ventas)
		$venta = array(
			'fecha' 		=> date('Y-m-d H:i:s'),
			'usuario_id' 	=> $_SESSION['id_usuario'],
			'total_venta'	=> $total,
		);

		//Inserta estos datos en la base de datos y obtiene el ID de la cabecera recién creada
        $cabecera_id = $venta_cabecera->insert($venta);

            //Recorre cada elemento en el carrito y prepara un array con los datos del detalle de la venta
			foreach ($cart as $item):
				$v_venta_detalle = array(
					'venta_id' 		=> $cabecera_id,
					'producto_id' 	=> $item['id'],
					'cantidad' 		=> $item['qty'],
					'precio' 		=> $item['price'],
				);

                //Guarda estos datos en la base de datos
            	$venta_detalle->insert($v_venta_detalle);

            	//Llama a la función para descontar la cantidad vendida del stock del producto
            	$producto->sacar_del_stock($item['id'], $item['qty']);

			endforeach;

        // Obtener el método de pago seleccionado del formulario
        $selectedPaymentMethod = $this->request->getPost('payment-method');

        // Calcula las variables relacionadas con el método de pago seleccionado y el nuevo total dependiendo del método de pago
        $nuevo_total = 0;
        switch ($selectedPaymentMethod) {
            case 'transferencia':
                $metodo_pago = "Transferencia";
                $descuento = $total * 0.25; // Descuento del 25%
                $nuevo_total = $total - $descuento;
                $recargo = 0;
                break;
            case 'credito':
                $metodo_pago = "Tarjeta de Crédito";
                $descuento = 0;
                $nuevo_total = $total;
                $recargo = 0;
                break;
            case 'naranja':
                $metodo_pago = "Con Naranja";
                $descuento = 0;
                $nuevo_total = $total;
                $recargo = 0;
                break;
            case 'paypal':
                $metodo_pago = "PayPal";
                $recargo = $total * 0.05; // Recargo del 5%
                $nuevo_total = $total + $recargo;
                $descuento = 0;
                break;
        }

        // Actualiza el registro en la base de datos con el nuevo total
        $data = ['total_venta' => $nuevo_total];
        $venta_cabecera->update($cabecera_id, $data);

        //Crea un array con los datos necesarios para mostrar en la vista de la factura
		$data = array('titulo' => 'Compra Finalizada - Mates Norestes',
            'cabecera_id_front' => $cabecera_id,
            'ventas_detalle' => $venta_detalle->where('venta_id', $cabecera_id)->findAll(),
            'productos' => $producto->orderBy('id_producto', 'DESC')->findAll(),
            'total' => $total,
            'metodo_pago' => $metodo_pago, // pasar el método de pago a la vista
            'nuevo_total' => $nuevo_total, // pasar el nuevo total a la vista
            'descuento' => $descuento, // pasar el descuento a la vista (si la hay)
            'recargo' => $recargo, // pasar el recargo a la vista (si la hay)
        );

		$data['perfil_id'] = $_SESSION['id_usuario'];
		$data['nombre_apellido'] = $_SESSION['nombre'] . " " . $_SESSION['apellido'];
        $data['cabecera_id'] = $cabecera_id;
        $data['email'] = $_SESSION['email'];
        $data['fecha'] = date('Y-m-d');


        //$data['titulo'] = 'Compra finalizada - Mates Norestes';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/carrito/compra_finalizada_view', $data);
        echo view('Plantillas/footer');
	
        //vaciar el carrito de compras después de que la compra ha sido guardada y finalizada
        $this->borrar_carrito();
	}
}