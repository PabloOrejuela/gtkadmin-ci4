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
$routes->get('mi-web', 'Home::miWeb');
$routes->get('mi-web/(:num)/(:any)', 'Home::miWeb/$1/$2');

//USUARIOS
$routes->get('new-member', 'Usuarios::registrarNuevoMiembro');
$routes->post('new-member-insert', 'Usuarios::insertNuevoMiembro');
$routes->get('perfil/(:num)', 'Usuarios::perfil/$1');
$routes->post('edit-profile', 'Usuarios::editProfile');

//Pedidos
$routes->get('new-order', 'Pedidos::registraNuevoPedido');
$routes->post('new-order', 'Pedidos::insertNuevoPedido');
$routes->get('get-paquete', 'Pedidos::getPaquete');
$routes->get('lista-pedidos', 'Pedidos::historialPedidos'); //Cambiar por lista de pedidos
$routes->get('historial-pedidos', 'Pedidos::historialPedidos');

//Mi billetera
$routes->get('my-wallet', 'BilleteraDigital::index');
$routes->get('updateCantidadAhorro', 'BilleteraDigital::updateCantidadAhorro');
$routes->get('transferirBirAhorro', 'BilleteraDigital::transferirBirAhorro');

//MI EQUIPO
$routes->get('lista-miembros', 'Usuarios::listaMiembros');
$routes->get('tanque-reserva', 'Usuarios::tanqueReserva');
$routes->get('getSocios', 'Usuarios::getSocios');
$routes->get('lista-binaria', 'Usuarios::listaBinaria');
$routes->get('arbol-binario', 'Usuarios::arbolBinario');
$routes->get('setPosition', 'Usuarios::setPosition');

//RANGOS
$routes->get('historial-rango', 'Rangos::historialRangos');
$routes->get('progreso-rango', 'Rangos::progresoRangos');


//ADMINISTRACIÓN
$routes->get('admin-socios-list', 'Administracion::listaMiembros');
$routes->get('reporte-pagos-socios', 'Administracion::reportePagosSocios');
$routes->get('registrarPagoRecompra', 'Administracion::registrarPagoRecompra');

//SOCIOS
$routes->get('tablero-lideres', 'Usuarios::tablerolideres');

