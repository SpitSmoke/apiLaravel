<?php
// dd('API routes carregadas');


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui você registra suas rotas de API. Elas já virão com o prefixo "/api"
| e o middleware "api" por padrão, via o RouteServiceProvider.
|
*/

Route::apiResource('tasks', TaskController::class);
