<?php
namespace App\Controllers;
Use App\Models\producto_model;
Use App\Models\categoria_model;
use CodeIgniter\Controller;
use Config\Database; 

class Producto_controller extends Controller{
    public function __construct(){
        helper(['form', 'url']);

        // Carga el servicio de validación
        $this->validator = \Config\Services::validation();
    }

    //Muestra los productos en lista
    public function lista_productos()
    {
        $productoModel = new producto_model();
        $categoriaModel = new categoria_model();
        $categorias = $categoriaModel->findAll();

        // Filtra por categoría seleccionada y por nombre de producto
        $selectedCategory = isset($_GET['categoria']) ? $_GET['categoria'] : 'todos';
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

        $query = $productoModel->select('productos.*, categorias.nombre_categoria as nombre_categoria')
        ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
        ->orderBy('productos.id_producto', 'ASC');

        if ($selectedCategory != 'todos') {
            $query->where('productos.categoria_id', $selectedCategory);
        }

        if (!empty($searchTerm)) {
            $query->like('productos.nombre_producto', $searchTerm);
        }

        $productos = $query->findAll();

        $data['categorias'] = $categorias;
        $data['selectedCategory'] = $selectedCategory;
        $data['searchTerm'] = $searchTerm;
        $data['productos'] = $productos;
        $data['titulo'] = 'Lista Productos - Mates Norestes';

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/productos/crud_productos');
        echo view('Plantillas/footer');
    }

    //Muestra la vista "Agregar nuevo producto"
    public function view_nuevo_producto(){
        $productoModel = new producto_model();
        //obtiene todos los productos de la base de datos, ordenados por el campo id_producto en orden descendente.
        //Los resultados se almacenan en el arreglo $data bajo la clave 'obj'
        $data['obj'] = $productoModel->orderBy('id_producto', 'DESC')->findAll();
        
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();
    
        $data['titulo'] = 'Agregar producto - Mates Norestes';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/productos/alta_producto');
        echo view('Plantillas/footer');
    }
 
    //Valida y agrega un nuevo producto a la BD
    public function alta_producto(){

        //validaciones
        $rules = [
            'nombre_producto' => [
                'label' => 'nombre',
                'rules'  => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'Debes colocar un {field} de al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ],
            ],
            'categoria_id' => [
                'label' => 'categoria',
                'rules'  => 'required|min_length[1]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                ],
            ],
            'precio'=> [
                'label' => 'precio',
                'rules'  => 'required|decimal|greater_than[0]|max_length[10]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'decimal' => 'El {field} debe ser un número decimal válido.',
                    'greater_than' => 'El {field} debe ser mayor que 0.',
                    'max_length' => 'El {field} no puede exceder los 10 dígitos en total, incluidos los decimales.',
                ],
            ],
            'precio_venta' => [
                'label' => 'precio de venta',
                'rules'  => 'required|decimal|greater_than[0]|max_length[10]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'decimal' => 'El {field} debe ser un número decimal válido.',
                    'greater_than' => 'El {field} debe ser mayor que 0.',
                    'max_length' => 'El {field} no puede exceder los 10 dígitos en total, incluidos los decimales.',
                ],
            ],
            'stock' => [
                'label' => 'stock',
                'rules'  => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'integer' => 'El {field} debe ser un número entero.',
                    'greater_than_equal_to' => 'El {field} debe ser igual o mayor que 0.',
                ],
            ],
            'stock_min' => [
                'label' => 'stock mínimo',
                'rules'  => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'integer' => 'El {field} debe ser un número entero.',
                    'greater_than_equal_to' => 'El {field} debe ser igual o mayor que 0.',
                ],
            ],
            'descripcion' => [
                'label' => 'descripción',
                'rules'  => 'required|min_length[3]|max_length[200]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                    'min_length' => 'La {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'La {field} no puede exceder de {param} caracteres.',
                ],
            ],
            'url_imagen' => [
                'label' => 'imagen',
                'rules' => 'uploaded[url_imagen]|mime_in[url_imagen,image/gif,image/png,image/jpeg]|max_size[url_imagen,2048]',
                'errors' => [
                    'uploaded' => 'La {field} es obligatoria.',
                    'mime_in' => 'La {field} debe ser una imagen de tipo gif, png o jpeg.',
                    'max_size' => 'La {field} no puede exceder los 2 MB.',
                ],
            ],
        ];

        $producto = new producto_model();


        //Se valida la entrada del formulario utilizando las reglas definidas previamente en $rules.
        if ($this->validate($rules)) {

            //Se obtiene el objeto de archivo de imagen.
            $img = $this->request->getFile('url_imagen');

            //Se genera un nombre aleatorio para la imagen.
            $nombre_aleatorio = $img->getRandomName();

            //La imagen se mueve a la carpeta 'assets/uploads' en la ruta raíz del proyecto.
            $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);

            $data = [
                'nombre_producto' => $this->request->getVar('nombre_producto'),
                'url_imagen' => $nombre_aleatorio,
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_venta' => $this->request->getVar('precio_venta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock_min'),
                'descripcion' => $this->request->getVar('descripcion'),
            ];

            //se inserta en la base de datos
            $producto->insert($data);

            session()->setFlashdata('success', 'Nuevo producto ingresado con exito!');

            //se redirige al usuario a la página de "Crud productos"
            return $this->response->redirect(site_url('crud-productos'));

        }else{ //error en la validacion
            $categoriaModel = new categoria_model();
            $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();
    
            $dato['titulo'] = 'Error - Mates Norestes';
                echo view('Plantillas/encabezado', $dato);
                echo view('Plantillas/nav');
                echo view('Plantillas2/productos/alta_producto', ['validation' => $this->validator,'categorias' => $data['categorias'],]);
                echo view('Plantillas/footer');
        }
    }

    public function baja_producto($id = null) {
        $producto = new producto_model();
        $data = [
                    'eliminado' => "SI"
                ];
        $producto->update($id, $data);
        
        session()->setFlashdata('success', 'Producto dado de baja con exito!');
        return $this->response->redirect(site_url('/crud-productos'));
    }

    public function restaurar_producto($id = null) {
        $producto = new producto_model();
        $data = [
                    'eliminado' => "NO"
                ];
        $producto->update($id, $data);

        session()->setFlashdata('success', 'Producto restaurado con exito!');
        return $this->response->redirect(site_url('/crud-productos'));
    }

    //lista de productos dados de baja
    public function ver_eliminados(){
        $productoModel = new producto_model();

        // Obtener todos los productos con el nombre de la categoría asociada
        // Ordenar los productos por el ID del producto en orden ascendente
        $data['productos'] = $productoModel->select('productos.*, categorias.nombre_categoria as nombre_categoria')
        ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
        ->orderBy('productos.id_producto', 'ASC')
        ->findAll();

        $data['titulo'] = 'Productos dados de baja - Mates Norestes';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/productos/baja_producto');
        echo view('Plantillas/footer');
    }

    //vista para editar productos
    public function view_editar_producto($id = null){
        $productoModel = new producto_model();
        $data['producto'] = $productoModel->find($id);
        //$data['obj'] = $producto->orderBy('id_producto', 'DESC')->findAll();
        
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();

        $data['titulo'] = 'Modificar producto - Mates Norestes';

        //$data['validation'] = \Config\Services::validation();

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/productos/editar_producto', $data);
        echo view('Plantillas/footer');
    }

    //editar producto
    public function editar_producto($id=null){
        //validaciones
        $rules = [
            'nombre_producto' => [
                'label' => 'nombre',
                'rules'  => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'Debes colocar un {field} de al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ],
            ],
            'categoria_id' => [
                'label' => 'categoria',
                'rules'  => 'required|min_length[1]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                ],
            ],
            'precio'=> [
                'label' => 'precio',
                'rules'  => 'required|decimal|greater_than[0]|max_length[10]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'decimal' => 'El {field} debe ser un número decimal válido.',
                    'greater_than' => 'El {field} debe ser mayor que 0.',
                    'max_length' => 'El {field} no puede exceder los 10 dígitos en total, incluidos los decimales.',
                ],
            ],
            'precio_venta' => [
                'label' => 'precio de venta',
                'rules'  => 'required|decimal|greater_than[0]|max_length[10]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'decimal' => 'El {field} debe ser un número decimal válido.',
                    'greater_than' => 'El {field} debe ser mayor que 0.',
                    'max_length' => 'El {field} no puede exceder los 10 dígitos en total, incluidos los decimales.',
                ],
            ],
            'stock' => [
                'label' => 'stock',
                'rules'  => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'integer' => 'El {field} debe ser un número entero.',
                    'greater_than_equal_to' => 'El {field} debe ser igual o mayor que 0.',
                ],
            ],
            'stock_min' => [
                'label' => 'stock mínimo',
                'rules'  => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'integer' => 'El {field} debe ser un número entero.',
                    'greater_than_equal_to' => 'El {field} debe ser igual o mayor que 0.',
                ],
            ],
            'descripcion' => [
                'label' => 'descripción',
                'rules'  => 'required|min_length[3]|max_length[200]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                    'min_length' => 'La {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'La {field} no puede exceder de {param} caracteres.',
                ],
            ],
        ];

        // Verifica si se proporciona una imagen
        if (!empty($_FILES['url_imagen']['name'])) {
            $rules['url_imagen'] = [
                'label' => 'imagen',
                'rules' => 'uploaded[url_imagen]|mime_in[url_imagen,image/gif,image/png,image/jpeg]|max_size[url_imagen,2048]',
                'errors' => [
                    'uploaded' => 'La {field} es obligatoria.',
                    'mime_in' => 'La {field} debe ser una imagen de tipo gif, png o jpeg.',
                    'max_size' => 'La {field} no puede exceder los 2 MB.',
                ],
            ];
        }

        $this->validator->setRules($rules);

        if ($this->validator->withRequest($this->request)->run()) {
            $producto = new producto_model();

            // Obtiene los datos del formulario
            $data = [
                'nombre_producto' => $this->request->getPost('nombre_producto'),
                'categoria_id' => $this->request->getPost('categoria_id'),
                'precio' => $this->request->getPost('precio'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'stock' => $this->request->getPost('stock'),
                'stock_min' => $this->request->getPost('stock_min'),
                'descripcion' => $this->request->getPost('descripcion')
            ];

            // Si se proporciona una imagen, la procesa
            if (!empty($_FILES['url_imagen']['name'])) {
                $imagen = $this->request->getFile('url_imagen');
                $nombre_aleatorio = $imagen->getRandomName();
                $imagen->move(ROOTPATH.'assets/uploads', $nombre_aleatorio);
                $data['url_imagen'] = $nombre_aleatorio;
            }

            $producto->update($id, $data);

            session()->setFlashdata('success', 'Producto modificado con exito!');
            return redirect()->to('crud-productos');
        } else {
            $data['validation'] = $this->validator;

            $categoriaModel = new categoria_model();
            $data['categorias'] = $categoriaModel->orderBy('id_categoria', 'DESC')->findAll();
    
            $data['titulo'] = 'Error - Mates Norestes';
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/nav');
            echo view('Plantillas2/productos/editar_producto', $data);
            echo view('Plantillas/footer');
        }

    }

    //vista productos de catalogo
    public function view_catalogo() {
        $model = new producto_model();
        $modelCategoria = new categoria_model();
    
        // Obtener todas las categorías
        $categorias = $modelCategoria->findAll();

        // Filtrar las categorías que tienen al menos un producto asociado
        $categoriasConProductos = [];
        foreach ($categorias as $categoria) {
            $cantidadProductos = $modelCategoria->obtenerCantidadProductosPorCategoria($categoria['id_categoria']);
            if ($cantidadProductos > 0) {
                $categoria['cantidad_productos'] = $cantidadProductos;
                $categoriasConProductos[] = $categoria;
            }
        }
        $data['categorias'] = $categoriasConProductos;
    
        // Obtener la categoría seleccionada
        $selectedCategory = $this->request->getGet('categoria') ?? 'todos';
        
        // Cargar productos paginados según la categoría seleccionada
        if ($selectedCategory == 'todos') {
            $productos = $model->where('eliminado', 'NO')
                            ->where('stock > stock_min')
                            ->paginate(9);
        } else {
            $productos = $model->where('eliminado', 'NO')
                            ->where('stock > stock_min')
                            ->where('categoria_id', $selectedCategory)
                            ->paginate(9);
        }

        $data = [
            'categorias' => $categoriasConProductos,
            'productos' => $productos,
            'pager' => $model->pager,
            'selectedCategory' => $selectedCategory,
            'titulo' => 'Catálogo - Mates Norestes'
        ];
    
        if (empty($productos)) {
            // Si no hay productos, muestra "catalogo en construcción"
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/nav');
            echo view('Plantillas/catalogoEnConstruccion');
            echo view('Plantillas/footer');
        } else {
            // Si hay productos, muestra el catálogo
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/nav');
            echo view('Plantillas2/productos/catalogo_producto', $data);
            echo view('Plantillas/footer');
        }
    }
}