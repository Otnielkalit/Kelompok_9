<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
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

class GuruController extends Controller
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

    

    public function guru() {
        $kelass = Kelas::all();
        $gurus = Guru::join('akun', 'akun.id','=', 'guru.user_id')
            ->join('kelas', 'kelas.id', '=', 'guru.kelas_id')
            ->select('akun.nama', 'akun.username','akun.role', 'guru.*', 'kelas.nama_kelas' )
            ->paginate(10);

        return view('dashboard.guru', ['gurus' => $gurus, 'kelass' => $kelass]);
    }


    public function cariGuru(Request $request)
    {

        $cari = $request->cari;

        $kelass = Kelas::all();
        $gurus = Guru::join('akun', 'akun.id', '=', 'guru.user_id')
            ->join('kelas', 'kelas.id', '=', 'guru.kelas_id')
            ->select('akun.nama', 'akun.username', 'akun.role', 'guru.*', 'kelas.nama_kelas')
            ->where(function ($query) use ($cari) {
                $query->where('akun.nama', 'like', '%' . $cari . '%')
                    ->orWhere('akun.username', 'like', '%' . $cari . '%')
                    ->orWhere('guru.jenis_kelamin', 'like', '%' . $cari . '%')
                    ->orWhere('kelas.nama_kelas', 'like', '%' . $cari . '%');
            })
            ->paginate(10);

        return view('dashboard.guru', ['gurus' => $gurus, 'kelass' => $kelass]);
    }

   

    public function add_account(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required|min:6',
        'nama' => 'required',
        'role' => 'required',
        'photo' => 'image|mimes:jpg,png,jpeg',
        'nip' => 'required|unique:guru', // Menambahkan "guru" setelah "unique"
    ]);

    $user = User::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'nama' => $request->nama,
        'role' => $request->role
    ]);
    // $recordUser = User::create($user);

    $photo = '';

    if ($request->has('photo')) {
        $imageName = $this->save_photo($request);
        $photo = $imageName;
    }

    $guru = Guru::create([
        'user_id' => $user->id, // Menggunakan $recordUser untuk mendapatkan ID yang baru saja dibuat
        'nip' => $request->nip,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'poto' => $photo,
        'agama' => $request->agama,
        'kelas_id' => $request->kelas_id,
        'alamat' => $request->alamat,
    ]);

    return redirect('guru')->with('success', 'Berhasil membuat akun baru!');
}

    
    public function remove_account(Request $request, $guru_id) {
        $guru = Guru::find($guru_id);
        $user_id = $guru->user_id;
        $photo = $guru->photo;
        Storage::delete('images/'.$photo);
        Guru::find($guru_id)->delete();
        user::find($user_id)->delete();
        // return redirect('dashboard/users')->with('succces', 'Berhasil menghapus akun baru!');
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

    public function guruEdit($guru_id) {
        $kelass = Kelas::all();
        $user = Guru::join('akun', 'akun.id', '=', 'guru.user_id')
        ->join('kelas', 'kelas.id', '=', 'guru.kelas_id')
            ->select('akun.*', 'guru.*')
            ->where('guru.id', '=', $guru_id)
            ->get();

        return view('dashboard.guru_edit', ['user' => $user[0], 'kelass' => $kelass]);
    }

    public function guruEdit_action(Request $request, $user_id, $guru_id) {
        $user = User::where('id', $user_id)->first();
        $guru = Guru::where('id', $guru_id)->first();

        if($request->nip && $request->nisn) {
            $request->validate([
                'nama' => 'required',
                'password' => 'required',
                'nip' => 'unique:guru,nip,'.$guru_id,
                'nisn' => 'unique:guru,nisn,'.$guru_id,
            ]);
        } else if($request->nip && !$request->nisn) {
            $request->validate([
                'nama' => 'required',
                'password' => 'required',
                'nip' => 'required|unique:guru,nip,'.$guru_id,
            ]);
        } else if(!$request->nip && $request->nisn) {
            $request->validate([
                'nama' => 'required',
                'password' => 'required',
                'nisn' => 'required|unique:guru,nisn,'.$guru_id,
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

        $photo = $guru->poto;

        if($request->has('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $this->remove_photo($guru->photo);
            $imageName = $this->save_photo($request);
            $photo = $imageName;
        }

        $guru->update([
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'kelas_id' => $request->kelas,
            'alamat' => $request->alamat,
            'poto' => $photo
        ]);

        $guru->save();

        return redirect('guru')->with('success', 'Berhasil memperbaharui akun!');
    }

    public function profile_guru($user_id) {
        $guru = Guru::where('user_id', '=', $user_id)
            ->join('akun', 'akun.id', '=', 'guru.user_id')
            // ->join('kelas', 'kelas.id', '=', 'biodata.kelas_id')
            ->get();
        return view('dashboard.profile_guru', ['guru' => $guru[0]]);
    }


    public function profile_update_guru(Request $request, $user_id, $guru_id)
{
    $user = User::where('id', $user_id)->first();
    $guru = Guru::where('id', $guru_id)->first();

    if($request->nip && $request->nisn) {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'nip' => 'unique:guru,nip,'.$guru_id,
            'nisn' => 'unique:guru,nisn,'.$guru_id,
        ]);
    } else if($request->nip && !$request->nisn) {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'nip' => 'required|unique:guru,nip,'.$guru_id,
        ]);
    } else if(!$request->nip && $request->nisn) {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'nisn' => 'required|unique:guru,nisn,'.$guru_id,
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

    $photo = $guru->poto;

    if($request->has('photo')) {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $this->remove_photo($guru->photo);
        $imageName = $this->save_photo($request);
        $photo = $imageName;
    }

    $guru->update([
        'nip' => $request->nip,
        'tempat_lahir' => $request->tempat_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_lahir' => $request->tanggal_lahir,
        'agama' => $request->agama,
        'kelas_id' => $request->kelas,
        'alamat' => $request->alamat,
        'poto' => $photo
    ]);

    $guru->save();

    return redirect('guru')->with('success', 'Berhasil memperbaharui akun!');
}

    
    
    
    
    
    

    
}