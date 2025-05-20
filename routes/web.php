<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MusicController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\RatingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Redirect root ke redirect
Route::get('/', function () {
    return redirect('/redirect');
});

// Redirect setelah login
Route::get('/redirect', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect('/admin/musics');
    } else {
        return redirect('/dashboard');
    }
})->middleware('auth');

// Route Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/musics', [MusicController::class, 'index'])->name('admin.musics.index');
    Route::get('/musics/create', [MusicController::class, 'create'])->name('admin.musics.create');
    Route::post('/musics', [MusicController::class, 'store'])->name('admin.musics.store');
});

// Route User
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/rating/{music}', [RatingController::class, 'store'])->name('rating.store');
    Route::get('/rating/{id}/edit', [RatingController::class, 'edit'])->name('rating.edit');
    Route::put('/rating/{id}', [RatingController::class, 'update'])->name('rating.update');
    Route::delete('/rating/{id}', [RatingController::class, 'destroy'])->name('rating.destroy');
});

// Route Profile (edit, update, delete)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    })->name('profile.edit');

    Route::patch('/profile', function (Request $request) {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    })->name('profile.update');

    Route::delete('/profile', function (Request $request) {
        $user = $request->user();

        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    })->name('profile.destroy');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/musics', [MusicController::class, 'index'])->name('admin.musics.index');
    Route::get('/musics/create', [MusicController::class, 'create'])->name('admin.musics.create');
    Route::post('/musics', [MusicController::class, 'store'])->name('admin.musics.store');
    Route::get('/musics/{music}/edit', [MusicController::class, 'edit'])->name('admin.musics.edit');
    Route::put('/musics/{music}', [MusicController::class, 'update'])->name('admin.musics.update');
    Route::delete('/musics/{music}', [MusicController::class, 'destroy'])->name('admin.musics.destroy');
});


// Tambahkan route auth bawaan Breeze
require __DIR__.'/auth.php';
