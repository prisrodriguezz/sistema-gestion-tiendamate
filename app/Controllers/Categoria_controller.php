<?php
namespace App\Controllers;

use App\Models\producto_model;
Use App\Models\usuario_model;
use App\Models\categoria_model;
use CodeIgniter\Controller;

class Categoria_controller extends Controller{
    public function __construct(){
        helper(['form', 'url']);
    }

    //mostrar las categorias en lista
    public function lista_categorias()
    {
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'ASC')->findAll();

        // Obtener la cantidad de productos por categoría para cada categoría
        $productos_por_categoria = [];
        foreach ($data['categorias'] as $categoria) {
            $productos_por_categoria[$categoria['id_categoria']] = $categoriaModel->obtenerCantidadProductosPorCategoria($categoria['id_categoria']);
        }
        $data['productos_por_categoria'] = $productos_por_categoria;

        // Pasar la instancia de $categoriaModel a la vista
        $data['categoriaModel'] = $categoriaModel;

        $dato['titulo'] = 'Lista Categorias - Mates Norestes';
        echo view('Plantillas/encabezado', $dato);
        echo view('Plantillas/nav');
        echo view('Plantillas2/categorias/categorias_view', $data);
        echo view('Plantillas/footer');
    }

    //crea nueva categoria
    public function alta_categoria(){
        $rules = [
            'nombre_categoria' => [
                'label' => 'categoría',
                'rules'  => 'required|min_length[3]|is_unique[categorias.nombre_categoria]',
                'errors' => [
                    'min_length' => 'El campo {field} debe tener al menos {param} caracteres.',
                    'is_unique' => 'El nombre de la {field} ya existe.',
                ],
            ],
            'activo' => [
                'label' => 'Activo',
                'rules'  => 'required|in_list[0,1]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'in_list' => 'El campo {field} debe ser 0 o 1.',
                ],
            ],
        ];
        $categoriaModel = new categoria_model();

        if ($this->validate($rules)) {
            $data = [
                'nombre_categoria' => $this->request->getVar('nombre_categoria'),
                'activo' => $this->request->getVar('activo'),
            ];

            $categoriaModel->insert($data);

            session()->setFlashdata('success', 'Nueva categoria ingresada con exito!');
            return redirect()->to('view-lista-categorias');
            //return $this->response->redirect(site_url('view-lista-categorias'));
        } else {

            $categoriaModel = new categoria_model();
            $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'ASC')->findAll();

            // Obtener la cantidad de productos por categoría para cada categoría
            $productos_por_categoria = [];
            foreach ($data['categorias'] as $categoria) {
                $productos_por_categoria[$categoria['id_categoria']] = $categoriaModel->obtenerCantidadProductosPorCategoria($categoria['id_categoria']);
            }
            $data['productos_por_categoria'] = $productos_por_categoria;

            // Pasar la instancia de $categoriaModel a la vista
            $data['categoriaModel'] = $categoriaModel;

            // Pasar el validador a la vista
            $data['validation'] = $this->validator;

            $data['titulo'] = 'Error - Mates Norestes';
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/nav');
            echo view('Plantillas2/categorias/categorias_view', $data);
            echo view('Plantillas/footer');
        }
    }

    // Editar categoría existente
    public function editar_categoria($id = null) {
        $rules = [
            'nombre_categoria' => [
                'label' => 'categoría',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'min_length' => 'El campo {field} debe tener al menos {param} caracteres.',
                ],
            ],
            'activo' => [
                'label' => 'Activo',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'in_list' => 'El campo {field} debe ser 0 o 1.',
                ],
            ],
        ];
    
        $categoriaModel = new categoria_model();
    
        if ($this->validate($rules)) {
            $data = [
                'nombre_categoria' => $this->request->getVar('nombre_categoria'),
                'activo' => $this->request->getVar('activo'),
            ];
    
            $categoriaModel->update($id, $data);
    
            session()->setFlashdata('success', 'Categoría actualizada con éxito!');
            return redirect()->to('view-lista-categorias');
            //return $this->response->redirect(site_url('view-lista-categorias'));
        } else {
            $categoriaModel = new categoria_model();
            $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'ASC')->findAll();

            // Obtener la cantidad de productos por categoría para cada categoría
            $productos_por_categoria = [];
            foreach ($data['categorias'] as $categoria) {
                $productos_por_categoria[$categoria['id_categoria']] = $categoriaModel->obtenerCantidadProductosPorCategoria($categoria['id_categoria']);
            }
            $data['productos_por_categoria'] = $productos_por_categoria;

            // Pasar la instancia de $categoriaModel a la vista
            $data['categoriaModel'] = $categoriaModel;

            // Pasar el validador a la vista
            $data['validation'] = $this->validator;

            $data['titulo'] = 'Error - Mates Norestes';
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/nav');
            echo view('Plantillas2/categorias/categorias_view', $data);
            echo view('Plantillas/footer');
        }
    }

    //eliminar una categoria 
    public function baja_categoria($id = null){
        $categoriaModel = new categoria_model();
        $data = ['activo' => '0'];
        $categoriaModel->update($id,$data);
        return redirect()->to('view-lista-categorias');
    }

    //restaurar una categoria 
    public function restaurar_categoria($id = null){
        $categoriaModel = new categoria_model();
        $data = ['activo' => '1'];
        $categoriaModel->update($id,$data);
        return redirect()->to('view-lista-categorias');
    }
}