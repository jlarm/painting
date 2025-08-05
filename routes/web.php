<?php

use App\Livewire\Competitions\AdminDashboard;
use App\Livewire\Competitions\Create;
use App\Livewire\Competitions\Show;
use App\Livewire\Competitions\Submit;
use App\Livewire\Competitions\UserDashboard;
use App\Livewire\Competitions\Vote;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('creative-welcome');
})->name('home');

Route::get('/competitions/public', App\Livewire\Competitions\PublicCompetitions::class)->name('competitions.public');

// Auth-protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('competitions.admin');
        } else {
            return redirect()->route('competitions.user');
        }
    })->name('dashboard');

    // Specific competition routes first
    Route::get('/competitions', UserDashboard::class)->name('competitions.user');
    Route::get('/competitions/admin', AdminDashboard::class)->name('competitions.admin');
    Route::get('/competitions/create', Create::class)->name('competitions.create');
    Route::get('/competitions/{competition}/submit', Submit::class)->name('competitions.submit');
    Route::get('/competitions/{competition}/vote', Vote::class)->name('competitions.vote');
});

// Parameterized route last
Route::get('/competitions/{competition}', Show::class)->name('competitions.show');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
