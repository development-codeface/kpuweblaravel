<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Controllers
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\frondend\HomeController as FrondendHomeController;
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
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\SpacialityController;
use App\Http\Controllers\frondend\SpacialityController as FrondendSpacialityController;
use App\Http\Controllers\frondend\RehabController as FrondendRehabController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\RehabController;
use App\Http\Controllers\Admin\OtController;
use App\Http\Controllers\frondend\OtController as FrondendOtController;
use App\Http\Controllers\Admin\TestingController;
use App\Http\Controllers\frondend\TestingController as FrondendTestingController;
use App\Http\Controllers\Admin\MedicalTurism;
use App\Http\Controllers\frondend\MedicalTurism as TurismController;
use App\Http\Controllers\Admin\InternationalController;
use App\Http\Controllers\frondend\InternationalController as FrondendInternationalController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\frondend\VisionController as FrondendVisionController;
use App\Http\Controllers\frondend\RoomController as FrondendRoomController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\RoomsController;

Route::redirect('/', '/home');

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

    Route::get('menus', [MenusController::class, 'index'])->name('menus.index');
    Route::get('menus/create', [MenusController::class, 'create'])->name('menus.create');
    Route::post('menus/store', [MenusController::class, 'store'])->name('menus.store');
    Route::get('menus/items/{id}', [MenusController::class, 'menuItems'])->name('menus.items');
    Route::post('menus/save/', [MenusController::class, 'saveMenu'])->name('menus.save');

    Route::get('home/{id}', [HomeController::class, 'create'])->name('home.create');
    Route::post('banners/store', [HomeController::class, 'store'])->name('banners.store');
    Route::post('content/store', [HomeController::class, 'contentStore'])->name('content.store');
    Route::post('section/store', [HomeController::class, 'sectionStore'])->name('section.store');

    Route::get('slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider.delete');

    Route::get('blog/category', [BlogController::class, 'categoryPage'])->name('blog.category.index');
    Route::get('blog/category/create', [BlogController::class, 'categoryCreate'])->name('blog.category.create');
    Route::post('blog/category/store', [BlogController::class, 'categoryStore'])->name('blog.category.store');
    Route::get('blog/category/edit/{id}', [BlogController::class, 'categoryEdit'])->name('blog.category.edit');
    Route::post('blog/category/update/{id}', [BlogController::class, 'categoryUpdate'])->name('blog.category.update');
    Route::delete('blog/category/delete/{id}', [BlogController::class, 'categoryDestroy'])->name('blog.category.delete');


    Route::get('blog/post', [BlogController::class, 'index'])->name('blog.post.index');
    Route::get('blog/post/create', [BlogController::class, 'create'])->name('blog.post.create');
    Route::post('blog/post/store', [BlogController::class, 'store'])->name('blog.post.store');
    Route::get('blog/post/edit/{id}', [BlogController::class, 'edit'])->name('blog.post.edit');
    Route::post('blog/post/update/{id}', [BlogController::class, 'update'])->name('blog.post.update');

    // Banners
    // Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
    // Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create');
    // // Route::post('banners/store', [BannerController::class, 'store'])->name('banners.store');
    // Route::post('banners/status-change/{id}', [BannerController::class, 'statusChange'])->name('banners.status.change');
    // Route::get('banners/edit/{id}', [BannerController::class, 'edit'])->name('banners.edit');
    // Route::post('banners/update/{id}', [BannerController::class, 'update'])->name('banners.update');
    // Route::delete('banners/destroy/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');

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
    Route::post('about/content/update/{id}', [AboutController::class, 'contentUpdate'])->name('about.content.update');
    Route::post('about/feature/update/{id}', [AboutController::class, 'featureUpdate'])->name('about.feature.update');
    Route::post('about/sub_content/update/{id}', [AboutController::class, 'subContentUpdate'])->name('about.sub_content.update');
    Route::post('about/mid_content/update/{id}', [AboutController::class, 'midContentUpdate'])->name('about.mid_content.update');
    Route::post('about/section/update/{id}', [AboutController::class, 'sectionUpdate'])->name('about.section.update');

    //career
    Route::get('/career/create/{id}', [CareerController::class, 'create'])->name('career.create');
    Route::post('/career/banner/store', [CareerController::class, 'store'])->name('career.banner.store');
    Route::post('/career/content/store', [CareerController::class, 'contentStore'])->name('career.content.store');

    Route::get('/pharmacy/create/{id}', [PharmacyController::class, 'create'])->name('pharmacy.create');
    Route::post('/pharmacy/banner/store', [PharmacyController::class, 'store'])->name('pharmacy.banner.store');
    Route::post('/pharmacy/content/store', [PharmacyController::class, 'pharmacyStore'])->name('pharmacy.content.store');
    Route::post('/pharmacy/plans/store', [PharmacyController::class, 'pharmacyPlanStore'])->name('pharmacy.plans.store');

    // Ambulance
    Route::get('/ambulance/create/{id}', [AmbulanceController::class, 'create'])->name('ambulance.create');
    Route::post('/ambulance/store', [AmbulanceController::class, 'store'])->name('ambulance.store');
    Route::post('/ambulance/content/store', [AmbulanceController::class, 'storeContent'])->name('ambulance.content.store');

    // Blood Bank
    Route::get('/blood-bank/create/{id}', [BloodBankController::class, 'create'])->name('blood_bank.create');
    Route::post('/blood-bank/store', [BloodBankController::class, 'store'])->name('blood_bank.store');
    Route::post('/blood-bank/content/store', [BloodBankController::class, 'contentStore'])->name('blood_bank.content.store');
    Route::post('/blood-bank/blood-group/store', [BloodBankController::class, 'bloodGroupStore'])->name('blood_bank.blood_group.store');

    // Directors
    Route::get('/directors/create/{id}', [DirectorsController::class, 'create'])->name('directors.create');
    Route::post('/directors/store', [DirectorsController::class, 'store'])->name('directors.store');
    Route::post('/directors/blog/store', [DirectorsController::class, 'blogStore'])->name('directors.blog.store');

    // Health Packages
    Route::get('/health-packages/create/{id}', [HealthPackagesController::class, 'create'])->name('health-packages.create');
    Route::post('/health-packages/store', [HealthPackagesController::class, 'store'])->name('health_packages.store');
    Route::post('/health-packages/content/store', [HealthPackagesController::class, 'ContentStore'])->name('health_packages.content.store');
    Route::post('/health-packages/blog/store', [HealthPackagesController::class, 'blogStore'])->name('health_packages.blog.store');

    // Insurance
    Route::get('/insurance/create/{id}', [InsuranceController::class, 'create'])->name('insurance.create');
    Route::post('/insurance/store', [InsuranceController::class, 'store'])->name('insurance.store');
    Route::post('/insurance/content/store', [InsuranceController::class, 'ContentStore'])->name('insurance.content.store');

    // ICU
    Route::get('/icu/create/{id}', [IcuController::class, 'create'])->name('icu.create');
    Route::post('/icu/store', [IcuController::class, 'store'])->name('icu.store');
    Route::get('/icu/edit/{id}', [IcuController::class, 'edit'])->name('icu.edit');

    Route::get('second-opinion/create/{id}', [SecondOpinionController::class, 'create'])->name('second-opinion.create');
    Route::post('second-opinion/store', [SecondOpinionController::class, 'store'])->name('second-opinion.store');
    Route::post('second-opinion/content/store', [SecondOpinionController::class, 'contentStore'])->name('second-opinion.content.store');

    Route::get('facility/index', [FacilityController::class, 'index'])->name('facility.index');
    Route::get('facility/create', [FacilityController::class, 'create'])->name('facility.create');
    Route::post('facility/store', [FacilityController::class, 'store'])->name('facility.store');
    Route::get('facility/edit/{id}', [FacilityController::class, 'edit'])->name('facility.edit');
    Route::post('facility/update/{id}', [FacilityController::class, 'update'])->name('facility.update');
    Route::delete('facility/destroy/{id}', [FacilityController::class, 'update'])->name('facility.destroy');

    Route::get('spaciality/create/{id}', [SpacialityController::class, 'create'])->name('spaciality.create');
    Route::post('spaciality/store', [SpacialityController::class, 'store'])->name('spaciality.store');
    Route::post('spaciality/content/store', [SpacialityController::class, 'contentStore'])->name('spaciality.content.store');
    Route::post('spaciality/blog/store', [SpacialityController::class, 'blogStore'])->name('spaciality.blog.store');

    Route::get('service/create/{id}', [ServiceController::class, 'create'])->name('service.create');
    Route::post('service/menu/store', [ServiceController::class, 'menuStore'])->name('service.menu.store');
    Route::post('service/content/store', [ServiceController::class, 'store'])->name('service.content.store');

    Route::get('rehabilitation/create/{id}', [RehabController::class, 'create'])->name('rehabilitation.create');
    Route::post('rehabilitation/banner/store', [RehabController::class, 'store'])->name('rehabilitation.banner.store');

    Route::get('hospital-ot/create/{id}', [OtController::class, 'create'])->name('hospital-ot.create');
    Route::post('hospital-ot/banner/store', [OtController::class, 'store'])->name('hospital-ot.banner.store');
    Route::post('hospital-ot/content/store', [OtController::class, 'contentStore'])->name('hospital-ot.content.store');

    Route::get('hospital-testing/create/{id}', [TestingController::class, 'create'])->name('hospital-testing.create');
    Route::post('hospital-testing/banner/store', [TestingController::class, 'store'])->name('hospital-testing.banner.store');
    Route::post('hospital-testing/content/store', [TestingController::class, 'contentStore'])->name('hospital-testing.content.store');

    Route::get('medical-turism/create/{id}', [MedicalTurism::class, 'create'])->name('medical-turism.create');
    Route::post('medical-turism/banner/store', [MedicalTurism::class, 'store'])->name('medical-turism.banner.store');
    Route::post('medical-turism/content/store', [MedicalTurism::class, 'contentStore'])->name('medical-turism.content.store');
    Route::post('medical-turism/medical/store', [MedicalTurism::class, 'medicalStore'])->name('medical-turism.medical.store');

    Route::get('hospital-international/create/{id}', [InternationalController::class, 'create'])->name('hospital-international.create');
    Route::post('hospital-international/banner/store', [InternationalController::class, 'store'])->name('hospital-international.banner.store');
    Route::post('hospital-international/content/store', [InternationalController::class, 'contentStore'])->name('hospital-international.content.store');
    Route::post('hospital-international/section/store', [InternationalController::class, 'SectionStore'])->name('hospital-international.section.store');

    Route::get('our-vision/create/{id}', [VisionController::class, 'create'])->name('our-vision.create');
    Route::post('our-vision/store', [VisionController::class, 'store'])->name('our-vision.store');
    Route::post('our-vision/section/store', [VisionController::class, 'SectionStore'])->name('our-vision.section.store');
    Route::post('our-vision/content/store', [VisionController::class, 'contentSection'])->name('our-vision.content.store');

    Route::get('rooms/create/{id}', [RoomsController::class, 'create'])->name('rooms.create');
    Route::post('rooms/store', [RoomsController::class, 'store'])->name('rooms.store');
    Route::post('rooms/feature/store', [RoomsController::class, 'roomStore'])->name('rooms.feature.store');
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
Route::get('/home', [FrondendHomeController::class, 'index'])->name('home');
Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors.index');
Route::get('/doctor-search', [DoctorsController::class, 'search'])->name('doctor.search');
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

Route::get('/spaciality', [FrondendSpacialityController::class, 'index'])->name('spaciality.index');
Route::get('/rehab', [FrondendRehabController::class, 'index'])->name('rehab.index');
Route::get('/hospital-ot', [FrondendOtController::class, 'index'])->name('hospital-ot.index');
Route::get('/hospital-testing', [FrondendTestingController::class, 'index'])->name('hospital-testing.index');
Route::get('/medical-turism', [TurismController::class, 'index'])->name('medical-turism.index');
Route::get('/hospital-international', [FrondendInternationalController::class, 'index'])->name('hospital-international.index');
Route::get('/vision', [FrondendVisionController::class, 'index'])->name('vision.index');
Route::get('/room', [FrondendRoomController::class, 'index'])->name('room.index');
