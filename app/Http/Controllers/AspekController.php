<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Aspek;
use App\Models\PoinAspek;
use App\Models\Nilai;
use App\Models\Kelas;
use RealRashid\SweetAlert\Facades\Alert;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class AspekController extends Controller
{

public function aspek() {
        $kelass = Kelas::all();
        $aspeks = Aspek::join('kelas', 'kelas.id', '=', 'aspek.kelas_id')
        ->select( 'aspek.*', 'kelas.nama_kelas' )
        ->paginate(5);

        return view('dashboard.aspek', ['aspeks' => $aspeks, 'kelass' => $kelass]);
    }

    public function aspek_add(Request $request) {
        $request->validate([
            'nama_aspek' => 'required',
            'kode' => 'required|unique:aspek,kode',
            'kelas_id' => 'required',
        ], [
            'nama_aspek.required' => 'Nama aspek harus diisi',
            // 'nama_aspek.unique' => 'Nama aspek sudah ada',
            'kode.required' => 'Kode aspek harus diisi',
            'kode.unique' => 'Kode aspek sudah ada',
            'kelas_id.required' => 'Kelas harus diisi',
        ]);
    
        $aspek = Aspek::create([
            'nama_aspek' => $request->nama_aspek,
            'kode' => $request->kode,
            'kelas_id' => $request->kelas_id,
        ]);
    
        $notification = array(
            'message' => 'Berhasil menambahkan data aspek!',
            'alert-type' => 'success'
        );
    
        return redirect('aspek')->with($notification);
    }

    public function remove_aspek($aspek_id) {
        PoinAspek::where('aspek_id', '=', $aspek_id)->delete();
        Aspek::find($aspek_id)->delete();

        return redirect('aspek')->with('success', 'Berhasil menghapus data aspek!');
    }

    
    public function aspekEdit_view($aspek_id) {
        $aspek = Aspek::find($aspek_id);
        $kelass = Kelas::all(); 
    
        return view('dashboard.aspek_edit', ['aspek' => $aspek, 'kelass' => $kelass]);
    }
    

    public function aspekEdit_action(Request $request, $aspek_id)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama_aspek' => ['required', Rule::unique('aspek')->ignore($aspek_id)],
        'kode' => ['required', Rule::unique('aspek')->ignore($aspek_id)],
        'kelas_id' => ['required'],
    ]);

    // Temukan data aspek
    $aspek = Aspek::find($aspek_id);
    if (!$aspek) {
        return redirect('aspek')->with('error', 'Aspek tidak ditemukan!');
    }

    // Perbarui data aspek dalam transaksi database
    DB::beginTransaction();
    try {
        $aspek->nama_aspek = $validatedData['nama_aspek'];
        $aspek->kode = $validatedData['kode'];
        $aspek->kelas_id = $validatedData['kelas_id'];
        $aspek->save();

        DB::commit();

        return redirect('aspek')->with('success', 'Berhasil memperbaharui data aspek!');
    } catch (\Exception $e) {
        DB::rollback();

        return redirect('aspek')->with('error', 'Terjadi kesalahan saat memperbaharui data aspek!');
    }
}

public function cariAspek(Request $request)
	{
		// menangkap data pencarian
		$cariAspek = $request->cari;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$aspeks = DB::table('aspek')
		->where('kode','like',"%".$cariAspek."%")
        ->orWhere('nama_aspek','like',"%".$cariAspek."%")
		->paginate();
 
    		// mengirim data pegawai ke view index
            return view('dashboard.aspek', ['aspeks' => $aspeks]);
 
	}
}