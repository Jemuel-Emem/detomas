<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'user.landingpage');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');




    Route::middleware([

        ])->group(function () {
             Route::get('/dashboard', function () {
               if (auth()->user()->is_admin == 1) {
                return redirect()->route('adminpage');
               }else{
                return redirect()->route('landingpage');
               }
             })->name('userdashboard');

        });
    //admin here
    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::get('/Admin', function(){
            return view('admin.index');
            })->name('adminpage');

        Route::get('/Pending', function(){
                return view('admin.pending');
                })->name('pending');

        Route::get('/ReservationList', function(){
                    return view('admin.reservationlist');
                    })->name('reservationlist');
        Route::get('/CanlledList', function(){
                return view('admin.cancelledlist');
            })->name('cancelledlist');

            Route::get('/Cottage', function(){
                return view('admin.cottage');
            })->name('cottage');
            Route::get('/ReservationHistory', function(){
                return view('admin.reservationhistory');
            })->name('reservationhistory');
    });

  //user here
  Route::get('/UserPage', function(){
    return view('user.landingpage');
    })->name('landingpage');

  Route::get('/book', function(){
        return view('user.book');
        })->name('book');

  Route::get('/rules', function(){
            return view('user.rules');
            })->name('rules');
Route::get('/cottages', function(){
                return view('user.cottages');
            })->name('cottages');

 Route::get('/about', function(){
                return view('user.about');
 })->name('about');

 Route::get('/cottageview', function(){
    return view('user.cottageview');
})->name('cottageview');


Route::get('/contactus', function(){
    return view('user.contactus');
})->name('contactus');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
require __DIR__.'/auth.php';
