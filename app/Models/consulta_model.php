<?php
namespace App\Models;
use CodeIgniter\Model;

class consulta_model extends Model 
{
    protected $table = 'consultas';
    protected $primaryKey = 'id_consulta';
    protected $allowedFields = ['nombre', 'email', 'telefono', 'asunto', 'mensaje', 'consulta', 'respondido', 'created_at'];
} 