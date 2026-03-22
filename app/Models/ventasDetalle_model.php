<?php

namespace App\Models;

use CodeIgniter\Model;

class ventasDetalle_model extends Model{
    protected $table = 'ventas_detalle';
    protected $primaryKey = 'id_detalle';
    protected $allowedFields = ['venta_id', 'producto_id', 'cantidad', 'precio'];

    //devuelve nombre del producto
    public function getDetalleVentaConProductos($venta_id){
        return $this->select('ventas_detalle.*, productos.nombre_producto as nombre_producto')
                    ->join('productos', 'productos.id_producto = ventas_detalle.producto_id')
                    ->where('ventas_detalle.venta_id', $venta_id)
                    ->findAll();
    }
} 