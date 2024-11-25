<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\ImmeubleController;
use App\Admin\Controllers\StatisticController;
use app\Admin\Controllers\AdminContactController; 

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('immeuble', ImmeubleController::class);
    $router->get('statistics', [StatisticController::class, 'index'])->name('statistics.index');

    // Route pour la création de fiche de contact liée à un immeuble
//   $router->get('contacts/create/{id}', [AdminContactController::class, 'create'])->name('admin.contacts.create');
  // $router->post('contacts/store', [AdminContactController::class, 'store'])->name('admin.contacts.store');
});
