<?php

use App\Http\Controllers\ContactController;
use App\Services\SitePaletteService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('portfolio', [
        'sitePalettes' => SitePaletteService::palettesForFeatured(),
    ]);
})->name('home');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');
