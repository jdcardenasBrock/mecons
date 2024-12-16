<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReferencesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\ProjectController;
use App\Models\clients;


use App\Http\Livewire\Construction\ProjectManagement;
use App\Http\Livewire\Construction\ProjectCosts;

use Spatie\Permission\Models\Role;
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

Route::get('/', function () {
    return view('auth.login');
})->name('welcome');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    Route::get('/crm', function () {
        return view('crm.managment');
    })->name("crm");

    Route::get('/new_task', function () {
        return view('crm.newTask');
    })->name("new_task");

    Route::get('/tasks/{taskId}/subtasks', function ($taskId) {
        return view('crm.newsubTask', ['taskId' => $taskId]);
    })->name("new_subtask");

    Route::get('/task_list', function () {
        return view('crm.taskList');
    })->name("task_list");

    Route::get('/project-management', function () {
        return view('construction.managment');
    })->name("project_Managment");

    Route::get('/add_project', function () {
        return view('construction.newProject');
    })->name("add_project");

    Route::get('/manage_project/{project_id}', function ($project_id) {
        return view('construction.manageProject', compact('project_id'));
    })->name("manage_project");
    Route::get('/qoute-search', [CotizacionController::class, 'searchQuote'])->name('qoute.search');



    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('references', ReferencesController::class);
    Route::get('datatable', [App\Http\Controllers\ReferencesController::class, 'anyData'])->name('datatables.data');
    Route::resource('permissions', PermissionController::class);
    Route::get('PermissionsData', [App\Http\Controllers\PermissionController::class, 'anyData'])->name('permissions.data');
    Route::resource('roles', RoleController::class);
    Route::get('/project/{project_id}/export-pdf', [ProjectController::class, 'exportProjectCostsPdf'])->name('project.export-pdf');
    Route::get('RollesData', [App\Http\Controllers\RoleController::class, 'anyData'])->name('roles.data');
    Route::resource('users', UserController::class);
    Route::get('UserData', [App\Http\Controllers\UserController::class, 'anyData'])->name('users.data');
    Route::get('references/assign/{id}', [App\Http\Controllers\ReferencesController::class, 'AssignID']);

    // Resources para el modulo de clientes

    Route::resource('clients', ClientsController::class);
    Route::get('datatableClients', [App\Http\Controllers\ClientsController::class, 'GetData'])->name('Clients.data');
    Route::get('detalleCliente/{id}', function ($id) {
        $client = clients::where('id', '=', $id)->first();
        return view('clients.detail', compact('id', 'client'));
    })->name('Clients.detalle');
    Route::get('equipo_clientes', function () {
        return view('clients.general');
    })->name('equipo_clientes');


    Route::get('/export-references', [App\Http\Controllers\ReferencesController::class, 'export'])->name('export.references');

    // Resources para el modulo de proveedores
    Route::resource('proveedores', ProvidersController::class);
    Route::get('datatableProveedores', [App\Http\Controllers\ProvidersController::class, 'GetData'])->name('Providers.data');
    Route::get('pdf', function () {
        return view('cotizacion.export_pdf');
    });
    //Resources para el modulo de cotizacion
    Route::resource('cotizacion', CotizacionController::class);
    Route::get('datatableCotizacion', [App\Http\Controllers\CotizacionController::class, 'getDataQoutes'])->name('Cotizacions.data');
    //Peticiones de ajax para modal de clientes
    Route::get('cotizacion/{id}/pdf', [App\Http\Controllers\CotizacionController::class, 'exportPdf'])->name('cotizacion.pdf');
    Route::get('cotizacion/{id}/preview', [App\Http\Controllers\CotizacionController::class, 'PreviewQoute'])->name('cotizacion.preview');

    Route::get('cotizacion/findGuest/{data}', [App\Http\Controllers\CotizacionController::class, 'findGuest'])->name('ajax.ruta.findClient');
    Route::get('ajax/request/showClients/{data}', [App\Http\Controllers\CotizacionController::class, 'getDataManyClients'])->name('ajax.request.showClients');
    Route::get('ajax/request/showClients', function () {
        return false;
    })->name('ajax.ruta.showClients');

    //Peticiones de ajax para modal de proveedores
    Route::get('cotizacion/findProvider/{data}', [App\Http\Controllers\CotizacionController::class, 'findProvider'])->name('ajax.ruta.findProvider');
    Route::get('ajax/request/showProvider/{data}', [App\Http\Controllers\CotizacionController::class, 'getDataManyProvider'])->name('ajax.request.showProvider');
    Route::get('ajax/request/showProvider', function () {
        return false;
    })->name('ajax.ruta.showProvider');
});
