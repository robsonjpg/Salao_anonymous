<?php

use Illuminate\Support\Facades\Route;

//Organizar as Rotas de Admin
//      ||
//      \/
Route::prefix('admin')
            ->namespace('Admin')
            ->group(function(){

    /**
     * Routes Details Plans
     */
    
    //Cadastrar Novo Detalhe Plano
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');

    //Listar os Detalhes do Plano
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');

    /**
     * Routes Plans
     */

    //Organizar Rota e Preparar Listagem dos Planos
    //digite no terminal: php artisan make:controller PlanController 
    Route::get('plans', 'PlanController@index')->name('plans.index');

    Route::get('/', function () {
        return view('welcome');
    });

    //Cadastrando um novo plano -- esse tem que vir antes dos plans/{url}
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    //Rota para cadastrar
    Route::post('plans', 'PlanController@store')->name('plans.store');

    //Pesquisar um plano - Filtrar ---> OBSERVAÇÃO: ESSA ROTA PRECISA ESTAR SEMPRE ANTES DA SHOW
    Route::any('plans/search', 'PlanController@search')->name('plans.search');

    //Mostrar detalhes do plano ao clicar em VER
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');

    //Deletar um plano
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');

    //Editando um plano
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');

    /**
     * Home Dashboard
     */

    //Breadcrumb - aquele negócio em cima
    Route::get('/', 'PlanController@index')->name('admin.index');

});





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/