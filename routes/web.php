<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

// Ruta de bienvenida (si tienes una página principal)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Ejemplo de rutas web para vistas que podrían usarse en Blade
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Si en el futuro necesitas autenticación en la web, lo harías aquí
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
