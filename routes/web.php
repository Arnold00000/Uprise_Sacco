<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HomeController;


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

// routes/web.php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

// routes/web.php


// Login
//Route::post('/login', [LoginController::class, 'login']);
// Description: Handles user login. Expects 'username' and 'password' as POST parameters.

// Deposit
//Route::post('/deposit', [DepositController::class, 'deposit']);
// Description: Handles deposit submission. Expects 'member_id', 'amount', 'date_deposited', and 'receipt_number' as POST parameters.

// Check Statement
//Route::post('/check-statement', [StatementController::class, 'checkStatement']);
// Description: Generates the member's statement. Expects 'date_from' and 'date_to' as POST parameters.

// Request Loan
//Route::post('/request-loan', [LoanController::class, 'requestLoan']);
// Description: Submits a loan request. Expects 'amount' and 'payment_period_in_months' as POST parameters.

// Check Loan Status
//Route::post('/loan-status', [LoanController::class, 'loanStatus']);
// Description: Checks the status of a loan application. Expects 'loan_application_number' as POST parameter.

// Accept or Reject Loan
//Route::post('/accept-loan', [LoanController::class, 'acceptLoan']);
// Description: Allows the member to accept or reject a granted loan. Expects 'loan_application_number' and 'decision' ('accept' or 'reject') as POST parameters.



// Public Routes (No authentication required)

// Login (Public route)
Route::post('/login', [LoginController::class, 'login']);

// Private Routes (Authentication required)

Route::group(['middleware' => 'auth'], function () {
    // Deposit
    Route::post('/deposit', [DepositController::class, 'deposit']);
    // Check Statement
    Route::post('/check-statement', [StatementController::class, 'checkStatement']);
    // Request Loan
    Route::post('/request-loan', [LoanController::class, 'requestLoan']);
    // Check Loan Status
    Route::post('/loan-status', [LoanController::class, 'loanStatus']);
    // Accept or Reject Loan
    Route::post('/accept-loan', [LoanController::class, 'acceptLoan']);
});



// Guest Routes (Only accessible to non-authenticated users)

Route::group(['middleware' => 'guest'], function () {
    // User Registration (Guest route)
    Route::get('/register', [RegistrationController::class, 'showRegistrationForm']);
    Route::post('/register', [RegistrationController::class, 'register']);
});
