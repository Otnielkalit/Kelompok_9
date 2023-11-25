@extends('layout.dashboard_template')
@section('dashboard-content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Siswa</h6>
        </div>
    </div>
    <div class="card-body px-2 pb-2">
        {{-- <form action="siswa/cari" method="GET">
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
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Username
                        </th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Role</th>
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
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Nama Ayah</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Nama Ibu</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($siswas) > 0)
                    @foreach($siswas as $siswa)
                    <tr>
                        <td>
                            <div class="d-flex px-2">
                                <div>
                                    <img src="{{ asset('storage/images/'.$siswa->poto) }}"
                                        class="avatar avatar-sm rounded-circle me-2" alt="profile-user">
                                </div>
                                <div class="my-auto">
                                    <h6 class="mb-0 text-sm">{{ $siswa->nama }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $siswa->username }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $siswa->role }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $siswa->nisn ? $siswa->nisn : '-' }}</span>
                        </td>
                        <td>
                            <span
                                class="text-xs font-weight-bold">{{ $siswa->tempat_lahir ? $siswa->tempat_lahir : '-' }}</span>
                        </td>
                        <td>
                            <span
                                class="text-xs font-weight-bold">{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir : '-' }}</span>
                        </td>
                        <td>
                            <span
                                class="text-xs font-weight-bold">{{ $siswa->jenis_kelamin ? strtoupper($siswa->jenis_kelamin) : '-' }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $siswa->agama ? $siswa->agama : '-' }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $siswa->nama_kelas ? $siswa->nama_kelas : '-' }}</span>
                        </td>
                        {{-- <td>
                            <span class="text-xs font-weight-bold">{{ $poin->nama_aspek }}</span>
                        </td> --}}
                        <td>
                            <span class="text-xs font-weight-bold">{{ $siswa->alamat ? $siswa->alamat : '-' }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $siswa->nama_ayah }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $siswa->nama_ibu }}</span>
                        </td>
                        <td class="align-middle d-flex">
                            @if(Auth::user()->role === 'admin')
                            <a href="{{ url('siswa/'.$siswa->id) }}" class="btn btn-link text-secondary mb-0">
                                Edit
                            </a>
                            {{-- <form action="{{ url('dashboard/users/'.$user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-primary mb-0">
                                    Hapus
                                </button>
                            </form> --}}
                            <form action="{{ route('siswa.remove', $siswa->id) }}" method="POST">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-link text-primary mb-0 show_confirm" data-toggle="tooltip" title='Delete'>
                                    Hapus
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @endif
                </tbody>
            </table>
            {{ $siswas->links() }}
        </div>
    </div>
</div>

@if(Auth::user()->role === 'admin')
<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Form Tambah Akun</h6>
        </div>
    </div>
    <div class="card-body px-4 pb-2">
        <form action="{{ route('siswa.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <h6>Akun</h6>
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input name="nama" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="role" class="ms-0">Role</label>
                        <input name="role" type="text" class="form-control" value="Siswa" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <h6>Foto</h6>
                <div class="col-md-4">
                    <div class="input-group input-group-outline my-3">
                        <input id="photo" name="photo" type="file" accept=".png, .jpeg, .jpg" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <h6>Biodata</h6>
                <div class="col-md-4">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">NISN</label>
                        <input name="nisn" type="number" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Tempat Lahir</label>
                    <div class="input-group input-group-outline my-3">
                        <input name="tempat_lahir" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir</label>
                    <div class="input-group input-group-outline my-3">
                        <input name="tanggal_lahir" type="date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="form-check mb-3">
                        <input class="form-check-input" value="l" type="radio" name="jenis_kelamin" id="laki_laki">
                        <label class="custom-control-label" for="laki_laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="p" type="radio" name="jenis_kelamin" id="perempuan">
                        <label class="custom-control-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="agama" class="ms-0">Agama</label>
                        <select name="agama" class="form-control" id="agama">
                            <option value="">Pilih agama</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="kelas" class="ms-0">Kelas</label>
                        <select name="kelas_id" class="form-control" id="kelas" reuired>
                            <option value="">Pilih Kelas</option>
                            @if(count($kelass) > 0)
                            @foreach($kelass as $kelas)
                            <option value="{{$kelas->id}}">{{$kelas->nama_kelas}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Nama Ayah</label>
                    <input name="nama_ayah" type="text" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Nama Ibu</label>
                    <input name="nama_ibu" type="text" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-dynamic">
                        <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat"
                            spellcheck="false" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Apakah Anda yakin?`,
              text: "Saat anda menekan tombol 'OK', data akan terhapus secara permanen",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>

@endsection