<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Biodata;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Aspek;
use App\Models\PoinAspek;
use App\Models\Nilai;
use App\Models\Kelas;
use RealRashid\SweetAlert\Facades\Alert;
// use App\Models\Event;
// use App\Models\EventType;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class NilaiController extends Controller
{

    public function nilai() {
        $guru_id = Auth::user()->id;
        $guru = Guru::where('user_id', $guru_id)->first();
        
        $siswa = Siswa::where('role', '=', 'siswa')
            ->where('kelas_id', '=', $guru->kelas_id)
            ->join('akun', 'akun.id', '=', 'siswa.user_id')
            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->select('siswa.*','akun.id', 'akun.nama', 'kelas.nama_kelas')
            ->paginate(10);
        return view('dashboard.nilai', ['all_siswa' => $siswa]);
    }


// public function nilai_detail()
// {
//     $user = Auth::user();
//     $guru = Guru::where('user_id', $user->id)->first();

//     if (!$guru || !$guru->kelas_id) {
//         // Handle jika data guru tidak ditemukan atau properti 'kelas_id' kosong
//         // Misalnya, tampilkan pesan error atau lakukan tindakan lain
//     }

//     $kelas_id = $guru->kelas_id;

//     $nilai = Nilai::where('nilai_siswa.user_id', $user->id)
//         ->join('poin_aspek', 'poin_aspek.id', '=', 'nilai_siswa.poin_id')
//         ->join('aspek', 'aspek.id', '=', 'poin_aspek.aspek_id')
//         ->join('guru', 'guru.kelas_id', '=', 'aspek.kelas_id')
//         ->select('nilai_siswa.*', 'poin_aspek.nama_poin', 'aspek.nama_aspek')
//         ->where('guru.user_id', $user->id) // Filter berdasarkan user_id guru yang login
//         ->where('aspek.kelas_id', $kelas_id) // Filter berdasarkan kelas_id guru yang login
//         ->get();

//     $poin_aspek = PoinAspek::whereHas('aspek', function ($query) use ($kelas_id) {
//             $query->where('kelas_id', $kelas_id);
//         })
//         ->select('poin_aspek.*')
//         ->get();

//     return view('dashboard.nilai_detail', compact('nilai', 'poin_aspek'));
// }


public function nilai_detail($user_id) {
    $siswa = Siswa::where('user_id', $user_id)->first();
    $kelas_id = $siswa->kelas_id;

    $nilai = Nilai::where('nilai_siswa.user_id', $user_id)
        ->join('poin_aspek', 'poin_aspek.id', '=', 'nilai_siswa.poin_id')
        ->join('aspek', 'aspek.id', '=', 'poin_aspek.aspek_id')
        ->select('nilai_siswa.*', 'poin_aspek.nama_poin', 'aspek.nama_aspek')
        ->where('aspek.kelas_id', $kelas_id)
        ->get();

    $poins = PoinAspek::join('aspek', 'aspek.id', '=', 'poin_aspek.aspek_id')
        ->select('poin_aspek.*', 'aspek.nama_aspek', 'aspek.kode')
        ->where('aspek.kelas_id', $kelas_id)
        ->get();

    return view('dashboard.nilai_detail', ['nilai' => $nilai, 'poins' => $poins]);
}

 
public function nilai_add(Request $request, $user_id) {
    $request->validate([
        'semester' => 'required',
        'awal_ajaran' => 'required',
        'akhir_ajaran' => 'required',
        'poin_id' => 'required',
        'nilai' => 'required',
    ], [
        'semester.required' => 'Semester harus diisi',
        'awal_ajaran.unique' => 'Awal ajaran sudah ada',
        'akhir_ajaran.required' => 'Akhir ajaran harus diisi',
        
    ]);

    $nilai = Nilai::create([
        'semester' => $request->semester,
        'awal_ajaran' => $request->awal_ajaran,
        'akhir_ajaran' => $request->akhir_ajaran,
        'user_id' => $user_id,
        'poin_id' => $request->poin_id,
        'nilai' => $request->nilai,
    ]);

    $notification = array(
        'message' => 'Berhasil menambahkan data nilai!',
        'alert-type' => 'success'
    );

    return redirect('nilai/'.$user_id)->with($notification);
}




    public function remove_nilai($user_id, $nilai_id) {
        Nilai::find($nilai_id)->delete();
        //return redirect('dashboard/nilai/'.$user_id)->with('success', 'Berhasil menghapus data nilai!');
        return back();
    }

    public function cariNilai(Request $request)
    {

        $cari = $request->cari;

        $guru_id = Auth::user()->id;
        $guru = Biodata::where('user_id', $guru_id)->first();
        
        $siswa = Siswa::where('role', '=', 'siswa')
            ->where('kelas_id', '=', $guru->kelas_id)
            ->join('akun', 'akun.id', '=', 'siswa.user_id')
            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->select('siswa.*','akun.id', 'akun.nama', 'kelas.nama_kelas')
            ->where(function ($query) use ($cari) {
                $query->where('akun.nama', 'like', '%' . $cari . '%')
                    ->orWhere('siswa.jenis_kelamin', 'like', '%' . $cari . '%')
                    ->orWhere('kelas.nama_kelas', 'like', '%' . $cari . '%');
            })
            ->paginate(10);

            return view('dashboard.nilai', ['all_siswa' => $siswa]);
    }
}