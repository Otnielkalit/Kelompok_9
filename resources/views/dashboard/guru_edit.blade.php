@extends('layout.dashboard_template')
@section('dashboard-content')

<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Form Update Data Guru</h6>
        </div>
    </div>
    <div class="card-body px-4 pb-2">
        <form action="{{ url('guru/'.$user->user_id.'/'.$user->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <h6>Akun</h6>
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <div class="input-group input-group-outline my-3">
                        <input value="{{ $user->username }}" name="username" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <div class="input-group input-group-outline my-3">
                        <input name="password" type="password" class="form-control">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror   
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group input-group-outline my-3">
                        <input value="{{ $user->nama }}" name="nama" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="role" class="ms-0">Role</label>
                        <input name="role" type="text" class="form-control" value="guru" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <h6>Foto</h6>
                <div class="d-flex px-2 mb-4">
                    <div>
                        <img src="{{ asset('storage/images/'.$user->poto) }}"
                            class="avatar avatar-xl rounded-circle me-2" alt="profile-user">
                    </div>
                    <div class="my-auto">
                        <div class="input-group input-group-outline my-3">
                            <input id="photo" name="photo" type="file" accept=".png, .jpeg, .jpg" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h6>Biodata</h6>
                <div class="col-md-4">
                    <label class="form-label">NIP</label>
                    <div class="input-group input-group-outline my-3">
                        <input value="{{ $user->nip }}" name="nip" type="number" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Tempat Lahir</label>
                    <div class="input-group input-group-outline my-3">
                        <input value="{{ $user->tempat_lahir }}" name="tempat_lahir" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir</label>
                    <div class="input-group input-group-outline my-3">
                        <input value="{{ $user->tanggal_lahir }}" name="tanggal_lahir" type="date" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jenis Kelamin</label>
                    @if($user->jenis_kelamin === 'l')
                    <div class="form-check mb-3">
                        <input checked class="form-check-input" value="l" type="radio" name="jenis_kelamin"
                            id="laki_laki">
                        <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="p" type="radio" name="jenis_kelamin" id="perempuan">
                        <label class="custom-control-label" for="perempuan">Perempuan</label>
                    </div>
                    @elseif($user->jenis_kelamin === 'p')
                    <div class="form-check mb-3">
                        <input class="form-check-input" value="l" type="radio" name="jenis_kelamin" id="laki_laki">
                        <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input checked class="form-check-input" value="p" type="radio" name="jenis_kelamin"
                            id="perempuan">
                        <label class="custom-control-label" for="perempuan">Perempuan</label>
                    </div>
                    @else
                    <div class="form-check mb-3">
                        <input class="form-check-input" value="l" type="radio" name="jenis_kelamin" id="laki_laki">
                        <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="p" type="radio" name="jenis_kelamin" id="perempuan">
                        <label class="custom-control-label" for="perempuan">Perempuan</label>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="agama" class="ms-0">Agama</label>
                        <select name="agama" class="form-control" id="agama">
                            @if($user->agama === 'islam')
                            <option value="">Pilih agama</option>
                            <option selected value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="konghucu">Konghucu</option>
                            @elseif($user->agama === 'kristen')
                            <option value="">Pilih agama</option>
                            <option value="islam">Islam</option>
                            <option selected value="kristen">Kristen</option>
                            <option value="budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="konghucu">Konghucu</option>
                            @elseif($user->agama === 'budha')
                            <option value="">Pilih agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option selected value="budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="konghucu">Konghucu</option>
                            @elseif($user->agama === 'hindu')
                            <option value="">Pilih agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="budha">Budha</option>
                            <option selected value="Hindu">Hindu</option>
                            <option value="konghucu">Konghucu</option>
                            @elseif($user->agama === 'konghucu')
                            <option value="">Pilih agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option selected value="konghucu">Konghucu</option>
                            @else
                            <option value="">Pilih agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="konghucu">Konghucu</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="kelas" class="ms-0">Kelas</label>
                        <select name="kelas" class="form-control" id="kelas">
                            @if(count($kelass) > 0)
                            @foreach($kelass as $kelas)
                            @if($kelas->id === $user->kelas_id)
                            <option selected value="{{ $kelas->id }}">{{ $kelas->nama_kelas}}</option>
                            @else
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endif
                            @endforeach
                            @endif
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic">
                        <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat"
                            spellcheck="false">{{ $user->alamat }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <a href="{{ route('guru') }}" type="reset" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection