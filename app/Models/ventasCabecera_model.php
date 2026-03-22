<?php

namespace App\Models;

use CodeIgniter\Model;

class ventasCabecera_model extends Model{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id_ventas';
    protected $allowedFields = ['fecha', 'usuario_id', 'total_venta'];

    //obtener nombre y apellido del usuario asociado a la venta
    public function getVentasConUsuarios(){
        return $this->select('ventas_cabecera.*, usuarios.nombre, usuarios.apellido')
                    ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
                    ->findAll();
    }

    // Obtener ventas de un cliente específico por su ID de usuario
    public function getVentasCliente($id_cliente) {
        return $this->select()
                    ->where('usuario_id', $id_cliente)
                    ->findAll();
    }

    //filtra ventas por fecha
    public function filtrarVentasPorFecha($fechaInicio, $fechaFin) {
        return $this->select('ventas_cabecera.*, usuarios.nombre, usuarios.apellido')
                    ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
                    ->where('fecha >=', $fechaInicio)
                    ->where('fecha <=', $fechaFin)
                    ->findAll();
    }
}