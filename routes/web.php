<?php

use Illuminate\Support\Facades\Route;
use App\Constants\AppPermissions;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Builder;

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

Route::get('/', function () {
    return view('without-login.homepage');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('forms/{uuid}', function ($uuid) {
        return view('forms.meetings', ['meeting' => Meeting::where('token', $uuid)->whereHas('members', function (Builder $query) {
            $query->where('user_id', auth()->id());
        })->firstOrFail()]);
    })->name('form');

    Route::prefix('admin')->middleware(["permission:" . AppPermissions::DASHBOARD_ACCESS])->group(function () {

        Route::get('', function () {
            return view('admin.home');
        })->name('admin.dashboard');

        Route::middleware("permission:" . AppPermissions::ADMIN_ACCESS)->group(function () {
            Route::get('users', function () {
                return view('admin.users');
            })->name('admin.users');

            Route::get('roles', function () {
                return view('admin.roles');
            })->name('admin.roles');
        });

        Route::prefix('meetings')->middleware("permission:" . AppPermissions::MEETING_MANAGEMENT)->group(function () {
            Route::get('', function () {
                return view('admin.meetings');
            })->name('admin.meetings.table');

            Route::get('{meeting}', function (Meeting $meeting) {
                return view('admin.meetings.details', ['meeting' => $meeting]);
            })->name('admin.meetings.details');
        });

        Route::prefix('konsultasi')->group(function () {
            Route::get('akademik', function () {
                return view('admin.konsultasi-akademik');
            })->name('admin.konsultasi-akademik');

            Route::get('umum', function () {
                return view('admin.konsultasi-umum');
            })->name('admin.konsultasi-umum');
        });

        Route::get('sambat', function () {
            return view('admin.sambat');
        })->name('admin.sambat');

        Route::get('pengumuman', function () {
            return view('admin.pengumuman');
        })->name('admin.pengumuman');

        Route::get('berita', function () {
            return view('admin.berita');
        })->name('admin.berita');
    });
});
