<?php

use Illuminate\Support\Facades\Route;
use App\Models\AboutProfile;
use App\Models\ContactProfile;
use App\Models\Project;
use App\Models\TechStack;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechStackController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $aboutProfile = AboutProfile::with([
        'descriptions',
        'focusAreas',
    ])->first();

    $techStacks = TechStack::orderBy('sort_order')
        ->orderBy('id')
        ->get();

    $projects = Project::orderByDesc('featured')
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    $contact = ContactProfile::first();

    return view('welcome', compact(
        'aboutProfile',
        'techStacks',
        'projects',
        'contact'
    ));
})->name('home');


/*
|--------------------------------------------------------------------------
| ADMIN AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // LOGIN
        Route::get('/login', [AuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'login'])
            ->middleware('throttle:5,1')
            ->name('login.submit');


        /*
        |--------------------------------------------------------------------------
        | PROTECTED ADMIN ROUTES
        |--------------------------------------------------------------------------
        */

        Route::middleware('admin')->group(function () {

            // DASHBOARD
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');


            // LOGOUT
            Route::post('/logout', [AuthController::class, 'logout'])
                ->name('logout');


            /*
            |--------------------------------------------------------------------------
            | ABOUT CRUD
            |--------------------------------------------------------------------------
            */

            Route::prefix('about')
                ->name('about.')
                ->controller(AboutController::class)
                ->group(function () {

                    // INDEX
                    Route::get('/', 'index')
                        ->name('index');

                    // PROFILE
                    Route::put('/profile', 'updateProfile')
                        ->name('profile.update');

                    // DESCRIPTIONS
                    Route::post('/descriptions', 'storeDescription')
                        ->name('descriptions.store');

                    Route::put('/descriptions/{description}', 'updateDescription')
                        ->name('descriptions.update');

                    Route::delete('/descriptions/{description}', 'destroyDescription')
                        ->name('descriptions.destroy');

                    // FOCUS AREAS
                    Route::post('/focus-areas', 'storeFocusArea')
                        ->name('focus.store');

                    Route::put('/focus-areas/{focusArea}', 'updateFocusArea')
                        ->name('focus.update');

                    Route::delete('/focus-areas/{focusArea}', 'destroyFocusArea')
                        ->name('focus.destroy');

                });


            /*
            |--------------------------------------------------------------------------
            | TECH STACK CRUD
            |--------------------------------------------------------------------------
            */

            Route::prefix('tech-stacks')
                ->name('tech-stacks.')
                ->controller(TechStackController::class)
                ->group(function () {

                    // INDEX
                    Route::get('/', 'index')
                        ->name('index');

                    // STORE
                    Route::post('/', 'store')
                        ->name('store');

                    // UPDATE
                    Route::put('/{techStack}', 'update')
                        ->name('update');

                    // DELETE
                    Route::delete('/{techStack}', 'destroy')
                        ->name('destroy');

                });

            /*
            |--------------------------------------------------------------------------
            | PROJECT CRUD
            |--------------------------------------------------------------------------
            */

            Route::prefix('projects')
                ->name('projects.')
                ->controller(ProjectController::class)
                ->group(function () {

                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::put('/{project}', 'update')->name('update');
                    Route::delete('/{project}', 'destroy')->name('destroy');

                });

            /*
            |--------------------------------------------------------------------------
            | CONTACT SETTINGS
            |--------------------------------------------------------------------------
            */

            Route::prefix('contact')
                ->name('contact.')
                ->controller(ContactController::class)
                ->group(function () {

                    Route::get('/', 'index')->name('index');
                    Route::put('/', 'update')->name('update');

                });

        });

    });
