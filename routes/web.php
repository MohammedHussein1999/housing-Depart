<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentNewController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ComponController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('getColl', [CollectionController::class, 'show']);
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::prefix('register')->group(function () {
        Route::get('index', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register.index');
        Route::get('destroy/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'destroy'])->name('register.destroy');
        Route::get('edit/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'edit'])->name('register.edit');
        Route::post('update/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'update'])->name('register.update');
    });

    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('setting')->group(function () {
        Route::get('', [App\Http\Controllers\SittingController::class, 'index'])->name('setting.index');
    });

    Route::prefix('housing')->group(function () {
        Route::get('', [App\Http\Controllers\CityController::class, 'index'])->name('housing.index');
        Route::get('create', [App\Http\Controllers\HousingController::class, 'create'])->name('housing.create');
        Route::post('store', [App\Http\Controllers\HousingController::class, 'store'])->name('housing.store');
        Route::get('destroy/{id}', [App\Http\Controllers\HousingController::class, 'destroy'])->name('housing.destroy');
        Route::get('approve/{id}', [App\Http\Controllers\HousingController::class, 'approve'])->name('housing.approve');
        Route::get('notApprove/{id}', [App\Http\Controllers\HousingController::class, 'notApprove'])->name('housing.notApprove');
        Route::get('again/{id}', [App\Http\Controllers\HousingController::class, 'again'])->name('housing.again');
    });

    Route::prefix('data')->group(function () {
        Route::get('', [App\Http\Controllers\DataController::class, 'index'])->name('data.index');
        Route::get('create', [App\Http\Controllers\DataController::class, 'create'])->name('data.create');
        Route::post('import', [App\Http\Controllers\DataController::class, 'import'])->name('data.import');
    });

    Route::prefix('rooms-status')->group(function () {
        Route::post('store', [App\Http\Controllers\RoomsStatusController::class, 'store'])->name('roomStatus.store');
        Route::get('destroy/{id}', [App\Http\Controllers\RoomsStatusController::class, 'destroy'])->name('roomStatus.destroy');
        Route::get('active/{id}', [App\Http\Controllers\RoomsStatusController::class, 'active'])->name('roomStatus.active');
        Route::get('status/{id}', [App\Http\Controllers\RoomsStatusController::class, 'status'])->name('roomStatus.status');
    });

    Route::prefix('client-status')->group(function () {
        Route::get('create', [App\Http\Controllers\StatusController::class, 'create'])->name('clientStatus.create');
        Route::post('store', [App\Http\Controllers\StatusController::class, 'store'])->name('clientStatus.store');
        Route::get('/show/{id}', [RegionController::class, 'show']);

        Route::get('destroy/{id}', [App\Http\Controllers\StatusController::class, 'destroy'])->name('clientStatus.destroy');
        Route::get('active/{id}', [App\Http\Controllers\StatusController::class, 'active'])->name('clientStatus.active');
        Route::get('status/{id}', [App\Http\Controllers\StatusController::class, 'status'])->name('clientStatus.status');
    });

    Route::prefix('building-type')->group(function () {
        Route::get('create', [App\Http\Controllers\BuildingTypeController::class, 'create'])->name('buildingType.create');
        Route::post('store', [App\Http\Controllers\BuildingTypeController::class, 'store'])->name('buildingType.store');
        Route::get('destroy/{id}', [App\Http\Controllers\BuildingTypeController::class, 'destroy'])->name('buildingType.destroy');
        Route::get('active/{id}', [App\Http\Controllers\BuildingTypeController::class, 'active'])->name('buildingType.active');
        Route::get('status/{id}', [App\Http\Controllers\BuildingTypeController::class, 'status'])->name('buildingType.status');
    });

    Route::prefix('mistake')->group(function () {
        Route::get('create', [App\Http\Controllers\MistakeController::class, 'create'])->name('mistake.create');
        Route::post('store', [App\Http\Controllers\MistakeController::class, 'store'])->name('mistake.store');
        Route::get('destroy/{id}', [App\Http\Controllers\MistakeController::class, 'destroy'])->name('mistake.destroy');
        Route::get('active/{id}', [App\Http\Controllers\MistakeController::class, 'active'])->name('mistake.active');
        Route::get('download/{id}', [App\Http\Controllers\MistakeController::class, 'download'])->name('mistake.download');
    });

    Route::prefix('mistake-type')->group(function () {
        Route::get('create', [App\Http\Controllers\MistakeTypeController::class, 'create'])->name('mistake-type.create');
        Route::post('store', [App\Http\Controllers\MistakeTypeController::class, 'store'])->name('mistake-type.store');
        Route::get('destroy/{id}', [App\Http\Controllers\MistakeTypeController::class, 'destroy'])->name('mistake-type.destroy');
        Route::get('active/{id}', [App\Http\Controllers\MistakeTypeController::class, 'active'])->name('mistake-type.active');
    });

    Route::prefix('value')->group(function () {
        Route::get('create', [App\Http\Controllers\ValueController::class, 'create'])->name('value.create');
        Route::post('store', [App\Http\Controllers\ValueController::class, 'store'])->name('value.store');
        Route::get('destroy/{id}', [App\Http\Controllers\ValueController::class, 'destroy'])->name('value.destroy');
        Route::get('status/{id}', [App\Http\Controllers\ValueController::class, 'status'])->name('value.status');
    });

    Route::prefix('collection')->group(function () {
        Route::post('store', [App\Http\Controllers\CollectionController::class, 'store'])->name('collection.store');
        Route::get('create', [App\Http\Controllers\CollectionController::class, 'create'])->name('collection.create');
        Route::get('', [RegionController::class, 'index'])->name('collection.index');
        Route::get('/show/{id}', [RegionController::class, 'show']);
        Route::get('/show/command/{id}', [ComponController::class, 'index'])->name('collection.shows');
        // Route::get('/show', [CityController::class, 'index'])->name('collection.shows');
        // لحذف المجمع
        Route::delete('/collection/shows/{id}/delete', [ComponController::class, 'deleteShow'])->name('collection.shows.delete');
        // لحذف الوحدة السكنية
        Route::delete('/collection/unit/{id}/delete', [ComponController::class, 'deleteUnit'])->name('collection.delete.unit');

        // لحذف الغرفة
        Route::delete('/collection/room/{id}/delete', [ComponController::class, 'deleteRoom'])->name('collection.delete.room');
        Route::post('/show/command/{id}', [ComponController::class, 'create'])->name('collection.shows.create');
        Route::post('/create/unit', [UnitController::class, 'create'])->name('collection.create.unit');
        Route::post('/create/apartmentNew', [ApartmentNewController::class, 'create'])->name('collection.create.apartmentNew');
        Route::post('/create/rooms', [RoomsController::class, 'create'])->name('collection.create.rooms');

        Route::get('active/{id}', [App\Http\Controllers\CollectionController::class, 'active'])->name('collection.active');
        Route::get('destroy/{id}', [App\Http\Controllers\CollectionController::class, 'destroy'])->name('collection.destroy');
        Route::get('edit/{id}', [App\Http\Controllers\CollectionController::class, 'edit'])->name('collection.edit');
        Route::get('download/{id}', [App\Http\Controllers\CollectionController::class, 'download'])->name('collection.download');
        Route::get('approve/{id}', [App\Http\Controllers\CollectionController::class, 'approve'])->name('collection.approve');
        Route::get('notApprove/{id}', [App\Http\Controllers\CollectionController::class, 'notApprove'])->name('collection.notApprove');
        Route::get('again/{id}', [App\Http\Controllers\CollectionController::class, 'again'])->name('collection.again');
        Route::post('update/{id}', [App\Http\Controllers\CollectionController::class, 'update'])->name('collection.update');
    });

    Route::prefix('building')->group(function () {
        Route::post('store', [App\Http\Controllers\BuildingController::class, 'store'])->name('building.store');
        Route::get('create', [App\Http\Controllers\BuildingController::class, 'create'])->name('building.create');
        Route::get('active/{id}', [App\Http\Controllers\BuildingController::class, 'active'])->name('building.active');
        Route::get('edit/{id}', [App\Http\Controllers\BuildingController::class, 'edit'])->name('building.edit');
        Route::get('destroy/{id}', [App\Http\Controllers\BuildingController::class, 'destroy'])->name('building.destroy');
        Route::get('download/{id}', [App\Http\Controllers\BuildingController::class, 'download'])->name('building.download');
        Route::get('approve/{id}', [App\Http\Controllers\BuildingController::class, 'approve'])->name('building.approve');
        Route::get('notApprove/{id}', [App\Http\Controllers\BuildingController::class, 'notApprove'])->name('building.notApprove');
        Route::get('again/{id}', [App\Http\Controllers\BuildingController::class, 'again'])->name('building.again');
        Route::post('update/{id}', [App\Http\Controllers\BuildingController::class, 'update'])->name('building.update');
    });

    Route::prefix('apartment')->group(function () {
        Route::post('store', [App\Http\Controllers\ApartmentController::class, 'store'])->name('apartment.store');
        Route::get('create', [App\Http\Controllers\ApartmentController::class, 'create'])->name('apartment.create');
        Route::get('active/{id}', [App\Http\Controllers\ApartmentController::class, 'active'])->name('apartment.active');
        Route::get('edit/{id}', [App\Http\Controllers\ApartmentController::class, 'edit'])->name('apartment.edit');
        Route::get('destroy/{id}', [App\Http\Controllers\ApartmentController::class, 'destroy'])->name('apartment.destroy');
        Route::get('download/{id}', [App\Http\Controllers\ApartmentController::class, 'download'])->name('apartment.download');
        Route::post('update/{id}', [App\Http\Controllers\ApartmentController::class, 'update'])->name('apartment.update');
    });

    Route::prefix('room')->group(function () {
        Route::post('store', [App\Http\Controllers\RoomController::class, 'store'])->name('room.store');
        Route::get('create', [App\Http\Controllers\RoomController::class, 'create'])->name('room.create');
        Route::get('active/{id}', [App\Http\Controllers\RoomController::class, 'active'])->name('room.active');
        Route::get('destroy/{id}', [App\Http\Controllers\RoomController::class, 'destroy'])->name('room.destroy');
        Route::get('edit/{id}', [App\Http\Controllers\RoomController::class, 'edit'])->name('room.edit');
        Route::get('download/{id}', [App\Http\Controllers\RoomController::class, 'download'])->name('room.download');
        Route::post('update/{id}', [App\Http\Controllers\RoomController::class, 'update'])->name('room.update');
    });

    Route::prefix('out')->group(function () {
        Route::get('create', [App\Http\Controllers\OutController::class, 'create'])->name('out.create');
        Route::post('store', [App\Http\Controllers\OutController::class, 'store'])->name('out.store');
        Route::get('destroy/{id}', [App\Http\Controllers\OutController::class, 'destroy'])->name('out.destroy');
        Route::get('approve/{id}', [App\Http\Controllers\OutController::class, 'approve'])->name('out.approve');
        Route::get('notApprove/{id}', [App\Http\Controllers\OutController::class, 'notApprove'])->name('out.notApprove');
        Route::get('again/{id}', [App\Http\Controllers\OutController::class, 'again'])->name('out.again');
    });

    Route::prefix('report')->group(function () {
        Route::get('nationality', [App\Http\Controllers\reportController::class, 'nationality'])->name('report.nationality');
        Route::get('location', [App\Http\Controllers\reportController::class, 'location'])->name('report.location');
        Route::get('full', [App\Http\Controllers\reportController::class, 'full'])->name('report.full');
        Route::get('out', [App\Http\Controllers\reportController::class, 'out'])->name('report.out');
        Route::get('room', [App\Http\Controllers\reportController::class, 'room'])->name('report.room');
    });
    Route::prefix('notification')->group(function () {
        Route::get('collection', [App\Http\Controllers\NotificationController::class, 'coll'])->name('notification.coll');
        Route::get('building', [App\Http\Controllers\NotificationController::class, 'building'])->name('notification.building');
        Route::get('housing', [App\Http\Controllers\NotificationController::class, 'housing'])->name('notification.housing');
        Route::post('build/{id}', [App\Http\Controllers\ComponController::class, 'show'])->name('notification.housingNew');
        Route::get('out', [App\Http\Controllers\NotificationController::class, 'out'])->name('notification.out');
    });
});
// Route::post('/stor', [Unit::class, 'create'])->name('collection.bald');
Route::post('test/', [EmployeesController::class, 'importExcel'])->name('test.name');
Route::post('test/update/{id}', [EmployeesController::class, 'updateRoom'])->name('test.update');

Route::get('test', [EmployeesController::class, 'index'])->name('test');
Route::get('test/a', [EmployeesController::class, 'search']);
Route::delete('test/{id}', [EmployeesController::class, 'destroy'])->name('test.delete');
