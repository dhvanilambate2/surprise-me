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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeForSaleController;
use App\Http\Controllers\HomeForRentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;





Auth::routes();
Route::get('login', [DashboardController::class, 'login'])->name('admin.login');



Route::get('/', [FrontendController::class, 'index'])->name('/');
// Route::get('/', [DashboardController::class, 'login'])->name('/');


//,'user-access:superAdmin'
Route::middleware(['auth','user-access:superAdmin|admin|vendor'])->group(function () {
    Route::prefix('admin')->group(function () {

        // dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('default');
        Route::resource('dashboard', DashboardController::class);

        Route::resource('users', UserController::class);
        Route::post('categories/update/{id}',[CategoryController::class,'update'])->name('categories.update');
        Route::post('categories/image_store',[CategoryController::class,'imgStore'])->name('categories.imgStore');
        Route::resource('categories', CategoryController::class);
        Route::resource('vendor_shop', VendorShopController::class);
        Route::resource('vendors', VendorController::class);
        
        Route::post('sercices/updated_status/{id}', [ServiceController::class, 'updateStatus'])->name('admin.services.update_status');
        Route::resource('services', ServiceController::class);

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionsController::class);

        Route::get('profile', [ProfileController::class,'index']);
        Route::get('profile/edit', [ProfileController::class,'edit']);
        Route::put('profile/update/{id}', [ProfileController::class, 'update']);
        Route::post('password/update/{id}', [ProfileController::class, 'passwordUpdate']);

        // setting -> home -> team
        Route::post('setting_home/update_current_four', [SettingHomeController::class, 'updateCurrentFour'])->name('setting_home.update_current_four');
        Route::post('setting_home/team_image_store',[SettingHomeController::class,'teamImgStore'])->name('setting_home.teamImgStore');
        Route::get('setting_home/team_create', [SettingHomeController::class,'teamCreaet'])->name('setting_home.team_create');
        Route::post('setting_home/team_store', [SettingHomeController::class,'teamStore'])->name('setting_home.team_store');
        Route::delete('setting_home/team/{team}', [SettingHomeController::class, 'teamDestroy'])->name('setting_home.team_destroy');
        Route::get('setting_home/team/{team}/edit', [SettingHomeController::class, 'teamEdit'])->name('setting_home.team_edit');
        Route::put('setting_home/team/{team}', [SettingHomeController::class, 'teamUpdate'])->name('setting_home.team_update');
        
        // setting -> home -> review 
        Route::get('setting_home/review_create', [SettingHomeController::class,'reviewCreaet'])->name('setting_home.review_create');
        Route::post('setting_home/review_store', [SettingHomeController::class,'reviewStore'])->name('setting_home.review_store');
        Route::delete('setting_home/review/{review}', [SettingHomeController::class, 'reviewDestroy'])->name('setting_home.review_destroy');
        Route::get('setting_home/review/{review}/edit', [SettingHomeController::class, 'reviewEdit'])->name('setting_home.review_edit');
        Route::put('setting_home/review/{review}', [SettingHomeController::class, 'reviewUpdate'])->name('setting_home.review_update');

        // setting -> home
        Route::resource('setting_home', SettingHomeController::class);

        // setting -> site setting
        Route::resource('setting_site', SettingSiteController::class);
        
        // Home Section 
        Route::resource('home_section', HomeSectionController::class);
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
    Artisan::call('make:migration create_services_table');
    return "MIGRATE TABLE";
})->name('migrate_table');

Route::get('/make_model', function () {
    Artisan::call('make:model Services -m');
    return "MIGRATE MODEL";
})->name('model');

Route::get('/make_controller', function () {
    Artisan::call('make:controller ServiceController');
    return "MIGRATE CONTROLLER ";
})->name('controller');



    Route::get('/make-mail', function () {
    Artisan::call('make:mail InquiryReceived');
    return "successfully";
})->name('dashboard-controller');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/category', [App\Http\Controllers\HomeController::class, 'category'])->name('category');
Route::get('/shop', [App\Http\Controllers\HomeController::class, 'vendor'])->name('vendor');
Route::get('/service-listing', [App\Http\Controllers\HomeController::class, 'productlisting'])->name('product-listing');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');