<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/produtos', 'Produtos::index');
$routes->get('/produtos/form', 'Produtos::formulario');
$routes->post('/produtos', 'Produtos::adicionar');
$routes->get('produtos/(:num)/edit', 'Produtos::edit/$1'); 
$routes->put('produtos/(:num)', 'Produtos::update/$1'); 
$routes->delete('produtos/(:num)', 'Produtos::delete/$1'); 