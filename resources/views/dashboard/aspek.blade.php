@extends('layout.dashboard_template')
@section('dashboard-content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
            <h6 class="text-white text-capitalize ps-3">Aspek</h6>
        </div>
    </div>
    <div class="card-body px-2 pb-2">
        {{-- <form action="/aspek/cari" method="GET">
            {{-- <div class="col-md-6">
                    <div class="input-group input-group-outline my-3" id="search">
                        <label class="form-label"></label>
                        <input name="cariAspek" type="text" class="form-control" placeholder="Cari..">
                        <button type="submit" class="material-icons" id="cari">search</button>
                    </div>
                </div> --}}
        {{-- </form> --}} 
        <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder">Kode Aspek
                        </th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Nama Aspek
                        </th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Kelas
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($aspeks) > 0)
                    @foreach($aspeks as $aspek)
                    <tr>
                        <td class="px-4">
                            <span class="text-xs font-weight-bold">{{ $aspek->kode }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $aspek->nama_aspek }}</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">{{ $aspek->nama_kelas }}</span>
                        </td>
                        <td class="align-middle d-flex">
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
                            <a href="{{ url('aspek/'.$aspek->id) }}" class="btn btn-link text-secondary mb-0">
                                Edit
                            </a>

                            <form action="{{ route('aspek.remove', $aspek->id) }}" method="POST">
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
            {{ $aspeks->links() }}
        </div>
    </div>
</div>

@if(Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Form Tambah Aspek</h6>
        </div>
    </div>
    <div class="card-body px-4 pb-2">
        <form action="{{ route('aspek.add') }}" method="POST">
            @csrf
            <div class="row">
                <h6>Tambah Data Aspek</h6>
                <div class="col-md-4">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nama Aspek</label>
                        <input name="nama_aspek" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Kode Aspek</label>
                        <input name="kode" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-static mb-4">
                        <label for="kelas" class="ms-0">Kelas</label>
                        <select name="kelas_id" class="form-control" id="kelas">
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
<script>
    document.getElementById()
</script>
<script>
    function success(){
        return confirm('Berhasil menambahkan aspek');
    }
</script>
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
<script>
    @if(Session::has('message'))
        var type= "{{ Session::get('alert-type', 'info') }}"
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>
@endsection