<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Biodata;
use App\Models\Guru;
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

class PoinAspekController extends Controller
{

    
    public function poin_penilaian()
{
    $user = Auth::user();
    $guru = Guru::where('user_id', $user->id)->first();

    if (!$guru || !$guru->kelas_id) {
        // Handle jika guru tidak ditemukan atau kelas_id kosong
        // Misalnya, tampilkan pesan error atau lakukan tindakan lain
    }

    $kelas_id = $guru->kelas_id;

    $aspeks = Aspek::whereHas('kelas', function ($query) use ($kelas_id) {
        $query->where('id', $kelas_id);
    })->get();

    $poins = PoinAspek::join('aspek', 'aspek.id', '=', 'poin_aspek.aspek_id')
        ->join('kelas', 'kelas.id', '=', 'aspek.kelas_id')
        ->where('kelas.id', $kelas_id)
        ->select('poin_aspek.*', 'aspek.nama_aspek', 'aspek.kode')
        ->paginate(5);

    return view('dashboard.poin_penilaian', compact('aspeks', 'poins'));
}



    public function add_poin_penilaian(Request $request) {
        $request->validate([
            'nama_poin' => 'required|unique:poin_aspek,nama_poin',
            'aspek_id' => 'required',
        ], [
            'nama_poin.required' => 'Nama poin penilaian harus diisi',
            'nama_poin.unique' => 'Nama poin penilaian sudah ada',
            'aspek_id.required' => 'Id aspek harus diisi',
        ]);
    
        $aspek_id = $request->aspek_id;
        $aspek = Aspek::find($aspek_id);
    
        $poin_aspek = PoinAspek::create([
            'nama_poin' => $request->nama_poin,
            'aspek_id' => $aspek_id,
        ]);
    
        $notification = array(
            'message' => 'Berhasil menambahkan data poin penilaian!',
            'alert-type' => 'success'
        );
    
        return redirect('poin-penilaian')->with($notification)->with('aspek', $aspek);
    }
    
    
    

    public function edit_view_poin_penilaian($poin_id) {
        $poin = PoinAspek::find($poin_id);
        $user = Auth::user();
        $guru = Guru::where('user_id', $user->id)->first();
    
        if (!$guru || !$guru->kelas_id) {
            // Handle jika guru tidak ditemukan atau kelas_id kosong
            // Misalnya, tampilkan pesan error atau lakukan tindakan lain
        }
    
        $kelas_id = $guru->kelas_id;
    
        $aspeks = Aspek::where('kelas_id', $kelas_id)->get();
    
        return view('dashboard.poin_penilaian_edit', [
            'poin' => $poin,
            'aspeks' => $aspeks
        ]);
    }
    


    public function edit_action_poin_penilaian(Request $request, $poin_id)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama_poin' => ['required', Rule::unique('poin_aspek')->ignore($poin_id)],
        'aspek_id' => 'required',
    ]);

    // Temukan data poin penilaian
    $poin = PoinAspek::find($poin_id);
    if (!$poin) {
        return redirect('poin-penilaian')->with('error', 'Poin penilaian tidak ditemukan!');
    }

    // Perbarui data poin penilaian dalam transaksi database
    DB::beginTransaction();
    try {
        $poin->nama_poin = $validatedData['nama_poin'];
        $poin->aspek_id = $validatedData['aspek_id'];
        $poin->save();

        DB::commit();

        return redirect('poin-penilaian')->with('success', 'Berhasil memperbaharui data poin penilaian!');
    } catch (\Exception $e) {
        DB::rollback();

        return redirect('poin-penilaian')->with('error', 'Terjadi kesalahan saat memperbaharui data poin penilaian!');
    }
}

    public function remove_poin_penilaian($poin_id) {
        PoinAspek::find($poin_id)->delete();
        // return redirect('dashboard/poin-penilaian')->with('success', 'Berhasil menghapus data poin penilaian!');
        return back();
    }

public function cariPoin(Request $request)
	{
		// menangkap data pencarian
		$cariPoin = $request->cari;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$poins = DB::table('poin_aspek')
		->where('id','like',"%".$cariPoin."%")
        ->orWhere('nama_poin','like',"%".$cariPoin."%")
        ->orWhere('aspek_id','like',"%".$cariPoin."%")
		->paginate();
 
    		// mengirim data pegawai ke view index
            return view('dashboard.poin_penilaian', ['poins' => $poins]);
 
	}
}