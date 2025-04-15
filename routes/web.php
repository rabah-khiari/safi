<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\ExtinguisherController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [AuthController::class, 'dashboard']);//this automaticaly redirect user to login page if not login 
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [ClientsController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientsController::class, 'store'])->name('clients.store');
Route::get('/clients/{client_id}/edit', [ClientsController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client_id}', [ClientsController::class, 'update'])->name('clients.update');

Route::get('/interventions', [InterventionController::class, 'index'])->name('interventions.index');
Route::get('/interventions/create', [InterventionController::class, 'create'])->name('interventions.create');
Route::get('/interventions/create/{intervention_id}', [InterventionController::class, 'create'])->name('interventions.create');
Route::post('/interventions/store', [InterventionController::class, 'store'])->name('interventions.store');
Route::delete('/interventions/destroy/{intervention_id}', [InterventionController::class, 'destroy'])->name('interventions.destroy');


Route::resource('extincteur', ExtinguisherController::class);

Route::resource('purchases', PurchaseController::class);
Route::get('/purchases/create/{client_id}', [PurchaseController::class, 'create'])->name('clients.update');


Route::get('/clients/{client_id}/details', [ClientsController::class, 'showPurchasesAndInterventions'])->name('clients.details');


});//authentication 