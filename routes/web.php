<?php

use App\Http\Controllers\Admin\AdministratorController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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
    return redirect()->route('login');
})->middleware('guest');

Route::namespace('App\Http\Controllers\Admin')->group(function(){

    Route::middleware(['auth', 'verified'])->prefix('admin')->group(function(){
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
        Route::middleware('can:view_settings')->controller(SiteController::class)->group(function(){
            Route::get('/settings', 'getSettings')->name('settings');
            Route::get('/settings/{group}', 'edit')->name('settings.group');
            Route::post('/settings', 'update')->name('settings.group.update');
        });
        
        Route::resource('/manage-plan', PlanController::class)->middleware('can:view_plans');
    }); // prefix ends 

    // Roles
    Route::group(['middleware' => ['can:view_roles']], function () {
        Route::resource('roles', RoleController::class);
    });
    Route::resource('administrators', AdministratorController::class);
});



require __DIR__.'/auth.php';
