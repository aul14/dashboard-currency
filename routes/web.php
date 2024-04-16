<?php

use App\Http\Controllers\AirExportBookingController;
use App\Http\Controllers\AirExportJobController;
use App\Http\Controllers\AirImJobController;
use App\Http\Controllers\AirLineController;
use App\Http\Controllers\AirPortController;
use App\Http\Controllers\AirQuotationController;
use App\Http\Controllers\BisnisPartyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ChargeCodeController;
use App\Http\Controllers\ChargeTableController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CommodityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\CostTableController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataAjaxController;
use App\Http\Controllers\DeliveryTypeController;
use App\Http\Controllers\IncotermsController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PartyTypeController;
use App\Http\Controllers\PaymentTermController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\QuotationTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesmanController;
use App\Http\Controllers\SeaExportBookingController;
use App\Http\Controllers\SeaExportJobController;
use App\Http\Controllers\SeaImJobControlller;
use App\Http\Controllers\SeaQuotationController;
use App\Http\Controllers\ShippingLineController;
use App\Http\Controllers\SystemNumberingController;
use App\Http\Controllers\UomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VatCodeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\WtCodeController;
use App\Models\SeaQuotation;

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

Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'prevent-back-history']], function () {
	Route::get('/', [HomeController::class, 'index']);
	Route::resource('/users', UserController::class);
	Route::resource('/modules', ModuleController::class);
	Route::resource('/roles', RoleController::class);
	Route::resource('/permissions', PermissionController::class);
	Route::get('/home', [HomeController::class, 'index']);
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::get('/roles_access/{id}', [RoleController::class, 'roles_access'])->name('roles.access');
	Route::get('users/{user}/update-password', [UserController::class, 'reset_password'])->name('reset.password');
	Route::post('attach-permission/{role_id}', [PermissionController::class, 'attachPermission'])->name('permission.attach');
	Route::post('detach-permission/{role_id}', [PermissionController::class, 'detachPermission'])->name('permission.detach');
});
