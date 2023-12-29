<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ErrandWorker\ErrandWorkerController;
use App\Models\ErrandWorker;
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


// Auth::routes();

Route::get('/', [App\Http\Controllers\Customer\HomeController::class,'index'])->name('home');
Route::get('/customer',function(){
    return redirect()->route('home');
});
// Route::get('/customer',[App\Http\Controllers\Customer\HomeController::class,'index'])->name('home');
Route::get('/jobs',[App\Http\Controllers\Customer\JobController::class,'job_list'])->name('job-list');


Route::middleware(['auth:customer'])->group(function(){
    Route::get('/job/{job_id}',[App\Http\Controllers\Customer\JobController::class,'job_detail'])->name('job-detail');
    Route::get('/job_rental/j={job_id}&e={errand_worker_id}',[App\Http\Controllers\Customer\JobController::class,'job_rental'])->name('job-rental');
    Route::post('/handle_rental/{job_rental_id}',[App\Http\Controllers\Customer\JobController::class,'handle_rental'])->name('handle-rental');
    Route::get('/rental_history',[App\Http\Controllers\Customer\JobController::class,'rental_history'])->name('customer.rental-history');
    Route::get('/rental_confirm/{rental_history_id}',[App\Http\Controllers\Customer\JobController::class,'rental_confirm'])->name('customer.rental-confirm');

    Route::get('/customer/status_job/{rental_history_id}.{e_status}.{c_status}',[App\Http\Controllers\Customer\JobController::class,'status_job'])->name('customer.job.status_job');

    Route::get('/profile',[App\Http\Controllers\Customer\CustomerController::class,'profile'])->name('customer.profile');
    Route::post('/profile/update',[App\Http\Controllers\Customer\CustomerController::class,'update'])->name('customer.update');
    Route::get('/pay',[App\Http\Controllers\Customer\CustomerController::class,'pay'])->name('customer.pay');
    Route::post('/create_payment',[App\Http\Controllers\Customer\CustomerController::class,'create_payment'])->name('customer.create_payment');
    Route::get('/return',[App\Http\Controllers\Customer\CustomerController::class,'return'])->name('customer.return');
    Route::get('/payment_history',[App\Http\Controllers\Customer\CustomerController::class,'payment_history'])->name('customer.payment_history');
});

Route::prefix('customer')->name('customer.')->group(function(){
    Route::middleware(['guest:customer'])->group(function(){
        Route::view('/login','customer.login')->name('login');
        Route::post('/doLogin',[CustomerController::class,'doLogin'])->name('doLogin');
        Route::view('/register','customer.register')->name('register');
        Route::post('/create',[CustomerController::class,'create'])->name('create');
    });
    Route::middleware(['auth:customer'])->group(function(){
        Route::get('/logout',[CustomerController::class,'logout'])->name('logout');
    });
});

Route::prefix('errand_worker')->name('errand_worker.')->group(function(){
    Route::middleware(['guest:errand_worker'])->group(function(){
        Route::view('/login','errand_worker.login')->name('login');
        Route::post('/login',[ErrandWorkerController::class,'login']);
        Route::view('/register','errand_worker.register')->name('register');
        Route::post('/register',[ErrandWorkerController::class,'create']);
    });

    Route::middleware(['auth:errand_worker'])->group(function(){
        Route::view('/','errand_worker.home')->name('dashboard');
        Route::view('/dashboard','errand_worker.home')->name('dashboard');
        // INFO
        Route::post('/update', [ErrandWorkerController::class,'update'])->name('update');
        // JOB
        Route::prefix('job')->name('job.')->group(function(){
            Route::get('/', [App\Http\Controllers\ErrandWorker\JobController::class,'index'])->name('index');
            Route::view('/proposal', 'errand_worker.job-management.create')->name('add');
            Route::post('/create',[App\Http\Controllers\ErrandWorker\JobController::class,'create'])->name('create');
            Route::get('/detail/{job_id}', [App\Http\Controllers\ErrandWorker\JobController::class,'detail'])->name('detail');
            Route::post('/type_rentals/add',[App\Http\Controllers\ErrandWorker\JobController::class,'create_typeRentals'])->name('create_type_rental');
            Route::post('/accept_job/{job_id}',[App\Http\Controllers\ErrandWorker\JobController::class,'accept_job'])->name('accept_job');
            Route::get('/rental_history',[App\Http\Controllers\ErrandWorker\JobController::class,'rental_history'])->name('rental_history');

            Route::get('/status_job/{rental_history_id}.{e_status}.{c_status}',[App\Http\Controllers\ErrandWorker\JobController::class,'status_job'])->name('status_job');
        });
        Route::get('/logout',[ErrandWorkerController::class,'logout'])->name('logout');
    });
});


Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin'])->group(function(){
        Route::view('/login','admin.login')->name('login');
        Route::post('/login',[AdminController::class,'login']);
    });

    Route::middleware(['auth:admin'])->group(function(){
        Route::view('/','admin.dashboard')->name('dashboard');
        Route::view('/dashboard','admin.dashboard')->name('dashboard');
        Route::get('/logout',[AdminController::class,'logout'])->name('logout');

        // ROUTE QUẢN LÝ KHÁCH HÀNG route('admin.customer.index')
        Route::prefix('customer')->name('customer.')->group(function(){
            Route::get('/',[App\Http\Controllers\Admin\CustomerController::class,'index'])->name('index');
            Route::view('/add', 'admin.customer-management.create')->name('add');
            Route::post('/create',[App\Http\Controllers\Admin\CustomerController::class,'create'])->name('create');
            Route::get('/edit/{customer_id}',[App\Http\Controllers\Admin\CustomerController::class,'edit'])->name('edit');
            Route::post('/update/{customer_id}',[App\Http\Controllers\Admin\CustomerController::class,'update'])->name('update');
        });

        // ROUTE QUẢN LÝ NGƯỜI GIÚP VIỆC route('admin.errand_worker.index')
        Route::prefix('errand_worker')->name('errand_worker.')->group(function(){
            Route::get('/',[App\Http\Controllers\Admin\ErrandWorkerController::class,'index'])->name('index');
            Route::view('/add', 'admin.errand-worker-management.create')->name('add');
            Route::post('/create',[App\Http\Controllers\Admin\ErrandWorkerController::class,'create'])->name('create');
            Route::get('/edit/{errand_worker_id}',[App\Http\Controllers\Admin\ErrandWorkerController::class,'edit'])->name('edit');
            Route::post('/update/{errand_worker_id}',[App\Http\Controllers\Admin\ErrandWorkerController::class,'update'])->name('update');
        });

        // ROUTE QUẢN LÝ VIỆC LAM route('admin.job.index')
        Route::prefix('job')->name('job.')->group(function(){
            Route::get('/',[App\Http\Controllers\Admin\JobController::class,'index'])->name('index');
            Route::view('/add', 'admin.job-management.create')->name('add');
            Route::post('/create',[App\Http\Controllers\Admin\JobController::class,'create'])->name('create');
            Route::get('/edit/{job_id}',[App\Http\Controllers\Admin\JobController::class,'edit'])->name('edit');
            Route::post('/update/{job_id}',[App\Http\Controllers\Admin\JobController::class,'update'])->name('update');
            Route::get('/update_status/{job_id}',[App\Http\Controllers\Admin\JobController::class,'update_status'])->name('update_status');
            Route::get('/delete/{job_id}',[App\Http\Controllers\Admin\JobController::class,'detete'])->name('delete');
            // Type Rental
            Route::get('/type_rentals',[App\Http\Controllers\Admin\JobController::class,'index_typeRentals'])->name('index_type_rentals');
            Route::post('/type_rentals/add',[App\Http\Controllers\Admin\JobController::class,'create_typeRentals'])->name('create_type_rental');
        });

        Route::prefix('payment')->name('payment.')->group(function (){
            Route::get('/',[App\Http\Controllers\Admin\PaymentController::class,'index'])->name('index');
        });

    });
});



