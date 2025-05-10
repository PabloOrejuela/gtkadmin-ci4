<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//HOME
$routes->get('/', 'Login::index');
$routes->post('validate_login', 'Home::validate_login');
$routes->get('inicio', 'Home::inicio');
$routes->get('logout', 'Home::logout');
$routes->get('select-ciudades', 'Home::selectCiudades');

//USUARIOS
$routes->get('new-member', 'Usuarios::registrarNuevoMiembro');
$routes->post('new-member-insert', 'Usuarios::insertNuevoMiembro');
$routes->get('perfil/(:num)', 'Usuarios::perfil/$1');
$routes->get('lista-miembros', 'Usuarios::listaMiembros');

//Pedidos
$routes->get('new-order', 'Pedidos::registraNuevoPedido');
$routes->post('new-order', 'Pedidos::insertNuevoPedido');
$routes->get('get-paquete', 'Pedidos::getPaquete');
$routes->get('lista-pedidos', 'Pedidos::listaPedidos');
$routes->get('historial-pedidos', 'Pedidos::historialPedidos');