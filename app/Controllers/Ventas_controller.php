<?php
namespace App\Controllers;

use App\Models\ventasCabecera_model;
use App\Models\ventasDetalle_model;
use App\Models\usuario_model;
use App\Models\producto_model;
use CodeIgniter\Controller;

class Ventas_controller extends Controller{
    public function __construct(){
        helper(['form', 'url']);
    }

    public function listar_ventas(){
        $dato['titulo']='Ventas - Mates norestes'; 

        $v_ventas_cabecera = new ventasCabecera_model();
    
        // Verificar si se está realizando un filtrado por fecha
        $fechaInicio = $this->request->getPost('fechaInicio');
        $fechaFin = $this->request->getPost('fechaFin');

        if (!empty($fechaInicio) && !empty($fechaFin) && $fechaFin >= $fechaInicio) {
        // Filtrar ventas por fecha si se han proporcionado fechas válidas
            $dato['v_ventas_cabecera'] = $v_ventas_cabecera->filtrarVentasPorFecha($fechaInicio, $fechaFin);
        } else {
            // Obtener todas las ventas si no se están filtrando por fecha
            $dato['v_ventas_cabecera'] = $v_ventas_cabecera->getVentasConUsuarios();
        }

        // Pasar las fechas a la vista
        $dato['fechaInicio'] = $fechaInicio;
        $dato['fechaFin'] = $fechaFin;

        /*$dato['v_ventas_cabecera'] = $v_ventas_cabecera->getVentasConUsuarios();*/

        echo view('Plantillas/encabezado', $dato);
        echo view('Plantillas/nav');
        echo view('Plantillas2/ventas/lista_ventas.php', $dato);
        echo view('Plantillas/footer');
    }

    public function ventas_detalle($id = null){
        $venta_cabecera = new ventasCabecera_model();
        $venta_cabecera = $venta_cabecera->where('id_ventas', $id)->first();

        $v_usuario = new usuario_model();
        $v_usuario = $v_usuario->where('id_usuario', $venta_cabecera['usuario_id'])->findAll();

        $venta_detalle = new ventasDetalle_model();
        //$producto = new producto_model();

        //$data['venta_detalle'] = $venta_detalle->findAll();
        $data['venta_detalle'] = $venta_detalle->getDetalleVentaConProductos($id);
        $data['titulo'] = 'Detalle venta - Mates norestes';
        $data['id_venta'] = $id;
        $data['total_venta'] = $venta_cabecera['total_venta'];

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/ventas/venta_detalle', $data);
        echo view('Plantillas/footer');  
    }

    //seccion clientes

    public function listar_ventas_clientes() {
        // Obtener el ID del usuario desde la sesión
        $usuario_id = $_SESSION['id_usuario'];
    
        // Instanciar el modelo de ventas cabecera y obtener las ventas del cliente
        $ventasCabeceraModel = new ventasCabecera_model();
        $ventas = $ventasCabeceraModel->getVentasCliente($usuario_id);
    
        // Prepara un array para almacenar todas las ventas con sus detalles
        $ventasConDetalle = [];
    
        // Iterar sobre todas las ventas obtenidas del cliente
        foreach ($ventas as $venta) {
            $id_venta = $venta['id_ventas'];
    
            // Obtener la cabecera y el detalle de cada venta
            $ventaCabecera = $ventasCabeceraModel->find($id_venta);
    
            $ventasDetalleModel = new ventasDetalle_model();
            $ventaDetalle = $ventasDetalleModel->getDetalleVentaConProductos($id_venta);
    
            // Agregar la venta con su detalle al array
            $ventasConDetalle[] = [
                'ventaCabecera' => $ventaCabecera,
                'ventaDetalle' => $ventaDetalle
            ];
        }
    
        // Preparar los datos para pasar a la vista
        $data = [
            'ventasConDetalle' => $ventasConDetalle,
            'titulo' => 'Mis compras - Mates Norestes'
        ];
    
        // Cargar las vistas
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/ventas/ventas_cliente', $data); 
        echo view('Plantillas/footer');
    }
    
}