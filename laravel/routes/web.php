<?php

use App\Http\Controllers\PaperController;
use Illuminate\Support\Facades\Route;

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

Route::resource('papers', PaperController::class);
Route::get('/papers/{id}/pdf', [PaperController::class, 'downloadPdf'])->name('papers.pdf.download');

Route::redirect('/', route('papers.index'));

Route::get('/health-check', function () {
    return 'OK';
});
