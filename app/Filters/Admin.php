<?php namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Admin implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null)
    {   
        // Obtener la instancia de la sesión
        $session = \Config\Services::session();

        //Si el usuario no esta logueado 
        if(!$session->get('logged_in')) {
            // Establecer un mensaje de flash data para informar al usuario que debe iniciar sesión
            $session->setFlashdata('sucess', 'Debes iniciar sesion.');
            //Redirecciona a la pagina de iniciar sesión
            return redirect()->to('login');
        }

        // Verificar si el perfil del usuario es igual a "1" y permite el acceso
        if($_SESSION['perfil_id'] == "1"){
            return;
        }
    }
    //-----------------------------------------
    // Método que se ejecuta después de que la solicitud ha sido procesada por el controlador
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //Hacer algo
    }
}