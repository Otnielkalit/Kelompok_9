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

class SiswaController extends Controller
{
    public function index(){
       

        $total_siswa = User::where('role', '=', 'siswa')->count();
        $total_guru = User::where('role', '=', 'guru')->count();
        $total_kelas = Kelas::count();

        return view('dashboard.index', [
            'total_siswa' => $total_siswa,
            'total_guru' => $total_guru,
            'total_kelas' => $total_kelas,

        ]);
    }

    

    public function siswa() {
        $kelass = Kelas::all();
        $siswas = Siswa::join('akun', 'akun.id','=', 'siswa.user_id')
            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->select('akun.nama', 'akun.username','akun.role', 'siswa.*', 'kelas.nama_kelas' )
            ->paginate(10);

        return view('dashboard.siswa', ['siswas' => $siswas, 'kelass' => $kelass]);
    }


    public function cariSiswa(Request $request)
    {

        $cari = $request->cari;

        $kelass = Kelas::all();
        $siswas = Siswa::join('akun', 'akun.id', '=', 'siswa.user_id')
            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->select('akun.nama', 'akun.username', 'akun.role', 'siswa.*', 'kelas.nama_kelas')
            ->where(function ($query) use ($cari) {
                $query->where('akun.nama', 'like', '%' . $cari . '%')
                    ->orWhere('akun.username', 'like', '%' . $cari . '%')
                    ->orWhere('siswa.jenis_kelamin', 'like', '%' . $cari . '%')
                    ->orWhere('kelas.nama_kelas', 'like', '%' . $cari . '%');
            })
            ->paginate(10);

        return view('dashboard.siswa', ['siswas' => $siswas, 'kelass' => $kelass]);
    }

    

    public function add_account(Request $request)
{
    $request->validate([
        'username' => 'required|unique:akun',
        'password' => 'required|min:6',
        'nama' => 'required',
        'role' => 'required',
        'photo' => 'image|mimes:jpg,png,jpeg',
        'nisn' => 'required|unique:siswa',
    ], [
        'username.required' => 'Username harus diisi',
        'username.unique' => 'Username sudah ada',
        'password.required' => 'Password harus diisi minimal panjangnya 6',
        'nama.required' => 'Nama harus diisi',
        'nisn.required' => 'NISN harus diisi',
        'nisn.unique' => 'NISN sudah ada',
    ]);

    $user = User::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'nama' => $request->nama,
        'role' => $request->role
    ]);

    $photo = '';

    if ($request->has('photo')) {
        $imageName = $this->save_photo($request);
        $photo = $imageName;
    }

    $siswa = Siswa::create([
        'user_id' => $user->id,
        'nisn' => $request->nisn,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'poto' => $photo,
        'agama' => $request->agama,
        'kelas_id' => $request->kelas_id,
        'nama_ayah' => $request->nama_ayah,
        'nama_ibu' => $request->nama_ibu,
        'alamat' => $request->alamat,
    ]);

    return redirect('siswa')->with('success', 'Berhasil membuat akun baru!');
}


    
    public function remove_account(Request $request, $siswa_id) {
        $siswa = Siswa::find($siswa_id);
        $user_id = $siswa->user_id;
        $photo = $siswa->photo;
        Storage::delete('images/'.$photo);
        Siswa::find($siswa_id)->delete();
        user::find($user_id)->delete();
        // return redirect('dashboard/akun')->with('succces', 'Berhasil menghapus akun baru!');
        return back();
    }

    public function save_photo($request) {
        $imageName = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('/storage/images'), $imageName);
        return $imageName;
    }

    public function remove_photo($photo) {
        if(Storage::exists('images/'.$photo)){
            Storage::delete('images/'.$photo);
            return true;
        }else{
            return false;
        }
    }

    public static function quickRandom($length = 12) {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function siswaEdit($siswa_id) {
        $kelass = Kelas::all();
        $user = Siswa::join('akun', 'akun.id', '=', 'siswa.user_id')
        ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->select('akun.*', 'siswa.*')
            ->where('siswa.id', '=', $siswa_id)
            ->get();

        return view('dashboard.siswa_edit', ['user' => $user[0], 'kelass' => $kelass]);
    }

    public function siswaEdit_action(Request $request, $user_id, $siswa_id) {
        $user = User::where('id', $user_id)->first();
        $siswa = Siswa::where('id', $siswa_id)->first();

        if($request->nip && $request->nisn) {
            $request->validate([
                'nama' => 'required',
                'password' => 'required',
                'nip' => 'unique:siswa,nip,'.$siswa_id,
                'nisn' => 'unique:siswa,nisn,'.$siswa_id,
            ]);
        } else if($request->nip && !$request->nisn) {
            $request->validate([
                'nama' => 'required',
                'password' => 'required',
                'nip' => 'required|unique:siswa,nip,'.$siswa_id,
            ]);
        } else if(!$request->nip && $request->nisn) {
            $request->validate([
                'nama' => 'required',
                'password' => 'required',
                'nisn' => 'required|unique:siswa,nisn,'.$siswa_id,
            ]);
        } else {
            $request->validate([
                'nama' => 'required',
                'password' => 'required',
            ]);
        }

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        $user->save();

        $photo = $siswa->poto;

        if($request->has('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $this->remove_photo($siswa->photo);
            $imageName = $this->save_photo($request);
            $photo = $imageName;
        }

        $siswa->update([
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'kelas_id' => $request->kelas,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'alamat' => $request->alamat,
            'poto' => $photo
        ]);

        $siswa->save();

        return redirect('siswa')->with('success', 'Berhasil memperbaharui akun!');
    }
    
}