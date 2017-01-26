<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//ADMIN
//login
$route['admin']['get'] = 'admin/index';
$route['admin']['post'] = 'admin/process_login';
//logout
$route['admin/dashboard/salir'] = 'dashboard/logout';
//dashboard
$route['admin/panel'] = 'dashboard';
//categories
$route['admin/categorias'] = 'category';
$route['admin/categorias/crear']['get'] = 'category/add';
$route['admin/categorias/crear']['post'] = 'category/add_process';
$route['admin/categorias/editar/(:num)']['get'] = 'category/edit/$1';
$route['admin/categorias/editar/(:num)']['post'] = 'category/edit_process/$1';
$route['admin/categorias/ajax_list'] = 'category/ajax_list';
$route['admin/categorias/eliminar/(:num)']['post'] = 'category/ajax_delete/$1';
//books
$route['admin/libros'] = 'book';
$route['admin/libros/crear']['get'] = 'book/add';
$route['admin/libros/crear']['post'] = 'book/add_process';
$route['admin/libros/editar/(:num)']['get'] = 'book/edit/$1';
$route['admin/libros/editar/(:num)']['post'] = 'book/edit_process/$1';
$route['admin/libros/ajax_list'] = 'book/ajax_list';
$route['admin/libros/eliminar/(:num)']['post'] = 'book/ajax_delete/$1';
$route['admin/libros/autores']['get'] = 'book/get_author_list/';
$route['admin/libros/agregar_autor'] = 'book/ajax_add_author';
//authors
$route['admin/autores'] = 'author';
$route['admin/autores/crear']['get'] = 'author/add';
$route['admin/autores/crear']['post'] = 'author/add_process';
$route['admin/autores/editar/(:num)']['get'] = 'author/edit/$1';
$route['admin/autores/editar/(:num)']['post'] = 'author/edit_process/$1';
$route['admin/autores/ajax_list'] = 'author/ajax_list';
$route['admin/autores/eliminar/(:num)']['post'] = 'author/ajax_delete/$1';