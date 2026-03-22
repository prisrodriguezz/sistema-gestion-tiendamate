<?php
namespace App\Controllers;
Use App\Models\usuario_model;
use CodeIgniter\Controller;

class Login_controller extends Controller{

    public function login() {
        helper(['form', 'url']);

        $data['titulo'] = 'Iniciar sesion - Mates Norestes';
        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/login');
        echo view('Plantillas/footer');
    }

    public function auth(){

        //Se obtiene la instancia de la sesión y se crea una instancia del modelo usuario_model que se utilizará para interactuar con la base de datos.
        $session = session();
        $model = new usuario_model();

        //traemos los datos del formulario
        //$email = $this->request->getVar('email');
        $nombre_usuario = $this->request->getVar('nombre_usuario');
        $contrasenia = $this->request->getVar('contrasenia');

        $rules = [
            //'email' => 'required|valid_email',
            'nombre_usuario' => [
                'label' => 'usuario',
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El {field} es obligatorio',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ]
            ],
            'contrasenia' => [
                'label' => 'contraseña',
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => 'La {field} es obligatoria',
                    'min_length' => 'La {field} debe tener al menos {param} caracteres.',
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            // Si la validación falla
            return redirect()->to('/login')->withInput()->with('validation', $this->validator);
        }

        //Se consulta la base de datos buscando un registro que coincida con el usuario proporcionado.
        //El método first() devuelve el primer resultado encontrado o null si no hay coincidencias.
        $data = $model->where('nombre_usuario', $nombre_usuario)->first();


        if($data){
            //Si se encuentra un usuario con el usuario proporcionado, se extraen la contraseña y el estado de baja del usuario.
            $pass = $data['contrasenia'];
            $ba = $data['baja'];

            //Si el estado de baja es SI,
            //se establece un mensaje indicando que el usuario está dado de baja y se redirige al formulario de inicio de sesión
            if($ba == 'SI'){

                $errors = ['nombre_usuario' => 'El usuario se encuentra dado de baja'];
                return redirect()->to('/login')->withInput()->with('validation', (object) $errors);
            }

            //Se verifica la contraseña proporcionada usando password_verify() (si cumple inicia sesion)
            $verify_pass = password_verify($contrasenia, $pass);
            if($verify_pass){

                //Si la verificación es correcta, se configuran los datos de la sesión del usuario
                $ses_data = [
                    'id_usuario' => $data['id_usuario'],
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'nombre_usuario' => $data['nombre_usuario'],
                    'email' => $data['email'],
                    'telefono' => $data['telefono'],
                    'perfil_id' => $data['perfil_id'],
                    'logged_in' => TRUE
                ];

                //Si se cumple la verificacion inicia sesion
                $session->set($ses_data);
                
                //Se establece un mensaje de bienvenida y se redirige al usuario a la página principal
                //session()->setFlashdata('success', 'Bienvenido!');
                return redirect()->to('/');
            }else{
                //no paso la validacion de la password
                $errors = ['contrasenia' => 'Contraseña Incorrecta'];
                return redirect()->to('/login')->withInput()->with('validation', (object) $errors);
            }
        }else{
            //Si no se encuentra un usuario con el usuario proporcionado
            $errors = ['nombre_usuario' => 'Usuario incorrecto o inexistente'];
            return redirect()->to('/login')->withInput()->with('validation', (object) $errors);
        }
    } 

    public function logout(){
        //Se obtiene la instancia de la sesión
        $session = session();

        //Se destruye la sesión actual. Elimina todos los datos almacenados en la sesión, cierra la sesión del usuario.
        $session->destroy();

        //Se redirige al usuario a la página principal 
        return redirect()->to('/');
    } 
}