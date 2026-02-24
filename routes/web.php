<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Controllers
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\frondend\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\frondend\DoctorsController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\frondend\AboutController as FrondendAboutController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\frondend\CareerController as FrondendCareerController;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\frondend\PharmacyController as FrondendPharmacyController;
use App\Http\Controllers\Admin\AmbulanceController;
use App\Http\Controllers\frondend\AmbulanceController as FrondendAmbulanceController;
use App\Http\Controllers\Admin\BloodBankController;
use App\Http\Controllers\frondend\BloodBankController as FrondendBloodBankController;
use App\Http\Controllers\Admin\DirectorsController;
use App\Http\Controllers\frondend\DirectorsController as FrondendDirectorsController;
use App\Http\Controllers\Admin\HealthPackagesController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\frondend\InsuranceController as FrondendInsuranceController;
use App\Http\Controllers\frondend\HealthPackageController;
use App\Http\Controllers\Admin\IcuController;
use App\Http\Controllers\frondend\IcuController as FrondendIcuController;
use App\Http\Controllers\Admin\SecondOpinionController;
use App\Http\Controllers\frondend\SecondOpinionController as FrondendSecondOpinionController;

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

// Admin Routes
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'auth.gates']  // Add 'web' and your custom middleware alias here
], function () {
    // Route::redirect('/', '/admin/report')->name('home');
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);
    // Block a user
    Route::put('users/{user}/block', [UsersController::class, 'block'])->name('users.block');

    // Unblock a user
    Route::put('users/{user}/unblock', [UsersController::class, 'unblock'])->name('users.unblock');

    // Banners
    Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('banners/store', [BannerController::class, 'store'])->name('banners.store');
    Route::post('banners/status-change/{id}', [BannerController::class, 'statusChange'])->name('banners.status.change');
    Route::get('banners/edit/{id}', [BannerController::class, 'edit'])->name('banners.edit');
    Route::post('banners/update/{id}', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('banners/destroy/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');
    //feature
    Route::resource('/feature', FeatureController::class);
    Route::resource('/department', DepartmentController::class);
    Route::resource('/doctor', DoctorController::class);
    Route::post('/doctor/status-change/{id}', [DoctorController::class, 'statusChange'])->name('doctor.status.change');
    Route::resource('/pages', PagesController::class);

    //about
    Route::get('/about/create/{id}', [AboutController::class, 'create'])->name('about.create');
    Route::post('/about/banner-store', [AboutController::class, 'bannerStore'])->name('about.banner.store');
    Route::post('/about/blog-store', [AboutController::class, 'blogStore'])->name('about.blog.store');
    Route::post('/about/content-store', [AboutController::class, 'contentStore'])->name('about.content.store');
    Route::post('/about/feature-store', [AboutController::class, 'featureStore'])->name('about.feature.store');
    Route::post('/about/sub_content-store', [AboutController::class, 'subContentStore'])->name('about.sub_content.store');
    Route::post('/about/mid_content-store', [AboutController::class, 'midContent'])->name('about.mid_content.store');
    Route::post('/about/section-store', [AboutController::class, 'sectionStore'])->name('about.section.store');

    Route::get('/about/edit/{id}', [AboutController::class, 'edit'])->name('about.edit');
    Route::post('about/banner/update/{id}', [AboutController::class, 'bannerUpdate'])->name('about.banner.update');
    Route::post('about/blog/update/{id}', [AboutController::class, 'blogUpdate'])->name('about.blog.update');
    Route::post('about/content/update/{id}', [AboutController::class, 'contentUpdate'])->name('about.content.update');
    Route::post('about/feature/update/{id}', [AboutController::class, 'featureUpdate'])->name('about.feature.update');
    Route::post('about/sub_content/update/{id}', [AboutController::class, 'subContentUpdate'])->name('about.sub_content.update');
    Route::post('about/mid_content/update/{id}', [AboutController::class, 'midContentUpdate'])->name('about.mid_content.update');
    Route::post('about/section/update/{id}', [AboutController::class, 'sectionUpdate'])->name('about.section.update');

    //career
    Route::get('/career/create/{id}', [CareerController::class, 'create'])->name('career.create');
    Route::post('/career/banner/store', [CareerController::class, 'store'])->name('career.banner.store');
    Route::post('/career/content/store', [CareerController::class, 'contentStore'])->name('career.content.store');
    Route::get('/career/edit/{id}', [CareerController::class, 'edit'])->name('career.edit');
    Route::post('/career/update/banner/{id}', [CareerController::class, 'update'])->name('career.update.banner');
    Route::post('/career/update/content/{id}', [CareerController::class, 'contentUpdate'])->name('career.update.content');

    Route::get('/pharmacy/create/{id}', [PharmacyController::class, 'create'])->name('pharmacy.create');
    Route::post('/pharmacy/banner/store', [PharmacyController::class, 'store'])->name('pharmacy.banner.store');
    Route::post('/pharmacy/content/store', [PharmacyController::class, 'pharmacyStore'])->name('pharmacy.content.store');
    Route::post('/pharmacy/plans/store', [PharmacyController::class, 'pharmacyPlanStore'])->name('pharmacy.plans.store');
    Route::get('/pharmacy/edit/{id}', [PharmacyController::class, 'edit'])->name('pharmacy.edit');
    Route::post('/pharmacy/update/{id}', [PharmacyController::class, 'update'])->name('pharmacy.update');
    Route::post('/pharmacy/content/update/{id}', [PharmacyController::class, 'contentUpdate'])->name('pharmacy.content.update');
    Route::post('/pharmacy/plan/update/{id}', [PharmacyController::class, 'pharmacyPlanUpdate'])->name('pharmacy.plan.update');

    // Ambulance
    Route::get('/ambulance/create/{id}', [AmbulanceController::class, 'create'])->name('ambulance.create');
    Route::post('/ambulance/store', [AmbulanceController::class, 'store'])->name('ambulance.store');
    Route::post('/ambulance/content/store', [AmbulanceController::class, 'storeContent'])->name('ambulance.content.store');
    Route::get('/ambulance/edit/{id}', [AmbulanceController::class, 'edit'])->name('ambulance.edit');
    Route::post('/ambulance/update/{id}', [AmbulanceController::class, 'update'])->name('ambulance.update');
    Route::post('/ambulance/content/update/{id}', [AmbulanceController::class, 'updateContent'])->name('ambulance.content.update');

    // Blood Bank
    Route::get('/blood-bank/create/{id}', [BloodBankController::class, 'create'])->name('blood_bank.create');
    Route::post('/blood-bank/store', [BloodBankController::class, 'store'])->name('blood_bank.store');
    Route::post('/blood-bank/content/store', [BloodBankController::class, 'contentStore'])->name('blood_bank.content.store');
    Route::post('/blood-bank/blood-group/store', [BloodBankController::class, 'bloodGroupStore'])->name('blood_bank.blood_group.store');
    Route::get('/blood-bank/edit/{id}', [BloodBankController::class, 'edit'])->name('blood_bank.edit');
    Route::post('/blood-bank/update/{id}', [BloodBankController::class, 'update'])->name('blood_bank.update');
    Route::post('/blood-bank/content/update/{id}', [BloodBankController::class, 'contentUpdate'])->name('blood_bank.content.update');
    Route::post('/blood-bank/blood-group/update/{id}', [BloodBankController::class, 'bloodGroupUpdate'])->name('blood_bank.blood_group.update');

    // Directors
    Route::get('/directors/create/{id}', [DirectorsController::class, 'create'])->name('directors.create');
    Route::post('/directors/store', [DirectorsController::class, 'store'])->name('directors.store');
    Route::post('/directors/blog/store', [DirectorsController::class, 'blogStore'])->name('directors.blog.store');
    Route::get('/directors/edit/{id}', [DirectorsController::class, 'edit'])->name('directors.edit');
    Route::post('/directors/update/{id}', [DirectorsController::class, 'update'])->name('directors.update');
    Route::post('/directors/blog/update/{id}', [DirectorsController::class, 'blogUpdate'])->name('directors.blog.update');

    // Health Packages
    Route::get('/health-packages/create/{id}', [HealthPackagesController::class, 'create'])->name('health-packages.create');
    Route::post('/health-packages/store', [HealthPackagesController::class, 'store'])->name('health_packages.store');
    Route::post('/health-packages/content/store', [HealthPackagesController::class, 'ContentStore'])->name('health_packages.content.store');
    Route::post('/health-packages/blog/store', [HealthPackagesController::class, 'blogStore'])->name('health_packages.blog.store');
    Route::get('/health-packages/edit/{id}', [HealthPackagesController::class, 'edit'])->name('health-packages.edit');
    Route::post('/health-packages/update/{id}', [HealthPackagesController::class, 'update'])->name('health_packages.update');
    Route::post('/health-packages/content/update/{id}', [HealthPackagesController::class, 'ContentUpdate'])->name('health_packages.content.update');


    // Insurance
    Route::get('/insurance/create/{id}', [InsuranceController::class, 'create'])->name('insurance.create');
    Route::post('/insurance/store', [InsuranceController::class, 'store'])->name('insurance.store');
    Route::post('/insurance/content/store', [InsuranceController::class, 'ContentStore'])->name('insurance.content.store');
    Route::get('/insurance/edit/{id}', [InsuranceController::class, 'edit'])->name('insurance.edit');
    Route::post('/insurance/update/{id}', [InsuranceController::class, 'update'])->name('insurance.update');
    Route::post('/insurance/content/update/{id}', [InsuranceController::class, 'ContentUpdate'])->name('insurance.content.update');

    // ICU
    Route::get('/icu/create/{id}', [IcuController::class, 'create'])->name('icu.create');
    Route::post('/icu/store', [IcuController::class, 'store'])->name('icu.store');
    Route::post('/icu/menu/store', [IcuController::class, 'MenuStore'])->name('icu.menu.store');
    Route::post('/icu/content/store', [IcuController::class, 'contentStore'])->name('icu.content.store');
    Route::get('/icu/edit/{id}', [IcuController::class, 'edit'])->name('icu.edit');

    Route::get('second-opinion/create/{id}', [SecondOpinionController::class, 'create'])->name('second-opinion.create');
    Route::post('second-opinion/store', [SecondOpinionController::class, 'store'])->name('second-opinion.store');
    Route::post('second-opinion/content/store', [SecondOpinionController::class, 'contentStore'])->name('second-opinion.content.store');
    Route::get('second-opinion/edit/{id}', [SecondOpinionController::class, 'edit'])->name('second-opinion.edit');
    Route::post('second-opinion/update/{id}', [SecondOpinionController::class, 'update'])->name('second-opinion.update');
    Route::post('second-opinion/content/update/{id}', [SecondOpinionController::class, 'contentUpdate'])->name('second-opinion.content.update');
});


// Profile / Change Password Routes
Route::group([
    'prefix' => 'profile',
    'as' => 'profile.',
    'middleware' => ['web', 'auth', 'auth.gates']  // Same here for profile routes
], function () {
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
    }
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors.index');
Route::get('/doctors', [DoctorsController::class, 'search'])
    ->name('doctor.search');
Route::get('/about', [FrondendAboutController::class, 'index'])->name('about.index');
Route::get('/career', [FrondendCareerController::class, 'index'])->name('career.index');
Route::get('/pharmacy', [FrondendPharmacyController::class, 'index'])->name('pharmacy.index');
Route::get('/ambulance', [FrondendAmbulanceController::class, 'index'])->name('ambulance.index');
Route::get('/blood-bank', [FrondendBloodBankController::class, 'index'])->name('blood_bank.index');
Route::get('/directors', [FrondendDirectorsController::class, 'index'])->name('directors.index');
Route::get('/insurance', [FrondendInsuranceController::class, 'index'])->name('insurance.index');
Route::get('/health-packages', [HealthPackageController::class, 'index'])->name('health_packages.index');
Route::get('/icu', [FrondendIcuController::class, 'index'])->name('icu.index');
Route::get('/second-opinion', [FrondendSecondOpinionController::class, 'index'])->name('second_opinion.index');
Route::get('get-doctors/{department}', [FrondendSecondOpinionController::class, 'getDoctors']);
Route::get('/get-doctor-details/{id}', [FrondendSecondOpinionController::class, 'getDoctorDetails']);
// Route::get('/get-doctors-list', [FrondendSecondOpinionController::class, 'dotors']);
