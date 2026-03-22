<?php
namespace App\Models;
use CodeIgniter\Model;


class perfil_model extends Model{
    protected $table = 'perfiles';
    protected $primaryKey = 'id_perfil';
    protected $allowedFields = ['descripcion'];

    public function getPerfiles()
    {
        return $this->findAll();
    }
}