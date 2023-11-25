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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
@endif



<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Kelas</h6>
        </div>
    </div>
    <div class="card-body px-2 pb-2">
        {{-- <p>Cari Data Kelas :</p> --}}
        {{-- <form action="/kelas/cari" method="GET">
            <div class="col-md-6">
                    <div class="input-group input-group-outline my-3" id="search">
                        <label class="form-label"></label>
                        <input name="cari" type="text" class="form-control" placeholder="Cari kode atau nama kelas..">
                        <button type="submit" class="material-icons" id="cari">search</button>
                    </div>
                </div>
        </form> --}}
        <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder">Kode Kelas
                        </th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder">Nama Kelas
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($kelass) > 0)
                    @foreach($kelass as $kelas)
                    <tr>
                        <input type ="hidden" class="delete_id" value="{{ $kelas->id }}">
                        <td class="px-4">
                            <span class="text-xs font-weight-bold">{{ $kelas->kode }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $kelas->nama_kelas }}</span>
                        </td>
                        <td class="align-middle d-flex">
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
                            <a href="{{ url('kelas/'.$kelas->id) }}"
                                class="btn btn-link text-secondary mb-0">
                                Edit
                            </a>
                            <form action="{{ route('kelas.remove', $kelas->id) }}" method="POST">
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
            {{ $kelass->links() }}
        </div>
    </div>
</div>

@if(Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Form Tambah Kelas</h6>
        </div>
    </div>
    <div class="card-body px-4 pb-2">
        <form action="{{ route('kelas.add') }}" method="POST">
            @csrf
            <div class="row">
                <h6>Tambah Data Kelas</h6>
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Kode Kelas</label>
                        <input name="kode" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nama Kelas</label>
                        <input name="nama_kelas" type="text" class="form-control" required>
                    </div>
                </div>
                
            </div>
            <div class="row my-4">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info" onclick="success()">Submit</button>
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