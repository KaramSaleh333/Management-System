<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductsController::class);
    Route::get('/products/create' , [ProductsController::class , 'create'])->middleware('owner_accountant')
    ->name('products.create');
    Route::post('products/search' , [ProductsController::class , 'search'])->name('products.search');
});

Route::middleware(['auth' , 'owner_accountant'])->group(function (){
    Route::resource('employee' , UsersController::class);
    Route::post('employee/search' , [UsersController::class , 'show'])->name('employee.show');
});


Route::middleware(['auth'])->group(function (){
    Route::resource('Bill' , BillController::class);
    Route::get('Bill/create/{id}' , [BillController::class , 'create'])->name('Bill.create');
    Route::post('Bill/search' , [BillController::class , 'search'])->name('Bill.search');
    Route::get('Bill/store/{total_price}' , [BillController::class , 'store'])->name('Bill.store');
    Route::get('Bill/delete/{id}' , [BillController::class , 'delete_bill'])->name('delete_bill');
    Route::get('Bill/show/all' , [BillController::class , 'show_all'])->name('show_all');
    Route::post('Bill/add/{id}' , [BillController::class , 'add_product'])->name('add_product');
    Route::get('Bill/destroy/{id}' , [BillController::class , 'destroy'])->name('Bill.destroy');
    Route::get('Bill/all/delete' , [BillController::class , 'delete_all'])->name('delete_all');


});

Route::middleware(['auth'])->group(function (){
    Route::get('transactions' , [TransactionController::class , 'index'])
    ->name('transaction.index');
    Route::post('transactions/search' , [TransactionController::class , 'search'])
    ->name('transaction.search');
    Route::get('transactions/deleted_bill/{bill}' , [TransactionController::class , 'deleted_bill'])
    ->name('transaction.deleted_bill');

});

require __DIR__.'/auth.php';
