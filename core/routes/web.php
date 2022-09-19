<?php

use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\BonusPlanController;
use Inertia\Inertia;
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
        
        Route::resource('/manage-plan', PlanController::class)->middleware('can:view_plans')->only(['index', 'store']);
        Route::middleware('can:view_administrators')->group(function() {
            Route::get('/referral', [\App\Http\Controllers\Admin\AdminController::class, 'referrals'])->name('referral');
            Route::post('/referral', [\App\Http\Controllers\Admin\AdminController::class, 'referralsUpdate'])->name('referral');
            Route::get('/referral/status/{setting}', [\App\Http\Controllers\Admin\AdminController::class, 'statusChanger'])->name('referral.status');
        });
        
    }); // prefix ends 

    // Roles
    Route::group(['middleware' => ['can:view_roles']], function () {
        Route::resource('roles', RoleController::class);
    });
    Route::resource('administrators', AdministratorController::class)->middleware('can:view_administrators');
    Route::resource('bonus-plans', App\Http\Controllers\Admin\BonusPlanController::class)->only(['index', 'store'])->middleware('can:view_administrators');
    Route::resource('user-bonus', App\Http\Controllers\Admin\UserBonusController::class)->only(['index'])->middleware('can:view_user_bonus');
    Route::post('user-bonus/changeAll', [App\Http\Controllers\Admin\UserBonusController::class, 'changeAll'])->middleware('can:view_user_bonus')->name('user-bonus.changeAll');

});



require __DIR__.'/auth.php';