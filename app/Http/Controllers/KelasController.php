<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Akun;
use App\Models\Aspek;
use App\Models\PoinAspek;
use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Guru;
use RealRashid\SweetAlert\Facades\Alert;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class KelasController extends Controller
{

public function cariKelas(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$kelass = DB::table('kelas')
		->where('kode','like',"%".$cari."%")
        ->orWhere('nama_kelas','like',"%".$cari."%")
		->paginate();
 
    		// mengirim data pegawai ke view index
            return view('dashboard.kelas', ['kelass' => $kelass]);
 
	}

    public function kelas() {
        $kelass = Kelas::paginate(5);

        return view('dashboard.kelas', ['kelass' => $kelass]);
    }

    
    public function kelas_add(Request $request) {
        $request->validate([
            'kode' => 'required|unique:kelas,kode',
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
        ], [
            'kode.required' => 'Kode kelas harus diisi',
            'kode.unique' => 'Kode kelas sudah ada',
            'nama_kelas.required' => 'Nama kelas harus diisi',
            'nama_kelas.unique' => 'Nama kelas sudah ada',
            
        ]);
    
        $kelas = Kelas::create([
            'kode' => $request->kode,
            'nama_kelas' => $request->nama_kelas,
        ]);
    
        $notification = array(
            'message' => 'Berhasil menambahkan data kelas!',
            'alert-type' => 'success'
        );
    
        return redirect('kelas')->with($notification);
    }


    public function remove_kelas($kelas_id) {
        $kelas = Kelas::find($kelas_id);
    
        // Cek ketergantungan pada tabel Siswa
        if (Siswa::where('kelas_id', $kelas->id)->exists()) {
            return back()->with('error', 'Gagal menghapus data kelas. Terdapat data terkait dalam tabel Siswa.');
        }
    
        // Cek ketergantungan pada tabel Guru
        if (Guru::where('kelas_id', $kelas->id)->exists()) {
            return back()->with('error', 'Gagal menghapus data kelas. Terdapat data terkait dalam tabel Guru.');
        }
    
        $kelas->delete();
    
        return back()->with('success', 'Berhasil menghapus data kelas!');
    }
    

    public function kelasEdit_view($kelas_id) {
        $kelas = Kelas::find($kelas_id);
        return view('dashboard.kelas_edit', ['kelas' => $kelas]);
    }

public function kelasEdit_action(Request $request, $kelas_id)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama_kelas' => 'required',
        'kode' => ['required', Rule::unique('kelas')->ignore($kelas_id)],
    ]);

    // Temukan data kelas
    $kelas = Kelas::find($kelas_id);
    if (!$kelas) {
        return redirect('kelas')->with('error', 'Kelas tidak ditemukan!');
    }

    // Perbarui data kelas dalam transaksi database
    DB::beginTransaction();
    try {
        $kelas->nama_kelas = $validatedData['nama_kelas'];
        $kelas->kode = $validatedData['kode'];
        $kelas->save();

        DB::commit();

        return redirect('kelas')->with('success', 'Berhasil memperbaharui data kelas!');
    } catch (\Exception $e) {
        DB::rollback();

        return redirect('kelas')->with('error', 'Terjadi kesalahan saat memperbaharui data kelas!');
    }
}

}
