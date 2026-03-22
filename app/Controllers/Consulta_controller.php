<?php
namespace App\Controllers;

use App\Models\producto_model;
Use App\Models\usuario_model;
use App\Models\categoria_model;
use App\Models\consulta_model;
use CodeIgniter\Controller;

class Consulta_controller extends Controller{

    public function __construct(){
        helper(['form', 'url']);
    }

    public function enviar_consulta(){

        //validacion formulario
        $rules = ([
            'asunto' => [
                'label' => 'asunto',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                ]
            ],
            'mensaje' => [
                'label' => 'mensaje',
                'rules' => 'required|min_length[10]|max_length[100]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ]
            ],
        ]);

        $session = session();

        $model = new consulta_model();

        if (!$this->validate($rules)) { //si la validacion no es exitosa 
            $data['titulo'] = 'Error consulta - Mates Norestes';
            $data['validation'] = $this->validator; // Pasar los datos de validación

            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/nav');
            echo view('Plantillas/contacto', $data);
            echo view('Plantillas/footer');

        }else{//si la validacion es exitosa

            //obtengo el nombre, email y telefono
            $nombre = $session->get('nombre');
            $email = $session->get('email');
            $telefono = $session->get('telefono');


            //guarda los datos en la BD
            $model->save([
                'nombre' => $nombre,
                'email' => $email,
                'telefono' => $telefono,
                'asunto' => $this->request->getVar('asunto'),
                'mensaje' => $this->request->getVar('mensaje'),
                'consulta' => 'SI',
                'respondido' => 'NO',
            ]);

            session()->setFlashdata('success', 'Mensaje enviado con exito!');
            return redirect()->to('/contacto');
        }
    }

    public function enviar_consulta_usuarioVisitante(){

        //validacion formulario
        $rules = ([
            'nombre' => [
                'label' => 'nombre',
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ]
            ],
            'email' => [
                'label' => 'correo electrónico',
                'rules' => 'required|min_length[4]|max_length[100]|valid_email',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                    'valid_email' => 'El {field} debe contener un correo electrónico válido.',
                ]
            ],
            'telefono' => [
                'label' => 'teléfono',
                'rules' => 'max_length[20]',
                'errors' => [
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ]
            ],
            'asunto' => [
                'label' => 'asunto',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                ]
            ],
            'mensaje' => [
                'label' => 'mensaje',
                'rules' => 'required|min_length[10]|max_length[100]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede exceder de {param} caracteres.',
                ]
            ],
        ]);

        $session = session();

        $model = new consulta_model();

        if (!$this->validate($rules)) { //si la validacion no es exitosa 
            $data['titulo'] = 'Error consulta - Mates Norestes';
            $data['validation'] = $this->validator; // Pasar los datos de validación

            echo view('Plantillas/encabezado', $data);
            echo view('Plantillas/nav');
            echo view('Plantillas/contacto', $data);
            echo view('Plantillas/footer');

        }else{//si la validacion es exitosa
            //guarda los datos en la BD
            $model->save([
                'nombre' => $this->request->getVar('nombre'),
                'email' => $this->request->getVar('email'),
                'telefono' => $this->request->getVar('telefono'),
                'asunto' => $this->request->getVar('asunto'),
                'mensaje' => $this->request->getVar('mensaje'),
                'consulta' => 'NO',
                'respondido' => 'NO',
            ]);

            session()->setFlashdata('success', 'Mensaje enviado con exito!');
            return redirect()->to('/contacto');
        }
    }

    //lista todas las consultas
    public function listar_consultas(){
        $v_consulta_model = new consulta_model();

        // Obtener los parámetros de filtro
        $asuntoFiltro = $this->request->getGet('asunto');
        $clienteFiltro = $this->request->getGet('cliente');
        $verSinResponder = $this->request->getGet('verSinResponder');

        // Construir la consulta con filtros
        $query = $v_consulta_model->select('consultas.*, usuarios.nombre_usuario')
            ->join('usuarios', 'consultas.email = usuarios.email', 'left');

        if ($asuntoFiltro && $asuntoFiltro != '0') {
            $query->where('consultas.asunto', $asuntoFiltro);
        }

        // Aplicar filtro de cliente si está activado
        if ($clienteFiltro) {
            $query->where('consultas.consulta', 'SI');
        }

        // Aplicar filtro para consultas sin responder si está activado
        if ($verSinResponder) {
            $query->where('consultas.respondido', 'NO');
        }

        $data['consultas'] = $query->orderBy('id_consulta', 'DESC')->findAll();
        $data['titulo'] = 'Consultas - Mates Norestes';
        $data['asuntoFiltro'] = $asuntoFiltro;
        $data['clienteFiltro'] = $clienteFiltro;
        $data['verSinResponder'] = $verSinResponder;

        echo view('Plantillas/encabezado', $data);
        echo view('Plantillas/nav');
        echo view('Plantillas2/consultas/lista_consultas', $data);
        echo view('Plantillas/footer');
    }

    //permite responder una consulta
    public function responder_consulta($id = null){
        $v_consulta_model = new consulta_model();

        $data = ['respondido' => "SI"];
        $v_consulta_model->update($id, $data);

        session()->setFlashdata('success', 'Mensaje repondido con exito!');
        return $this->response->redirect(site_url('/ver-consultas'));
    }
} 