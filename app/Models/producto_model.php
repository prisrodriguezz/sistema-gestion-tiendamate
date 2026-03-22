<?php
namespace App\Models;
use CodeIgniter\Model;


class producto_model extends Model{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $allowedFields = [
        'nombre_producto', 
        'url_imagen', 
        'categoria_id', 
        'precio', 
        'precio_venta', 
        'stock', 
        'stock_min', 
        'descripcion', 
        'eliminado',
        'created_at'
    ];

    //devuelve productos filtrados para visualizar en el catalogo
    public function get_productos($limit, $offset){
        return $this->where('eliminado', 'NO')
                    ->where('stock > stock_min')
                    ->findAll($limit, $offset);
    }

    public function sacar_del_stock($id, $cantidad_que_saco) {
        $producto = new producto_model();

        //$producto->find($id)['stock'] - $cantidad_que_saco;
        $aux = $producto->where('id_producto', $id)->first();
        $nuevo_stock = $aux['stock'] - $cantidad_que_saco;
        $data = [

            'stock' => $nuevo_stock,
            
        ];

        $producto->update($id, $data);
        
    }
} 