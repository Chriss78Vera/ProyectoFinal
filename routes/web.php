<?php
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\Profile\PasswordController;
use App\Http\Controllers\Profile\ProfileAvatarController;
use App\Http\Controllers\Profile\ProfileInformationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::middleware(['auth', 'verified'])->group(function ()
{


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/profile', [ProfileInformationController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileInformationController::class, 'update'])->name('profile.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('user-password.update');
    Route::put('/user-avatar', [ProfileAvatarController::class, 'update'])->name('user-avatar.update');

    Route::get('/directors', [DirectorController::class, 'index'])->name('director.index');
    Route::get('/directors/create', [DirectorController::class, 'create'])->name('director.create');
    Route::post('/directors/create', [DirectorController::class, 'store'])->name('director.store');
    Route::get('/directors/{user}', [DirectorController::class, 'show'])->name('director.show');
    Route::get('/directors/update/{user}', [DirectorController::class, 'edit'])->name('director.edit');
    Route::put('/directors/update/{user}', [DirectorController::class, 'update'])->name('director.update');
    Route::get('/directors/destroy/{user}', [DirectorController::class, 'destroy'])->name('director.destroy');
});

require __DIR__.'/auth.php';
