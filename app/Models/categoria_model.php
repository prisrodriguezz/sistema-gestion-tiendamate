<?php
namespace App\Models;
use CodeIgniter\Model;


class categoria_model extends Model{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $allowedFields = ['nombre_categoria', 'activo', 'created_at'];

    //trae todas las categorías de la tabla Categorías
    public function getCategorias()
    {
        return $this->findAll();
    }

    public function obtenerCantidadProductosPorCategoria($categoria_id) {
        return $this->db->table('productos')
                        ->selectCount('id_producto')
                        ->where('categoria_id', $categoria_id)
                        ->get()
                        ->getRow()
                        ->id_producto;
    }
}  