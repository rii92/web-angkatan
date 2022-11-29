<?php

use App\Constants\AppKonsul;
use Illuminate\Support\Facades\Route;
use App\Constants\AppPermissions;
use App\Http\Controllers\SimulationController;
use App\Http\Livewire\Admin\Announcement\Form as AnnouncementForm;
use App\Http\Livewire\Admin\Konsultasi\DiscussionRoom as KonsultasiDiscussionRoom;
use App\Http\Livewire\Guest\Konsultasi\Detail as KonsultasiDetail;
use App\Http\Livewire\Mahasiswa\Konsultasi\DiscussionRoom;
use App\Http\Livewire\Mahasiswa\Konsultasi\Form;
use App\Http\Livewire\Mahasiswa\Sambat\Form as SambatForm;
use App\Models\Announcement;
use App\Models\Meeting;
use App\Models\Satker;
use App\Models\Simulations;
use App\Models\UserFormations;
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


/** Route landing page */
Route::get('/', fn () => view('guest.landingpage'))->name('home');
Route::get('/proker', fn () => view('guest.proker'))->name('proker');
Route::get('/sambat', fn () => view('guest.sambat'))->name('sambat');

Route::prefix('konsultasi')->group(function () {
    Route::get('', fn () => view('guest.konsultasi'))->name('konsultasi.list');
    Route::get('{slug}', KonsultasiDetail::class)->name('konsultasi.detail');
});

Route::prefix('informasi')->group(function () {
    Route::get('', fn () => view('guest.announcement'))->name('announcement');
    Route::get('{announcement}', fn (Announcement $announcement) => view('guest.announcement.details', ['announcement' => $announcement]))
        ->name('announcement.details');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('forms/{uuid}', function ($uuid) {
        return view('mahasiswa.forms.meetings', ['meeting' => Meeting::where('token', $uuid)->whereHas('members', function (Builder $query) {
            $query->where('user_id', auth()->id());
        })->firstOrFail()]);
    })->name('form');

    Route::prefix('admin')->middleware(["permission:" . AppPermissions::DASHBOARD_ACCESS])->group(function () {

        Route::get('', fn () => view('admin.home'))->name('admin.dashboard');

        Route::middleware("permission:" . AppPermissions::ADMIN_ACCESS)->group(function () {
            Route::get('users', fn () => view('admin.users'))->name('admin.users');
            Route::get('roles', fn () => view('admin.roles'))->name('admin.roles');
        });

        Route::prefix('meetings')->middleware("permission:" . AppPermissions::MEETING_MANAGEMENT)->group(function () {
            Route::get('', fn () => view('admin.meetings'))->name('admin.meetings.table');

            Route::get('{meeting}', fn (Meeting $meeting) => view('admin.meetings.details', ['meeting' => $meeting]))
                ->name('admin.meetings.details');
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
            ->get('timelines', fn () => view('admin.timelines'))
            ->name('admin.timelines.table');

        Route::middleware('permission:' . AppPermissions::TURNITIN_MANAGEMENT)
            ->get('turnitin', fn () => view('admin.turnitin'))
            ->name('admin.turnitin.table');

        Route::middleware('permission:' . AppPermissions::DELETE_SAMBAT)
            ->get('sambat', fn () => view('admin.sambat'))
            ->name('admin.sambat');

        Route::prefix('announcement')->middleware("permission:" . AppPermissions::ANNOUNCEMENT_MANAGEMENT)->group(function () {
            Route::get('', fn () => view('admin.announcement'))->name('admin.announcement.table');
            Route::get('add', AnnouncementForm::class)->name('admin.announcement.add');
            Route::get('{announcement_id}', AnnouncementForm::class)->name('admin.announcement.edit');
        });

        Route::middleware("permission:" . AppPermissions::SIMULATION_MANAGEMENT)
            ->get("satker", fn () => view('admin.satker'))
            ->name("admin.simulasi.satker");

        Route::middleware("permission:" . AppPermissions::SIMULATION_MANAGEMENT)
            ->get("simulasi", fn () => view('admin.simulation'))
            ->name("admin.simulasi.simulasi");
    });

    Route::prefix('user')->group(function () {

        Route::get('', fn () => redirect()->route('user.simulasi.table'))->name('user');
        Route::get('skripsi', fn () => view('mahasiswa.skripsi'))->name('user.skripsi');

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

            Route::prefix('akademik')->group(function () {
                Route::get('', fn () => view('mahasiswa.konsultasi', ['category' => AppKonsul::TYPE_AKADEMIK]))
                    ->name('user.konsultasi.akademik.table');

                Route::get('add', Form::class)
                    ->defaults('category', AppKonsul::TYPE_AKADEMIK)
                    ->name('user.konsultasi.akademik.add');

                Route::get('edit/{konsul_id}', Form::class)
                    ->defaults('category', AppKonsul::TYPE_AKADEMIK)
                    ->name('user.konsultasi.akademik.edit');

                Route::get('{konsul}', DiscussionRoom::class)
                    ->defaults('category', AppKonsul::TYPE_AKADEMIK)
                    ->name('user.konsultasi.akademik.room');
            });
        });

        Route::middleware('permission:' . AppPermissions::MAKE_TURNITIN)
            ->get('turnitin', fn () => view('mahasiswa.turnitin'))
            ->name('user.turnitin.table');

        Route::prefix('sambat')->group(function () {
            Route::get('', fn () => view('mahasiswa.sambat'))->name('user.sambat.table');
            Route::get('add', SambatForm::class)->name('user.sambat.add');
            Route::get('{sambat_id}', SambatForm::class)->name('user.sambat.edit')->middleware('edit.sambat');
        });

        Route::prefix("simulasi")->middleware("permission:" . AppPermissions::SIMULATION_ACCESS)->group(function () {
            Route::get("", fn () => view('mahasiswa.simulation'))->name("user.simulasi.table");
            Route::get('{simulation}', fn (Simulations $simulation) => view('mahasiswa.simulation.details', ["simulation" => $simulation]))
                ->name('user.simulasi.details');

            Route::get('{simulation}/{satker}', [SimulationController::class, 'detailSatkerKab'])
                ->name('user.simulasi.details-kab.satker');

            Route::get('{simulation}/prov/{provinsi}', [SimulationController::class, 'detailSatkerProv'])
                ->name('user.simulasi.details-prov.satker');
        });
    });
});
