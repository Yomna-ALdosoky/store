<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth', 'auth.type:super-admin,admin'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard' 

], function() {
        
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/', [DashboardController::class, 'index'])
                        ->name('dashboard');

        Route::get('/dashboard/categories/trash', [CategoriesController::class, 'trash'])
                ->name('categories.trash');   
        Route::put('dashboard/{categories}/restore', [CategoriesController::class, 'restore'])
                ->name('categories.restore');        
        Route::delete('/dashboard/{categories}/force-delete', [CategoriesController::class, 'forceDelete'])
                ->name('categories.force-delete');      

        Route::resource('/categories', CategoriesController::class);

        Route::resource('/products', ProductsController::class);

});


