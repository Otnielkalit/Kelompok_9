@extends('layout.dashboard_template')
@section('dashboard-content')

<head>
    <style>
        .cari{
            margin-left: 75%;
        }
        #search{
            margin-left: 900px;
            width: 40%;
        }
        #cari {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            background-color: #fda50f;
            border: none;
            color:#ffffff;
        }
        
    </style>
</head>

<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Daftar Siswa Little Star Preschool & Kindergarten</h6>
        </div>
    </div>
    <div class="card-body px-2 pb-2">
        {{-- <form action="nilai/cari" method="GET">
            <div class="col-md-6">
                    <div class="input-group input-group-outline my-3" id="search">
                        <label class="form-label"></label>
                        <input name="cari" type="text" class="form-control" placeholder="Cari..">
                        <button type="submit" class="material-icons" id="cari">search</button>
                    </div>
                </div>
        </form> --}}
        <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder">Nama Lengkap
                        </th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">NISN</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Tempat Lahir
                        </th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Tanggal
                            Lahir</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Jenis
                            Kelamin</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Agama</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Kelas</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Alamat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($all_siswa) > 0)
                    @foreach($all_siswa as $user)
                    <tr>
                        <td>
                            <div class="d-flex px-2">
                                <div>
                                    <img src="{{ asset('storage/images/'.$user->poto) }}"
                                        class="avatar avatar-sm rounded-circle me-2" alt="profile-user">
                                </div>
                                <div class="my-auto">
                                    <h6 class="mb-0 text-sm">{{ $user->nama }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $user->nisn ? $user->nisn : '-' }}</span>
                        </td>
                        <td>
                            <span
                                class="text-xs font-weight-bold">{{ $user->tempat_lahir ? $user->tempat_lahir : '-' }}</span>
                        </td>
                        <td>
                            <span
                                class="text-xs font-weight-bold">{{ $user->tanggal_lahir ? $user->tanggal_lahir : '-' }}</span>
                        </td>
                        <td>
                            <span
                                class="text-xs font-weight-bold">{{ $user->jenis_kelamin ? strtoupper($user->jenis_kelamin) : '-' }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $user->agama ? $user->agama : '-' }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $user->nama_kelas ? $user->nama_kelas : '-' }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $user->alamat ? $user->alamat : '-' }}</span>
                        </td>
                        <td class="align-middle d-flex">
                            @if(Auth::user()->role === 'guru')
                            <a href="{{ url('nilai/'.$user->id) }}" class="btn btn-link text-primary mb-0">
                                Lihat Nilai
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @endif
                </tbody>
            </table>
            {{ $all_siswa->links() }}
        </div>
    </div>
</div>
@endsection