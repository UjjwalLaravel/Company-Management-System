<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TendersController;
use App\Http\Controllers\PGController;
use App\Http\Controllers\ProjectMilestoneController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;

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
});

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('home');
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('profile/', [AdminController::class, 'dashboard'])->name('profile.show');

Route::get('tenders-in-process', [TendersController::class, 'in_progess_list'])->name('tenders_list');
Route::get('add-tender', [TendersController::class, 'add_tender'])->name('add-tender');
Route::get('edit-tender/{tender_id}', [TendersController::class, 'edit_tender'])->name('edit-tender');
Route::get('tender/{id}', [TendersController::class, 'show_tender'])->name('tender');
Route::get('award-tender/{id}', [TendersController::class, 'award_tender'])->name('award-tender');
Route::get('not-award-tender/{id}', [TendersController::class, 'not_award_tender'])->name('not-award-tender');
Route::get('add-award-details/{tender_id}', [TendersController::class, 'add_award_details'])->name('add-award-details');
Route::get('edit-award-details/{tender_id}', [TendersController::class, 'edit_award_details'])->name('edit-award-details');
Route::post('add_tender_data', [TendersController::class, 'add_tender_data'])->name('add_tender_data');
Route::post('edit_tender_data/{tender_id}', [TendersController::class, 'edit_tender_data'])->name('edit_tender_data');
Route::post('add_award_details_data', [TendersController::class, 'add_award_details_data'])->name('add_award_details_data');
Route::post('edit_award_details_data/{tender_id}', [TendersController::class, 'edit_award_details_data'])->name('edit_award_details_data');
Route::get('delete-tender/{id}', [TendersController::class, 'delete'])->name('delete-tender');



// PG
Route::get('add-pg/{id}', [PGController::class, 'add_pg'])->name('add-pg');
Route::post('add_pg_data', [PGController::class, 'add_pg_data'])->name('add_pg_data');
Route::get('set-pg-status/{status}/{id}', [TendersController::class, 'change_pg_status'])->name('set-pg-status');

// Milestones
Route::get('add-milestone/{tender_id}', [ProjectMilestoneController::class, 'add_milestone'])->name('add-milestone');
Route::get('delete-milestone/{id}', [ProjectMilestoneController::class, 'delete'])->name('delete-milestone');
Route::post('add_milestone_data', [ProjectMilestoneController::class, 'add_milestone_data'])->name('add_milestone_data');

// Payment
Route::get('add-payment/{tender_id}', [PaymentController::class, 'add_payment'])->name('add-payment');
Route::get('edit-payment/{tender_id}', [PaymentController::class, 'edit_payment'])->name('edit-payment');
Route::post('edit_payment_data/{payment_id}', [PaymentController::class, 'edit_payment_data'])->name('edit_payment_data');
Route::post('add_payment_data', [PaymentController::class, 'add_payment_data'])->name('add_payment_data');
Route::get('delete-payment/{id}', [PaymentController::class, 'delete'])->name('delete-payment');

// Staff
Route::resource('staff', StaffController::class);

require __DIR__.'/auth.php';
