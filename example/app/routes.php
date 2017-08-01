<?php
use ThreeFrame\Router;
Router::get('test', 'App\Handles\HomeHandle@Index');
Router::get('test/(:num)', 'App\Handles\HomeHandle@Show');
Router::post('test', 'App\Handles\HomeHandle@Store');
Router::put('test', 'App\Handles\HomeHandle@Update');
Router::delete('test/(:num)', 'App\Handles\HomeHandle@Destroy');