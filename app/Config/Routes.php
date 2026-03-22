<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/', 'Home::index');
$routes->get('principal', 'Home::index');
$routes->get('quienes_somos', 'Home::quienes_somos');
$routes->get('catalogoEnConstruccion', 'Home::catalogo');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('contacto', 'Home::contacto');
$routes->get('terminos_y_condiciones', 'Home::terminos_y_condiciones');



/*2DA ENTREGA*/

/**
 * Rutas del Registro de Usuarios
 */
$routes->get('registro', 'Usuario_controller::create');
$routes->post('procesar-registro', 'Usuario_controller::formValidation'); 

/**
 * Rutas del Login de Usuarios
 */
$routes->get('login', 'Login_controller::login'); //Muestra el formulario de inicio de sesión.
$routes->post('procesar-inicio', 'Login_controller::auth'); //Procesa los datos de inicio de sesión enviados - Verifica las credenciales del usuario - Inicia la sesión si las credenciales son correctas.
$routes->get('cerrar-inicio', 'Login_controller::logout', ['filter' => 'auth']); //Cierra la sesión del usuario autenticado y redirige a la pagina principal

/**
 * Rutas de Productos
 */
$routes->get('crud-productos', 'Producto_controller::lista_productos', ['filter' => 'admin']);

$routes->get('view-agregar-producto', 'Producto_controller::view_nuevo_producto', ['filter' => 'admin']); //muestra la vista de agregar producto
$routes->post('enviar-producto', 'Producto_controller::alta_producto', ['filter' => 'admin']); //Procesa los datos que envia el formulario

$routes->get('eliminar-producto/(:num)', 'Producto_controller::baja_producto/$1', ['filter' => 'admin']);
$routes->get('restaurar-producto/(:num)', 'Producto_controller::restaurar_producto/$1', ['filter' => 'admin']);

$routes->get('productos-eliminados', 'Producto_controller::ver_eliminados', ['filter' => 'admin']);

$routes->get('view-editar-producto/(:num)', 'Producto_controller::view_editar_producto/$1', ['filter' => 'admin']);
$routes->post('editar-producto/(:num)', 'Producto_controller::editar_producto/$1', ['filter' => 'admin']);

$routes->get('view-catalogo', 'Producto_controller::view_catalogo');




/**
 * Rutas de Usuarios
 */
$routes->get('crud-usuarios', 'Usuario_controller::lista_usuarios', ['filter' => 'admin']);
$routes->get('usuarios-eliminados', 'Usuario_controller::ver_eliminados', ['filter' => 'admin']);

$routes->get('eliminar-usuario/(:num)', 'Usuario_controller::eliminarUsuario/$1', ['filter' => 'admin']);
$routes->get('restaurar-usuario/(:num)', 'Usuario_controller::restaurarUsuario/$1', ['filter' => 'admin']);


/**
 * Rutas de Categorías
 */
$routes->get('view-lista-categorias', 'Categoria_controller::lista_categorias', ['filter' => 'admin']);
$routes->post('enviar-categoria', 'Categoria_controller::alta_categoria', ['filter' => 'admin']); //Procesa los datos que envia el formulario
$routes->post('editar-categoria/(:num)', 'Categoria_controller::editar_categoria/$1', ['filter' => 'admin']);
$routes->get('editar-categoria/(:num)', 'Categoria_controller::editar_categoria/$1', ['filter' => 'admin']);
$routes->get('eliminar-categoria/(:num)', 'Categoria_controller::baja_categoria/$1', ['filter' => 'admin']);
$routes->get('restaurar-categoria/(:num)', 'Categoria_controller::restaurar_categoria/$1', ['filter' => 'admin']);

/**
 * Rutas de Consultas
 */
$routes->post('enviar-consulta', 'Consulta_controller::enviar_consulta', ['filter' => 'auth']); //usuario cliente
$routes->post('enviar-consulta-visitante', 'Consulta_controller::enviar_consulta_usuarioVisitante'); //usuario visitante

$routes->get('ver-consultas', 'Consulta_controller::listar_consultas', ['filter' => 'admin']);

$routes->get('responder-consulta/(:num)', 'Consulta_controller::responder_consulta/$1', ['filter' => 'admin']);

/**
 * Rutas del carrito
 */
$routes->get('ver-carrito', 'Carrito_controller::carrito_view', ['filter' => 'auth']);
$routes->post('agregar-al-carrito/(:num)', 'Carrito_controller::agregar/$1', ['filter' => 'auth']);

$routes->post('carrito-actualiza', 'Carrito_controller::actualizar_carrito', ['filter' => 'auth']);
$routes->get('sumar-a-carrito/(:any)', 'Carrito_controller::sumar_carrito/$1', ['filter' => 'auth']);
$routes->get('restar-a-carrito/(:any)', 'Carrito_controller::restar_carrito/$1', ['filter' => 'auth']);
$routes->get('remover-producto/(:any)', 'Carrito_controller::remover_producto/$1', ['filter' => 'auth']);

$routes->get('eliminar-carrito', 'Carrito_controller::eliminar_carrito', ['filter' => 'auth']);

$routes->get('finalizar-compra', 'Carrito_controller::procesar_compra', ['filter' => 'auth']); //redirige a la vista de pago

$routes->post('realizar-compra', 'Carrito_controller::guardar_compra', ['filter' => 'auth']); //guarda la compra ya pagada y visualiza la factura


/**
 * Rutas de ventas
 */
$routes->get('ver-ventas', 'Ventas_controller::listar_ventas', ['filter' => 'admin']);
$routes->get('ver-detalle/(:num)', 'Ventas_controller::ventas_detalle/$1', ['filter' => 'admin']);
$routes->post('filtrar-ventas', 'Ventas_controller::listar_ventas', ['filter' => 'admin']);
$routes->get('filtrar-ventas', 'Ventas_controller::listar_ventas', ['filter' => 'admin']);

//listar ventas desde perfil cliente
$routes->get('ver-mis-ventas', 'Ventas_controller::listar_ventas_clientes', ['filter' => 'auth']);
