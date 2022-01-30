<?php

use App\Constants\AppKonsul;
use Illuminate\Support\Facades\Route;
use App\Constants\AppPermissions;
use App\Http\Livewire\Sambat\Form as SambatForm;
use App\Models\Announcement;
use App\Models\Konsul;
use App\Models\Meeting;
use App\Models\Sambat;
use App\Models\Tag;
use App\Models\User;
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

                Route::prefix('akademik')->middleware('permission:' . AppPermissions::REPLY_KONSULTASI_AKADEMIK)->group(function () {
                    Route::get('', function () {
                        return view('admin.konsultasi', ['category' => 'akademik', 'menu' => 'table', 'title' => 'Konsultasi Akademik']);
                    })->name('admin.konsultasi.akademik.table');

                    Route::get('{konsul_id}', function ($konsulId) {
                        return view('admin.konsultasi', ['konsul_id' => $konsulId, 'menu' => 'room', 'title' => "Discussion Room"]);
                    })->name('admin.konsultasi.akademik.room');
                });

                Route::prefix('umum')->middleware('permission:' . AppPermissions::REPLY_KONSULTASI_UMUM)->group(function () {
                    Route::get('', function () {
                        return view('admin.konsultasi', ['category' => 'umum', 'menu' => 'table', 'title' => 'Konsultasi Umum']);
                    })->name('admin.konsultasi.umum.table');

                    Route::get('{konsul_id}', function ($konsulId) {
                        return view('admin.konsultasi', ['konsul_id' => $konsulId, 'menu' => 'room', 'title' => "Discussion Room"]);
                    })->name('admin.konsultasi.umum.room');
                });
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
                Route::prefix('umum')->group(function () {
                    $data = ['category' => AppKonsul::TYPE_UMUM, 'title' => "Konsultasi Umum"];
                    Route::get('', function () use ($data) {
                        return view('mahasiswa.konsultasi', array_merge($data, ['menu' => 'table']));
                    })->name('user.konsultasi.umum.table');

                    Route::get('add', function () use ($data) {
                        return view('mahasiswa.konsultasi', array_merge($data, ['menu' => 'add-edit', 'subtitle' => "Buat Konsultasi"]));
                    })->name('user.konsultasi.umum.add');

                    Route::get('edit/{konsul_id}', function ($konsul_id) use ($data) {
                        return view('mahasiswa.konsultasi', array_merge($data, ['menu' => 'add-edit', 'subtitle' => 'Edit Konsultasi', 'konsul_id' => $konsul_id]));
                    })->name('user.konsultasi.umum.edit');

                    Route::get("{konsul}", function ($konsul_id) use ($data) {
                        $data['title'] = 'Discussion Room';
                        return view('mahasiswa.konsultasi', array_merge($data, ['menu' => 'room', 'konsul_id' => $konsul_id]));
                    })->name('user.konsultasi.umum.room');
                });

                Route::prefix('akademik')->group(function () {
                    $data = ['category' => AppKonsul::TYPE_AKADEMIK, 'title' => "Konsultasi Akademik"];

                    Route::get('', function () use ($data) {
                        return view('mahasiswa.konsultasi', array_merge($data, ['menu' => 'table']));
                    })->name('user.konsultasi.akademik.table');

                    Route::get('add', function () use ($data) {
                        return view('mahasiswa.konsultasi', array_merge($data, ['menu' => 'add-edit', 'subtitle' => 'Buat Konsultasi']));
                    })->name('user.konsultasi.akademik.add');

                    Route::get('edit/{konsul_id}', function ($konsul_id) use ($data) {
                        return view('mahasiswa.konsultasi', array_merge($data, ['menu' => 'add-edit', 'subtitle' => 'Edit Konsultasi', 'konsul_id' => $konsul_id]));
                    })->name('user.konsultasi.akademik.edit');

                    Route::get("{konsul_id}", function ($konsul_id) use ($data) {
                        $data['title'] = 'Discussion Room';
                        return view('mahasiswa.konsultasi', array_merge($data, ['menu' => 'room', 'konsul_id' => $konsul_id]));
                    })->name('user.konsultasi.akademik.room');
                });
            });

        Route::prefix('sambat')->group(function () {
            Route::get('', function () {
                return view('mahasiswa.sambat');
            })->name('user.sambat');

            Route::get('add', SambatForm::class)->name('user.sambat.add');
            Route::get('edit/{sambat}', SambatForm::class)->name('user.sambat.edit');
        });

        Route::get('skripsi', function () {
            return view('mahasiswa.skripsi');
        })->name('user.skripsi');
    });
});

Route::get('test', function () {
    $konsul = Konsul::first();
    return view('guest.contoh', ['description' => $konsul->description]);
});
