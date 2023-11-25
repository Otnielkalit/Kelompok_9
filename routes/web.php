<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AspekController;
use App\Http\Controllers\PoinAspekController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;

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

Route::get('/dashboard/users/cari', 'UserController@search')->name('users.search');

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login'])->name('login.action');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout.action')->middleware('checkRole:admin,guru,siswa');
});

Route::group(['prefix' => '/'], function() {
    Route::get('/', function () {
        return view('landing');
    })->name('landing');
    Route::get('/about', function () {
        return view('about');
    });
    Route::get('/contact', function () {
        return view('contact');
    });
    Route::get('/signin', function () {
        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('login');
    })->name('login');
});

    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    Route::get('/guru', [GuruController::class, 'guru'])->name('guru')->middleware('checkRole:admin');
    Route::post('/guru', [GuruController::class, 'add_account'])->name('guru.add')->middleware('checkRole:admin');
    Route::get('/guru/{guru_id}', [GuruController::class, 'guruEdit'])->name('guruEdit')->middleware('checkRole:admin');
    Route::put('/guru/{user_id}/{guru_id}', [GuruController::class, 'guruEdit_action'])->name('guruEdit_action')->middleware('checkRole:admin');
    Route::delete('/guru/{guru_id}', [GuruController::class, 'remove_account'])->name('guru.remove')->middleware('checkRole:admin');
    Route::get('/cari', [GuruController::class, 'cariGuru'])->name('guru.cari');
// });

Route::get('/siswa', [SiswaController::class, 'siswa'])->name('siswa')->middleware('checkRole:admin');
    Route::post('/siswa', [SiswaController::class, 'add_account'])->name('siswa.add')->middleware('checkRole:admin');
    Route::get('/siswa/{siswa_id}', [SiswaController::class, 'siswaEdit'])->name('siswaEdit')->middleware('checkRole:admin');
    Route::put('/siswa/{user_id}/{siswa_id}', [SiswaController::class, 'siswaEdit_action'])->name('siswaEdit_action')->middleware('checkRole:admin');
    Route::delete('/siswa/{siswa_id}', [SiswaController::class, 'remove_account'])->name('siswa.remove')->middleware('checkRole:admin');
    Route::get('/cari', [SiswaController::class, 'cariSiswa'])->name('siswa.cari');


    
Route::resource('calendar', CalendarController::class)->only(['index','edit','store']);
Route::controller(CalendarController::class)->group(function () {
    Route::get('getevents','getEvents')->name('calendar.getevents');
    Route::put('update/events','updateEvents')->name('calendar.updateevents');
    Route::post('resize/events','resizeEvents')->name('calendar.resizeevents');
    Route::post('drop/events','dropEvents')->name('calendar.dropevents');
});

    Route::get('/aspek', [AspekController::class, 'aspek'])->name('aspek')->middleware('checkRole:admin,guru');
    Route::post('/aspek', [AspekController::class, 'aspek_add'])->name('aspek.add')->middleware('checkRole:admin,guru');
    Route::delete('/aspek/{aspek_id}', [AspekController::class, 'remove_aspek'])->name('aspek.remove')->middleware('checkRole:admin,guru');
    Route::get('/aspek/{aspek_id}', [AspekController::class, 'aspekEdit_view'])->name('aspekEdit')->middleware('checkRole:admin,guru');
    Route::put('/aspek/{aspek_id}', [AspekController::class, 'aspekEdit_action'])->name('aspekEdit_action')->middleware('checkRole:admin,guru');
    Route::get('/aspek/cari', [AspekController::class, 'cariAspek']);

    Route::get('/kelas', [KelasController::class, 'kelas'])->name('kelas')->middleware('checkRole:admin,guru');
    Route::post('/kelas', [KelasController::class, 'kelas_add'])->name('kelas.add')->middleware('checkRole:admin,guru');
    Route::delete('/kelas/{kelas_id}', [KelasController::class, 'remove_kelas'])->name('kelas.remove')->middleware('checkRole:admin,guru');
    Route::get('/kelas/{kelas_kode}', [KelasController::class, 'kelasEdit_view'])->name('kelasEdit')->middleware('checkRole:admin,guru');
    Route::put('/kelas/{kelas_id}', [KelasController::class, 'kelasEdit_action'])->name('kelasEdit_action')->middleware('checkRole:admin,guru');
    Route::get('/kelas/cari', [KelasController::class, 'cariKelas']);

    Route::get('/poin-penilaian', [PoinAspekController::class, 'poin_penilaian'])->name('poin_penilaian')->middleware('checkRole:admin,guru');
    Route::get('/poin-penilaian/{poin_id}', [PoinAspekController::class, 'edit_view_poin_penilaian'])->name('edit_view_poin_penilaian')->middleware('checkRole:admin,guru');
    Route::post('/poin-penilaian', [PoinAspekController::class, 'add_poin_penilaian'])->name('add_poin_penilaian')->middleware('checkRole:admin,guru');
    Route::put('/poin-penilaian/{poin_id}', [PoinAspekController::class, 'edit_action_poin_penilaian'])->name('edit_action_poin_penilaian')->middleware('checkRole:admin,guru');
    Route::delete('/poin-penilaian/{poin_id}', [PoinAspekController::class, 'remove_poin_penilaian'])->name('remove_poin_penilaian')->middleware('checkRole:admin,guru');
    Route::get('/poin-penilaian/cari', [PoinAspekController::class, 'cariPoin']);

    Route::get('/nilai', [NilaiController::class, 'nilai'])->name('nilai')->middleware('checkRole:guru');
    Route::get('/nilai/{user_id}', [NilaiController::class, 'nilai_detail'])->name('nilai_detail')->middleware('checkRole:guru');
    Route::post('/nilai/{user_id}', [NilaiController::class, 'nilai_add'])->name('nilai.add')->middleware('checkRole:guru');
    Route::delete('/nilai/{user_id}/{nilai_id}', [NilaiController::class, 'remove_nilai'])->name('nilai.remove')->middleware('checkRole:guru');
    Route::get('/nilai/cari', [NilaiController::class, 'cariNilai']);

    Route::get('/profile/{user_id}', [Dashboard::class, 'profile'])->name('profile');
    Route::put('/profile/{user_id}', [Dashboard::class, 'profile_update'])->name('profile.update');


    Route::get('print/{user_id}', [Dashboard::class, 'print'])->name('print');