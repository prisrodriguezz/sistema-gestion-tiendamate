<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['titulo'] = "Mates Norestes";
        return view('Plantillas/encabezado', $data).view('Plantillas/nav').view('Plantillas/principal').view('Plantillas/footer');
    }

    public function quienes_somos()
    {
        $data['titulo'] = '¿Quienes Somos? - Mates Norestes';
        return view('Plantillas/encabezado', $data).view('Plantillas/nav').view('Plantillas/quienes_somos').view('Plantillas/footer');
    }

    public function catalogoEnConstruccion()
    {
        $data['titulo'] = 'Catálogo - Mates Norestes';
        return view('Plantillas/encabezado', $data).view('Plantillas/nav').view('Plantillas/catalogo').view('Plantillas/footer');
    }

    public function comercializacion()
    {
        $data['titulo'] = 'Comercializacion - Mates Norestes';
        return view('Plantillas/encabezado', $data).view('Plantillas/nav').view('Plantillas/comercializacion').view('Plantillas/footer');
    }

    public function contacto()
    {
        $data['titulo'] = 'Contacto - Mates Norestes';
        return view('Plantillas/encabezado', $data).view('Plantillas/nav').view('Plantillas/contacto').view('Plantillas/footer');
    }

    public function terminos_y_condiciones()
    {
        $data['titulo'] = 'Terminos y condiciones - Mates Norestes';
        return view('Plantillas/encabezado', $data).view('Plantillas/nav').view('Plantillas/terminos_y_condiciones').view('Plantillas/footer');
    }


    /*2da entrega
    public function login()
    {
        $data['titulo'] = 'Iniciar sesion - Mates Norestes';
        return view('Plantillas/encabezado', $data).view('Plantillas/nav').view('Plantillas2/login').view('Plantillas/footer');
    }

    public function registro()
    {
        $data['titulo'] = 'Registrate - Mates Norestes';
        return view('Plantillas/encabezado', $data).view('Plantillas/nav').view('Plantillas2/registro').view('Plantillas/footer');
    }*/
}
