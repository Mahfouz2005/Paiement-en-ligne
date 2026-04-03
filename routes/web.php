<?php
use App\Http\Controllers\PaiementsController;
use Illuminate\Support\Facades\Route;

/**Route::get('/', function () {
    return view('welcome');
});**/
Route::get('/', [PaiementsController::class, 'formulaire'])->name('payment.form');
Route::post('/paiement/process', [PaiementsController::class, 'Accespaiement'])->name('payment.process');
Route::get('/paiement/success', [PaiementsController::class, 'Reussite'])->name('payment.success');
Route::get('/paiement/cancel', [PaiementsController::class, 'Annuler'])->name('payment.cancel');
// Pour les webhooks (si vous préférez les notifications serveur)
Route::post('/paiement/webhook', [PaiementsController::class, 'webhook'])->name('payment.webhook');
