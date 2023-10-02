<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Archivo: app/Config/Routes.php

$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    // Ruta para obtener todos los registros
    $routes->get('ventas', 'Api::index');

    // Ruta para obtener un registro por ID
    $routes->get('ventas/(:num)', 'Api::show/$1');

    // Ruta para crear un nuevo registro
    $routes->post('ventas', 'Api::create');

    // Ruta para actualizar un registro por ID
    $routes->put('ventas/(:num)', 'Api::update/$1');

    // Ruta para eliminar un registro por ID
    $routes->delete('ventas/(:num)', 'Api::delete/$1');
});
