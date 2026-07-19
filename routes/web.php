<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\FirmController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\ClinicController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\HospitalController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\backend\MaintenanceController;
use App\Http\Controllers\backend\FeaturePlanController;
use App\Http\Controllers\backend\NotificationController;
use App\Http\Controllers\backend\SubscriptionController;
use App\Http\Controllers\backend\RolePermissionController;

use App\Http\Controllers\frontend\FrontendController;

// Blade 
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [FrontendController::class, 'index']);
    Route::get('doctors', [FrontendController::class, 'doctors']);
    Route::get('appointment', [FrontendController::class, 'bookAppointment'])->name('appointment');
    Route::get('testimonials', [FrontendController::class, 'testimonials']);
    Route::get('terms-conditions', [FrontendController::class, 'termsConditions']);
    Route::get('privacy-policy', [FrontendController::class, 'privacyPolicy']);
    Route::get('about', [FrontendController::class, 'about']);
    Route::get('contact', [FrontendController::class, 'contact']);
    Route::get('blog', [FrontendController::class, 'blog']);
    Route::get('consultation', [FrontendController::class, 'generalConsultation']);
    Route::get('dental-care', [FrontendController::class, 'dentalCare']);
    Route::get('pediatric-care', [FrontendController::class, 'pediatricCare']);
    Route::get('cardiology', [FrontendController::class, 'cardiology']);
    Route::get('dermatology', [FrontendController::class, 'dermatology']);
    Route::get('orthopedics', [FrontendController::class, 'orthopedics']);
    Route::get('neurology', [FrontendController::class, 'neurology']);
    Route::get('gynecology', [FrontendController::class, 'gynecology']);
    Route::get('ophthalmology', [FrontendController::class, 'ophthalmology']);
    Route::get('psychiatry', [FrontendController::class, 'psychiatry']);
    Route::get('urology', [FrontendController::class, 'urology']);
    Route::get('radiology', [FrontendController::class, 'radiology']);
    Route::get('emergency-care', [FrontendController::class, 'emergencyCare']);
    Route::get('laboratory-services', [FrontendController::class, 'laboratoryServices']);
    Route::get('pharmacy', [FrontendController::class, 'pharmacy']);
    Route::get('imaging-services', [FrontendController::class, 'imagingServices']);
    Route::get('rehabilitation-services', [FrontendController::class, 'rehabilitationServices']);
    Route::get('women_child_care', [FrontendController::class, 'womenAndChildCare']);
    Route::get('diagnostic', [FrontendController::class, 'diagnostic']);
    Route::get('surgery', [FrontendController::class, 'surgery']);
    Route::get('wellness', [FrontendController::class, 'wellness']);
    Route::get('home_care', [FrontendController::class, 'homeCare']);

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('auth', [AuthController::class, 'auth'])->name('auth');

});




Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/notify', [NotificationController::class, 'send'])->name('notify');

    Route::group(['prefix' => 'authentication', 'middleware' => 'permission:authentication.view'], function () {
        Route::get('/', [RolePermissionController::class, 'index'])->name('authentication.index');
        Route::get('list', [RolePermissionController::class, 'permissionManagement'])->name('authentication.list');
        Route::post('save', [RolePermissionController::class, 'roleSave'])->name('authentication.save');
        Route::post('permission/save', [RolePermissionController::class, 'permissionSave'])->name('permission.save');
        Route::post('role-permission/save', [RolePermissionController::class, 'rolePermissionSave'])->name('authentication.permission.save');
    });

    Route::group(['prefix' => 'module', 'middleware' => 'permission:modules.view'], function () {
        Route::post('save', [RolePermissionController::class, 'saveModule'])->name('module.save');
        Route::post('child/module/save', [RolePermissionController::class, 'saveChileModule'])->name('child.module.save');
        Route::get('child/{parent_id}', [RolePermissionController::class, 'childModule'])->name('child.module.get');
        Route::get('module', [RolePermissionController::class, 'getModule'])->name('module.get');
    });


    Route::group(['prefix' => 'plans', 'middleware' => 'permission:plan.view'], function () {
        Route::get('/', [FeaturePlanController::class, 'index'])->name('plan.index');
        Route::get('/list', [FeaturePlanController::class, 'list'])->name('plan.list');
        Route::post('/save', [FeaturePlanController::class, 'save'])->name('plan.save');
        Route::post('feature/save', [FeaturePlanController::class, 'featureSave'])->name('plan.feature.save');
        Route::post('plan-feature/save', [FeaturePlanController::class, 'planFeatureMapping'])->name('plan.feature.mapping.save');
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'permission:customer.view'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::get('/state/{country_id}', [CustomerController::class, 'getStates'])->name('customer.state');
        Route::get('/city/{state_id}', [CustomerController::class, 'getCities'])->name('customer.city');
        Route::post('/save', [CustomerController::class, 'save'])->name('customer.save');
    });

    
    Route::group(['prefix' => 'hospitals', 'middleware' => 'permission:hospital.view'], function () {
        Route::get('/', [HospitalController::class, 'index'])->name('hospital.index');
        Route::get('list', [HospitalController::class, 'list'])->name('hospital.list');
    });


    Route::group(['prefix' => 'departments', 'middleware' => 'permission:department.view'], function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('department.index');
        Route::get('list', [DepartmentController::class, 'list'])->name('department.list');
    });


    Route::group(['prefix' => 'subscriptions', 'middleware' => 'permission:subscription.view'], function () {
        Route::get('/', [SubscriptionController::class, 'index'])->name('subscription.index');
        Route::get('list', [SubscriptionController::class, 'list'])->name('subscription.list');
    });


    Route::group(['prefix' => 'maintenances', 'middleware' => 'permission:maintenance.view'], function () {
        Route::get('/', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::post('/route', [MaintenanceController::class, 'route'])->name('maintenance.route');
        Route::post('/cache', [MaintenanceController::class, 'cache'])->name('maintenance.cache');
        Route::post('/config', [MaintenanceController::class, 'config'])->name('maintenance.config');
        Route::post('/optimize', [MaintenanceController::class, 'optimizer'])->name('maintenance.optimize');
    });
});




// React js
use Inertia\Inertia;
Route::get('/react', function () {
    return Inertia::render('Home', [
        'message' => 'Welcome to Hospital Management System',
        'name' => 'Abhishek',
        'age' => 25,
    ]);
});



