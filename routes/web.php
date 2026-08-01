<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\FirmController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\ExcelController;
use App\Http\Controllers\backend\ClinicController;
use App\Http\Controllers\backend\PharmacyController;
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

use Illuminate\Support\Facades\Mail;

// Route::get('/mail-test', function () {
//     Mail::raw('Testing mail', function ($message) {
//         $message->to('archanakumari1257635@gmail.com')->subject('Testing');
//     });
//     return 'Done';
// });

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

    Route::post('subscription', [AuthController::class, 'subscription'])->name('subscription.expired');

});




Route::group(['middleware' => ['auth', 'subscription'], 'prefix' => 'admin'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/notify', [NotificationController::class, 'send'])->name('notify');
    Route::get('/export/{type?}', [ExcelController::class, 'export'])->name('admin.export');

    Route::group(['prefix' => 'authentication', 'middleware' => 'permission:authentication.view'], function () {
        Route::get('/', [RolePermissionController::class, 'index'])->name('authentication.index');
        Route::get('list', [RolePermissionController::class, 'authenticationList'])->name('authentication.list');
        Route::post('save', [RolePermissionController::class, 'roleSave'])->name('authentication.save');
        Route::post('permission/save', [RolePermissionController::class, 'permissionSave'])->name('permission.save');
        Route::post('role-permission/save', [RolePermissionController::class, 'rolePermissionSave'])->name('authentication.permission.save');
        
        Route::post('module/save', [RolePermissionController::class, 'saveModule'])->name('module.save');
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
        Route::get('/list', [CustomerController::class, 'list'])->name('customer.list');
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


    Route::group(['prefix' => 'subscription'], function () {
        Route::get('/', [MaintenanceController::class, 'subscription'])->name('subscription.expired');
    });


    Route::group(['prefix' => 'pharmacy'], function () {
        Route::group(['prefix' => 'parties'], function () {
            Route::get('/', [PharmacyController::class, 'parties'])->name('pharmacy.parties');
            Route::get('/create', [PharmacyController::class, 'partyCreate'])->name('pharmacy.parties.create');
            Route::post('/save', [PharmacyController::class, 'partySave'])->name('pharmacy.parties.save');
            
        });

        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', [PharmacyController::class, 'supplier'])->name('pharmacy.supplier');
            Route::get('/create', [PharmacyController::class, 'supplierCreate'])->name('pharmacy.supplier.create');
            Route::post('/save', [PharmacyController::class, 'supplierSave'])->name('pharmacy.supplier.save');
        });
            
        Route::group(['prefix' => 'vendor'], function () {
            Route::get('/', [PharmacyController::class, 'vendor'])->name('pharmacy.vendor');
            Route::get('/create', [PharmacyController::class, 'vendorCreate'])->name('pharmacy.vendor.create');
            Route::post('/save', [PharmacyController::class, 'vendorSave'])->name('pharmacy.vendor.save');
        });

        Route::group(['prefix' => 'madicine'], function () {
            Route::get('/', [PharmacyController::class, 'madicine'])->name('pharmacy.madicine');
            Route::get('/list', [PharmacyController::class, 'list'])->name('pharmacy.madicine.list');
            Route::get('/create', [PharmacyController::class, 'madicineCreate'])->name('pharmacy.madicine.create');
            Route::get('/save', [PharmacyController::class, 'madicineSave'])->name('pharmacy.madicine.save');
            Route::get('batch/create', [PharmacyController::class, 'batchCreate'])->name('pharmacy.madicine.batch.create');
            Route::get('batch/save', [PharmacyController::class, 'batchSave'])->name('pharmacy.madicine.batch.save');
        });

        Route::group(['prefix' => 'inventory'], function () {
            Route::get('/', [PharmacyController::class, 'inventory'])->name('pharmacy.inventory');
        });

        Route::group(['prefix' => 'purchase'], function () {
            Route::get('/', [PharmacyController::class, 'purchase'])->name('pharmacy.purchase');
        });

        Route::group(['prefix' => 'sales'], function () {
            Route::get('/', [PharmacyController::class, 'sales'])->name('pharmacy.sales');
        });

        Route::group(['prefix' => 'stock'], function () {
            Route::get('/', [PharmacyController::class, 'stock'])->name('pharmacy.stock');
        });

        Route::group(['prefix' => 'report'], function () {
            Route::get('/', [PharmacyController::class, 'report'])->name('pharmacy.report');
        });
    });
});




// React js
use Inertia\Inertia;
Route::get('/react', function () {return Inertia::render('Home', ['message' => 'Welcome to Hospital Management System','name' => 'Abhishek','age' => 25,]);});


