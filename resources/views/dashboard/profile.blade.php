@extends('layout.dashboard_template')
@section('dashboard-content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTN96opwvG_zAn1LxfN6kEpyBvjNLEaEPRLuN6kI34hUuDrRQDQ9VEpc-A1mFX1LYO97A0&usqp=CAU');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{asset('storage/images/'.$siswa->poto)}}" alt="profile_image"
                        class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{$siswa->nama}}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ucfirst($siswa->role)}} Kelas {{$siswa->kelas_id ? $siswa->nama_kelas : '-'}}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Informasi profil</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#editprofile">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Edit Profile"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @if($siswa->nip)
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                        class="text-dark">NIP:</strong> &nbsp; {{$siswa->nip}}</li>
                                @endif
                                @if($siswa->nisn)
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">NISN:</strong> &nbsp; {{$siswa->nisn}}</li>
                                @endif
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tempat
                                        Tanggal lahir:</strong> &nbsp; {{$siswa->tempat_lahir}},
                                    {{$siswa->tanggal_lahir}}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Jenis
                                        Kelamin:</strong> &nbsp;
                                    {{$siswa->jenis_kelamin === "l" ? 'Laki-laki' : ($siswa->jenis_kelamin === "p" ? 'Perempuan' : '-')}}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Agama:</strong> &nbsp; {{$siswa->agama}}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                        class="text-dark">Alamat:</strong> &nbsp; {{$siswa->alamat}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editprofile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-4">
            <form action="{{ url('profile/'.Auth::user()->id) }}" method="POST"
                enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <h6>Foto</h6>
                        <div class="d-flex px-2 mb-4">
                            <div>
                                <img src="{{ asset('storage/images/'.$siswa->poto) }}"
                                    class="avatar avatar-xl rounded-circle me-2" alt="profile-user">
                            </div>
                            <div class="my-auto">
                                <div class="input-group input-group-outline my-3">
                                    <input name="poto" type="file" accept=".png, .jpeg, .jpg" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h6>Biodata</h6>
                        <div class="col-md-4">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group input-group-outline my-3">
                                <input value="{{ $siswa->nama }}" name="nama" type="text" class="form-control">
                            </div>
                        </div>
                        @if($siswa->nisn)
                        <div class="col-md-4">
                            <label class="form-label">NISN</label>
                            <div class="input-group input-group-outline my-3">
                                <input value="{{ $siswa->nisn }}" name="nisn" type="number" class="form-control">
                            </div>
                        </div>
                        @endif

                        @if($siswa->nip)
                        <div class="col-md-4">
                            <label class="form-label">NIP</label>
                            <div class="input-group input-group-outline my-3">
                                <input value="{{ $siswa->nip }}" name="nip" type="number" class="form-control">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Tempat Lahir</label>
                            <div class="input-group input-group-outline my-3">
                                <input value="{{ $siswa->tempat_lahir }}" name="tempat_lahir" type="text"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <div class="input-group input-group-outline my-3">
                                <input value="{{ $siswa->tanggal_lahir }}" name="tanggal_lahir" type="date"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jenis Kelamin</label>
                            @if($siswa->jenis_kelamin === 'l')
                            <div class="form-check mb-3">
                                <input checked class="form-check-input" value="l" type="radio" name="jenis_kelamin"
                                    id="laki_laki">
                                <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="p" type="radio" name="jenis_kelamin"
                                    id="perempuan">
                                <label class="custom-control-label" for="perempuan">Perempuan</label>
                            </div>
                            @elseif($siswa->jenis_kelamin === 'p')
                            <div class="form-check mb-3">
                                <input class="form-check-input" value="l" type="radio" name="jenis_kelamin"
                                    id="laki_laki">
                                <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input checked class="form-check-input" value="p" type="radio" name="jenis_kelamin"
                                    id="perempuan">
                                <label class="custom-control-label" for="perempuan">Perempuan</label>
                            </div>
                            @else
                            <div class="form-check mb-3">
                                <input class="form-check-input" value="l" type="radio" name="jenis_kelamin"
                                    id="laki_laki">
                                <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="p" type="radio" name="jenis_kelamin"
                                    id="perempuan">
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
                                    @if($siswa->agama === 'islam')
                                    <option value="">Pilih agama</option>
                                    <option selected value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="konghucu">Konghucu</option>
                                    @elseif($siswa->agama === 'kristen')
                                    <option value="">Pilih agama</option>
                                    <option value="islam">Islam</option>
                                    <option selected value="kristen">Kristen</option>
                                    <option value="budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="konghucu">Konghucu</option>
                                    @elseif($siswa->agama === 'budha')
                                    <option value="">Pilih agama</option>
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option selected value="budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="konghucu">Konghucu</option>
                                    @elseif($siswa->agama === 'hindu')
                                    <option value="">Pilih agama</option>
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="budha">Budha</option>
                                    <option selected value="Hindu">Hindu</option>
                                    <option value="konghucu">Konghucu</option>
                                    @elseif($siswa->agama === 'konghucu')
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <div class="input-group input-group-dynamic">
                                <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat"
                                    spellcheck="false">{{ $siswa->alamat }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection