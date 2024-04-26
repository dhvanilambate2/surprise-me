<?php

use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeSectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SettingSiteController;
use App\Http\Controllers\InquiriesController;
use App\Http\Controllers\SettingHomeController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\HomeForSaleController;
use App\Http\Controllers\HomeForRentController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;





Auth::routes();
Route::get('login', [DashboardController::class, 'login'])->name('admin.login');




Route::get('/', [DashboardController::class, 'login'])->name('/');


//,'user-access:superAdmin'
Route::middleware(['auth','user-access:superAdmin|admin'])->group(function () {
    Route::prefix('admin')->group(function () {

        // dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('default');
        Route::resource('dashboard', DashboardController::class);

        Route::resource('users', UserController::class);
        
  
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionsController::class);

        Route::get('profile', [ProfileController::class,'index']);
        Route::get('profile/edit', [ProfileController::class,'edit']);
        Route::put('profile/update/{id}', [ProfileController::class, 'update']);

    

    });
});





Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return "MIGRATE";
})->name('migrate');

Route::get('/migrate_table', function () {
    Artisan::call('make:migration add_column_current_four_in_teams_table');
    return "MIGRATE TABLE";
})->name('migrate_table');

Route::get('/make_model', function () {
    Artisan::call('make:model Wishlist -m');
    return "MIGRATE MODEL";
})->name('model');

Route::get('/make_controller', function () {
    Artisan::call('make:controller WishlistController');
    return "MIGRATE CONTROLLER ";
})->name('controller');



    Route::get('/make-mail', function () {
    Artisan::call('make:mail InquiryReceived');
    return "successfully";
})->name('dashboard-controller');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
