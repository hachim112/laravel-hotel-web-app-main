<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelFacilityController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomFacilityController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;

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


Route::group(['middleware' => 'prevent'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('landing');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/detail/room/{id}', [RoomTypeController::class, 'detailRoom'])->name('detail.room');
    Route::get('/room-types', [HomeController::class, 'roomTypes'])->name('customer.room.types');
    Auth::routes();

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/transactions', [TransactionController::class, 'index'])->name('customer.transactions');
        Route::get('/transaction/cancel/{id}', [TransactionController::class, 'transactionCancel'])->name('customer.cancel.transaction');
        Route::post('/transaction/pay/{id}', [TransactionController::class, 'transactionPay'])->name('customer.pay.transaction');
        Route::post('/book', [TransactionController::class, 'store'])->name('customer.book.now');
        Route::get('/pay', [PaymentController::class, 'index'])->name('customer.pay');
        Route::post('/invoice', [PaymentController::class, 'invoice'])->name('customer.invoice');
        Route::post('/payment/proof/upload', [PaymentController::class, 'uploadProof'])->name('upload.proof');
        Route::get('/transaction/proof/{id}', [TransactionController::class, 'transactionProof'])->name('transaction.proof');
        Route::get('/transaction/proof/print/{id}', [PaymentController::class, 'transactionProofPrint'])->name('transaction.proof.print');
         
        Route::group(['middleware' => 'admin'], function(){

            Route::get('/admin', [HomeController::class, 'admin'])->name('admin.home');
            Route::get('/admin/logs', [TransactionController::class, 'logs'])->name('admin.logs');
            Route::get('/admin/bookings', [TransactionController::class, 'adminBookings'])->name('admin.bookings');

            //CRUD KAMAR
            Route::resource('room', RoomController::class)->except('destroy');
            Route::get('/room/delete/{id}', [RoomController::class, 'destroy'])->name('room.delete');

            //CRUD TIPE KAMAR
            Route::resource('roomtype', RoomTypeController::class)->except('destroy');
            Route::get('/roomtype/delete/{id}', [RoomTypeController::class, 'destroy'])->name('roomtype.delete');

            //CRUD FASILITAS KAMAR
            Route::resource('roomfacility', RoomFacilityController::class)->except('destroy');
            Route::get('/roomfacility/delete/{id}', [RoomFacilityController::class, 'destroy'])->name('roomfacility.delete');

            //CRUD FASILITAS HOTEL
            Route::resource('hotelfacility', HotelFacilityController::class)->except('destroy');
            Route::get('/hotelfacility/delete/{id}', [HotelFacilityController::class, 'destroy'])->name('hotelfacility.delete');

            //CRUD USERS
            Route::middleware(['auth', 'admin'])->group(function () {
                Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
                Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
                Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
                Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
                Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
                Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
            });

        });

        Route::group(['middleware' => 'receptionis'], function(){
            Route::get('/receptionis', [HomeController::class, 'receptionis'])->name('receptionis.home');
            Route::get('/reservations', [TransactionController::class, 'reservations'])->name('receptionis.reservations');
            Route::get('/to_process/{id}', [TransactionController::class, 'toProcessTransaction'])->name('receptionis.toprocess');
            Route::get('/to_verified/{id}', [TransactionController::class, 'toVerifiedTransaction'])->name('receptionis.toverified');
            Route::get('/to_failed/{id}', [TransactionController::class, 'toFailedTransaction'])->name('receptionis.tofailed');
            Route::get('/to_rejected/{id}', [TransactionController::class, 'toRejectedTransaction'])->name('receptionis.torejected');
            Route::get('/checkin', [TransactionController::class, 'checkIn'])->name('receptionis.checkin');
            Route::get('/checkin-pdata', [TransactionController::class, 'checkInPersonaldata'])->name('receptionis.checkin.pdata');
            Route::post('/checkin/post', [TransactionController::class, 'checkInPost'])->name('receptionis.checkin.post');
            Route::post('/checkin-pdata/post', [TransactionController::class, 'checkInPersonalDataPost'])->name('receptionis.checkin.pdata.post');
            Route::get('/checkout/{id}', [TransactionController::class, 'checkOut'])->name('receptionis.checkout');
            Route::get('/checkout-pdata/{id}', [TransactionController::class, 'checkPersonalDataOut'])->name('receptionis.pdata.checkout');
            Route::get('/receptionis/logs', [TransactionController::class, 'logs'])->name('receptionis.logs');
           Route::post('/book-room', [BookingController::class, 'book'])->name('book.room');
          Route::get('/rooms', [BookingController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [BookingController::class, 'show'])->name('rooms.show');
Route::post('/rooms/{id}/book', [BookingController::class, 'book'])->name('rooms.book');

        });

    });
});

Route::group(['middleware' => ['auth', 'receptionis']], function() {
    Route::get('/receptionis/payments', [PaymentController::class, 'receptionisPayments'])->name('receptionis.payments');
    Route::post('/receptionis/payments/{id}/confirm', [PaymentController::class, 'confirmPayment'])->name('receptionis.payments.confirm');
    Route::post('/receptionis/payments/{id}/reject', [PaymentController::class, 'rejectPayment'])->name('receptionis.payments.reject');
});
