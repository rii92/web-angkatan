<?php

use Illuminate\Support\Facades\Route;
use App\Constants\AppPermissions;
use App\Models\Announcement;
use App\Models\Konsul;
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

// Route::get('/', function () {
//     return view('guest.index');
// })->name('home');

/** Route landing page */

Route::get('/', function () {
    return view('guest.landingpage');
})->name('home');

Route::get('/informasi', function () {
    return view('guest.informasi');
})->name('informasi');

Route::get('/sambat', function () {
    return view('guest.sambat');
})->name('sambat');

Route::get('/konsultasi', function () {
    return view('guest.konsultasi');
})->name('konsultasi');

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

        Route::prefix('konsultasi')
            ->middleware("permission:" . AppPermissions::REPLY_KONSULTASI_AKADEMIK . '|' . AppPermissions::REPLY_KONSULTASI_UMUM)
            ->group(function () {
                Route::get('akademik', function () {
                    return view('admin.konsultasi', ['catagory' => 'akademik']);
                })->name('admin.konsultasi.akademik');

                Route::get('umum', function () {
                    return view('admin.konsultasi', ['catagory' => 'umum']);
                })->name('admin.konsultasi.umum');

                Route::get('{konsul}', function (Konsul $konsul) {
                    return view('admin.konsultasi', ['konsul' => $konsul]);
                })->name('admin.konsultasi.chat');
            });

        Route::get('sambat', function () {
            return view('admin.sambat');
        })->name('admin.sambat');

        Route::prefix('announcement')->middleware("permission:" . AppPermissions::ANNOUNCEMENT_MANAGEMENT)->group(function () {
            Route::get('', function () {
                return view('admin.announcement');
            })->name('admin.announcement.table');

            Route::get('add', function () {
                return view('admin.announcement.add-edit', ['title' => 'Add Announcement']);
            })->name('admin.announcement.add');

            Route::get('{announcement}', function (Announcement $announcement) {
                return view('admin.announcement.add-edit', ['title' => 'Edit Announcement', 'id' => $announcement->id]);
            })->name('admin.announcement.edit');
        });

        Route::get('berita', function () {
            return view('admin.berita');
        })->name('admin.berita');
    });

    Route::prefix('user')->group(function () {

        Route::get('', function () {
            return redirect()->route('user.skripsi');
        })->name('user');

        Route::middleware("permission:" . AppPermissions::MAKE_KONSULTASI)
            ->prefix('konsultasi')
            ->group(function () {
                Route::get('umum', function () {
                    return view('mahasiswa.konsultasi', ['catagory' => 'umum']);
                })->name('user.konsultasi.umum');

                Route::get('akademik', function () {
                    return view('mahasiswa.konsultasi', ['catagory' => 'akademik']);
                })->name('user.konsultasi.akademik');

                Route::get('create/{category}', function ($catagory) {
                    return view('admin.konsultasi', ['create' => true, 'catagory' => $catagory]);
                })->name('user.konsultasi.create');
            });

        Route::get('sambat', function () {
            return view('mahasiswa.sambat');
        })->name('user.sambat');

        Route::get('skripsi', function () {
            return view('mahasiswa.skripsi');
        })->name('user.skripsi');
    });
});
