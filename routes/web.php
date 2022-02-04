<?php

use App\Constants\AppKonsul;
use Illuminate\Support\Facades\Route;
use App\Constants\AppPermissions;
use App\Http\Livewire\Admin\Konsultasi\DiscussionRoom as KonsultasiDiscussionRoom;
use App\Http\Livewire\Mahasiswa\Konsultasi\DiscussionRoom;
use App\Http\Livewire\Mahasiswa\Konsultasi\Form;
use App\Http\Livewire\Sambat\Form as SambatForm;
use App\Models\Announcement;
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

Route::get('/proker', function () {
    return view('guest.proker');
})->name('proker');

Route::prefix('informasi')->group(function () {
    Route::get('', function () {
        return view('guest.announcement');
    })->name('announcement');

    Route::get('{announcement}', function (Announcement $announcement) {
        return view('guest.announcement.details', ['announcement' => $announcement]);
    })->name('announcement.details');
});

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

        Route::prefix('konsultasi')->group(function () {
            Route::prefix('akademik')->middleware('permission:' . AppPermissions::REPLY_KONSULTASI_AKADEMIK)->group(function () {
                Route::get('', fn () => view('admin.konsultasi', ['category' => AppKonsul::TYPE_AKADEMIK]))
                    ->name('admin.konsultasi.akademik.table');

                Route::get('{konsul}', KonsultasiDiscussionRoom::class)
                    ->defaults('category', AppKonsul::TYPE_AKADEMIK)
                    ->name('admin.konsultasi.akademik.room');
            });

            Route::prefix('umum')->middleware('permission:' . AppPermissions::REPLY_KONSULTASI_UMUM)->group(function () {
                Route::get('', fn () => view('admin.konsultasi', ['category' => AppKonsul::TYPE_UMUM]))
                    ->name('admin.konsultasi.umum.table');

                Route::get('{konsul}', KonsultasiDiscussionRoom::class)
                    ->defaults('category', AppKonsul::TYPE_UMUM)
                    ->name('admin.konsultasi.umum.room');
            });
        });


        Route::middleware("permission:" . AppPermissions::TIMELINE_MANAGEMENT)
            ->get('timelines', function () {
                return view('admin.timelines');
            })->name('admin.timelines.table');

            
        Route::middleware('permission:' . AppPermissions::TURNITIN_MANAGEMENT)->get('turnitin', function () {
            return view('admin.turnitin');
        })->name('admin.turnitin.table');

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
    });

    Route::prefix('user')->group(function () {

        Route::get('', function () {
            return redirect()->route('user.skripsi');
        })->name('user');

        Route::middleware("permission:" . AppPermissions::MAKE_KONSULTASI)->prefix('konsultasi')->group(function () {
            Route::prefix('umum')->group(function () {
                Route::get('', fn () => view('mahasiswa.konsultasi', ['category' => AppKonsul::TYPE_UMUM]))
                    ->name('user.konsultasi.umum.table');

                Route::get('add', Form::class)
                    ->defaults('category', AppKonsul::TYPE_UMUM)
                    ->name('user.konsultasi.umum.add');

                Route::get('edit/{konsul_id}', Form::class)
                    ->defaults('category', AppKonsul::TYPE_UMUM)
                    ->name('user.konsultasi.umum.edit');

                Route::get('{konsul}', DiscussionRoom::class)
                    ->defaults('category', AppKonsul::TYPE_UMUM)
                    ->name('user.konsultasi.umum.room');
            });

        Route::middleware('permission:' . AppPermissions::MAKE_TURNITIN)->get('turnitin', function () {
            return view('mahasiswa.turnitin');
        })->name('user.turnitin.table');

        Route::prefix('sambat')->group(function () {
            Route::get('', function () {
                return view('mahasiswa.sambat');
            })->name('user.sambat.table');

            Route::get('add', SambatForm::class)->name('user.sambat.add');
            Route::get('edit/{sambat}', SambatForm::class)->name('user.sambat.edit')->middleware('edit.sambat');
        });

        Route::get('skripsi', function () {
            return view('mahasiswa.skripsi');
        })->name('user.skripsi');
    });
});
