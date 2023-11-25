<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Aspek;
use App\Models\PoinAspek;
use App\Models\Nilai;
use App\Models\Kelas;
use RealRashid\SweetAlert\Facades\Alert;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class Dashboard extends Controller
{
    public function index(){
       
        if (Auth::check() && Auth::user()->role === 'siswa') {
            // Akun yang sedang login adalah akun siswa
            $user = Auth::user();
            $siswa = Siswa::where('user_id', $user->id)->first();
    
            if (!$siswa || !$siswa->kelas_id) {
                // Handle jika data siswa tidak ditemukan atau properti 'kelas_id' kosong
                // Misalnya, tampilkan pesan error atau lakukan tindakan lain
            }
    
            $kelas_id = $siswa->kelas_id;
    
            $nilai = Nilai::join('poin_aspek', 'poin_aspek.id', '=', 'nilai_siswa.poin_id')
                ->join('aspek', 'aspek.id', '=', 'poin_aspek.aspek_id')
                ->where('nilai_siswa.user_id', $user->id)
                ->where('aspek.kelas_id', $kelas_id)
                ->select('nilai_siswa.*', 'poin_aspek.nama_poin', 'aspek.nama_aspek')
                ->paginate(10);
    
            $poin_aspek = PoinAspek::whereHas('aspek', function ($query) use ($kelas_id) {
                $query->where('kelas_id', $kelas_id);
            })
            ->select('poin_aspek.*')
            ->get();
    
            return view('dashboard.index', compact('nilai', 'poin_aspek'));
        }

        $total_siswa = User::where('role', '=', 'siswa')->count();
        $total_guru = User::where('role', '=', 'guru')->count();
        $total_kelas = Kelas::count();

        return view('dashboard.index', [
            'total_siswa' => $total_siswa,
            'total_guru' => $total_guru,
            'total_kelas' => $total_kelas,

        ]);
    }


    public function profile($user_id) {
        $user = User::find($user_id); // Mendapatkan data pengguna berdasarkan $user_id
    
        if ($user->role === 'guru') {
            $guru = Guru::where('user_id', '=', $user_id)
                ->join('akun', 'akun.id', '=', 'guru.user_id')
                ->get();
            return view('dashboard.profile_guru', ['guru' => $guru[0]]);
        } else if($user->role === 'siswa'){
            $siswa = Siswa::where('user_id', '=', $user_id)
                ->join('akun', 'akun.id', '=', 'siswa.user_id')
                ->get();
            return view('dashboard.profile', ['siswa' => $siswa[0]]);
        }else if($user->role === 'admin'){
            $admin = Admin::where('user_id', '=', $user_id)
                ->join('akun', 'akun.id', '=', 'admin.user_id')
                ->get();
            return view('dashboard.profile', ['admin' => $admin[0]]);
        }
    }
    


    public function profile_update(Request $request, $user_id)
{
    $user = User::find($user_id);

    if ($user) {
        $user->nama = $request->nama;
        $user->save();

        $biodata = Siswa::where('user_id', $user_id)->first();
        $guru = Guru::where('user_id', $user_id)->first();

        if ($biodata) {
            $biodata->tempat_lahir = $request->tempat_lahir;
            $biodata->tanggal_lahir = $request->tanggal_lahir;
            $biodata->jenis_kelamin = $request->jenis_kelamin;
            $biodata->agama = $request->agama;
            $biodata->alamat = $request->alamat;
            $biodata->save();
        }

        if ($guru) {
            $guru->tempat_lahir = $request->tempat_lahir;
            $guru->tanggal_lahir = $request->tanggal_lahir;
            $guru->jenis_kelamin = $request->jenis_kelamin;
            $guru->agama = $request->agama;
            $guru->alamat = $request->alamat;
            $guru->save();
        }

        return redirect('profile/'.$user_id)->with('success', 'Profil berhasil diperbarui!');
    } else {
        return redirect('profile/'.$user_id)->with('error', 'Pengguna tidak ditemukan!');
    }
}
   

    public function print($user_id) {
        $nilai = Nilai::where('user_id', '=', $user_id)
            ->join('poin_aspek', 'poin_aspek.id', '=', 'nilai_siswa.poin_id')
            ->join('aspek', 'aspek.id', '=', 'poin_aspek.aspek_id')
            ->select('nilai_siswa.*', 'poin_aspek.nama_poin', 'aspek.nama_aspek', 'nilai_siswa.created_at')
            ->get();

        $siswas = Siswa::where('user_id', '=', $user_id)
            ->join('akun', 'akun.id', '=', 'siswa.user_id')
            ->get();
        $siswa = $siswas[0];
        $pdf = PDF::loadView('dashboard.print', compact('nilai', 'siswa'));
        return $pdf->stream('Rapor Penilaian-'.$siswa->id.'-'.$siswa->nama.'.pdf');
    }
}