<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TicketController;
  
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
  
Route::get('/', [AuthController::class, 'index'])->name('index');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('assign_ticket', [TicketController::class, 'assign_ticket'])->name('assign_ticket'); 
Route::get('my_ticket', [TicketController::class, 'my_ticket'])->name('my_ticket'); 
Route::get('ticket_view/{id}', [TicketController::class, 'ticket_view'])->name('ticket.view'); 
Route::get('ticket_close/{id}', [TicketController::class, 'ticket_close'])->name('ticket.close'); 
Route::get('create_ticket', [TicketController::class, 'create_ticket'])->name('create_ticket'); 
Route::post('ticket_store', [TicketController::class, 'ticket_store'])->name('ticket.store'); 