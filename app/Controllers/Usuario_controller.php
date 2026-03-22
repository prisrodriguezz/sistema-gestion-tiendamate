<?php
namespace App\Controllers;
Use App\Models\usuario_Model;
Use App\Models\perfil_Model;
use CodeIgniter\Controller;
use Config\Database; 

class Usuario_controller extends Controller{

    public function __construct(){
           helper(['form', 'url', 'validacionPersonalizada']);
    }
    
    public function create() {
        
        $data['titulo'] = 'Registrate - Mates Norestes';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/registro');
        echo view('Plantillas/footer');
    }
 
    public function formValidation() {

        $input = $this->validate([
            'nombre' => [
                'label' => 'nombre',
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ]
            ],
            'apellido' => [
                'label' => 'apellido',
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ]
            ],
            'nombre_usuario' => [
                'label' => 'usuario',
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[usuarios.nombre_usuario]',
                'errors' => [
                    'required' => 'El {field} es obligatorio',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                    'is_unique' => 'El {field} ya se encuentra ocupado.',
                ]
            ],
            'email' => [
                'label' => 'correo electrónico',
                'rules' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                    'valid_email' => 'El {field} debe contener un correo electrónico válido.',
                    'is_unique' => 'El {field} ya está registrado.',
                ]
            ],
            'telefono' => [
                'label' => 'teléfono',
                'rules' => 'max_length[20]',
                'errors' => [
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ]
            ],
            'contrasenia' => [
                'label' => 'contraseña',
                'rules' => 'required|min_length[4]|max_length[20]|no_spaces',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                    'min_length' => 'La {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'La {field} no puede exceder de {param} caracteres.',
                    'no_spaces' => 'La {field} no debe contener espacios.',
                ]
            ],
            'confirma_contrasenia' => [
                'label' => 'Confirmar contraseña',
                'rules' => 'required|matches[contrasenia]',
                'errors' => [
                    'required' => '{field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.',
                ]
            ],
        ]);

        $formModel = new usuario_model(); //crea una instancia del modelo

        // Consulta a la tabla "usuarios" para verificar si está vacía
        $count = $formModel->countAllResults();

        if ($count == 0 || (session()->perfil_id == "1")) { //no hay usuarios registrados, por lo tanto el primer registro pertenece a un usuario ADMIN
                                                            //o un perfil admin inicio sesion
            // Obtener el ID del perfil "Admin"
            $perfilId = $this->getPerfilIdAdmin();

        }else{ //si ya existen registros el usuario automaticamente pasa a ser 'Cliente'

            // Obtener el ID del perfil "Cliente"
            $perfilId = $this->getPerfilIdCliente();
        }

        if (!$input) { //si la validacion no es exitosa 
            $data['titulo'] = 'Registrate - Mates Norestes';
            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/nav');
            echo view('Plantillas2/registro', ['validation' => $this->validator]);
            echo view('Plantillas/footer');

        } else { //si la validacion es exitosa
            //guarda los datos en la BD
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido'=> $this->request->getVar('apellido'),
                'nombre_usuario' => $this->request->getVar('nombre_usuario'),
                'email'=> $this->request->getVar('email'),
                'telefono'=> $this->request->getVar('telefono'),
                'contrasenia' => password_hash($this->request->getVar('contrasenia'), PASSWORD_DEFAULT),
                //password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash de único sentido. (contraseña encriptada)
                'perfil_id' => $perfilId
            ]);

            if ((session()->perfil_id == "1")){
                session()->setFlashdata('success', 'Nuevo usuario administrador registrado con exito!');
                return redirect()->to('/registro');
            }else{
                session()->setFlashdata('success', 'Tu cuenta ha sido creada exitosamente. Por favor inicie sesión para continuar');
                return redirect()->to('/login'); //Redirige al usuario a la página de inicio de sesion
            }
      
        }
    }

    private function getPerfilIdCliente() {
        // Obtener una instancia del servicio Database
        $db = Database::connect();

        // Consultar el ID del perfil "Cliente" en la base de datos
        $perfilCliente = $db->table('perfiles')
                           ->where('descripcion', 'Cliente')
                           ->get()
                           ->getRow();
    
        // Verificar si se encontró el perfil "Cliente"
        if ($perfilCliente) {
            return $perfilCliente->id_perfil;
        } else {
            // Si no se encuentra el perfil devolvemos null
            return null;
        }
    }

    private function getPerfilIdAdmin() {
        // Obtener una instancia del servicio Database
        $db = Database::connect();

        // Consultar el ID del perfil "Administrador" en la base de datos
        $perfilAdmin = $db->table('perfiles')
                           ->where('descripcion', 'administrador')
                           ->get()
                           ->getRow();
    
        // Verificar si se encontró el perfil "Administrador"
        if ($perfilAdmin) {
            return $perfilAdmin->id_perfil;
        } else {
            // Si no se encuentra el perfil devolvemos null
            return null;
        }
    }

    //Muestra los usuarios en lista
    public function lista_usuarios()
    {
        $usuarioModel = new usuario_model();

        // Obtener todos los usuarios con la descripcion (cliente/Admin) asociada
        // Ordenar los usuarios por el ID en orden ascendente
        $data['usuarios'] = $usuarioModel->select('usuarios.*, perfiles.descripcion as descripcion')
        ->join('perfiles', 'usuarios.perfil_id = perfiles.id_perfil')
        ->orderBy('usuarios.id_usuario', 'ASC')
        ->findAll();

        $data['titulo'] = 'Lista Usuarios - Mates Norestes';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/usuarios/crud_usuarios');
        echo view('Plantillas/footer');
    }

    //lista de usuarios dados de baja
    public function ver_eliminados(){

        $usuarioModel = new usuario_model();
        $data['usuarios'] = $usuarioModel ->findAll();

        $perfilModel = new perfil_model();
        $data['perfiles'] = $perfilModel ->findAll();

        $data['titulo'] = 'Usuarios dados de baja - Mates Norestes';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/usuarios/baja_usuario');
        echo view('Plantillas/footer');
    }

    //dar de baja un usuario
    public function eliminarUsuario($id = null){
        $v_usuarioModel = new usuario_model();
        $data = ['baja' => "SI"];
        $v_usuarioModel->update($id, $data);

        session()->setFlashdata('success', 'Usuario dado de baja con exito!');
        return $this->response->redirect(site_url('crud-usuarios'));
    }

    //restaurar un usuario
    public function restaurarUsuario($id = null){
        $v_usuarioModel = new usuario_model();
        $data = ['baja' => "NO"];
        $v_usuarioModel->update($id, $data);

        session()->setFlashdata('success', 'El usuario fue restaurado con exito!');
        return $this->response->redirect(site_url('crud-usuarios'));
    }
    
}