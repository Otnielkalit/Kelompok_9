@extends('layout.dashboard_template')
@section('dashboard-content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <head>
        <style>
            .cari {
                margin-left: 75%;
            }

            #search {
                margin-left: 900px;
                width: 40%;
            }

            #cari {
                width: 40px;
                height: 40px;
                border-radius: 5px;
                background-color: #fda50f;
                border: none;
                color: #ffffff;
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
                <h6 class="text-white text-capitalize ps-3">Poin Penilaian</h6>
            </div>
        </div>
        <div class="card-body px-2 pb-2">
            {{-- <form action="/poin-penilaian/cari" method="GET">
            <div class="col-md-6">
                    <div class="input-group input-group-outline my-3" id="search">
                        <label class="form-label"></label>
                        <input name="cariPoin" type="text" class="form-control" placeholder="Cari..">
                        <button type="submit" class="material-icons" id="cari">search</button>
                    </div>
                </div>
        </form> --}}
            <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-dark text-xxs font-weight-bolder">Kode Aspek
                            </th>
                            <th class="text-uppercase text-dark text-xxs font-weight-bolder">Aspek
                            </th>
                            <th class="text-uppercase text-dark text-xxs font-weight-bolder ps-2">Poin Penilaian
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($poins) > 0)
                            @foreach ($poins as $poin)
                                <tr>
                                    <td class="px-4">
                                        <span class="text-xs font-weight-bold">{{ $poin->kode }}</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">{{ $poin->nama_aspek }}</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-weight-bold">{{ $poin->nama_poin }}</span>
                                    </td>
                                    <td class="align-middle d-flex">
                                        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
                                            <a href="{{ url('poin-penilaian/' . $poin->id) }}"
                                                class="btn btn-link text-secondary mb-0">
                                                Edit
                                            </a>
                                            {{-- <form action="{{ url('poin-penilaian/'.$poin->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-primary mb-0">
                                    Hapus
                                </button>
                            </form> --}}
                                            <form action="{{ route('remove_poin_penilaian', $poin->id) }}" method="POST">
                                                @csrf
                                                {{-- @method('DELETE') --}}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-link text-primary mb-0 show_confirm"
                                                    data-toggle="tooltip" title='Delete'>
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
                {{ $poins->links() }}
            </div>
        </div>
    </div>

    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
        <div class="card my-5">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Form Tambah Poin Penilaian</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form action="{{ route('add_poin_penilaian') }}" method="POST">
                    @csrf
                    <div class="row">
                        <h6>Tambah Data Aspek</h6>
                        <div class="col-md-6">
                            <div class="input-group input-group-static mb-4">
                                <label for="aspek" class="ms-0">Aspek</label>
                                <select name="aspek_id" class="form-control" id="aspek" required>
                                    <option value="">Pilih Aspek</option>
                                    @foreach ($aspeks as $aspek)
                                        <option value="{{ $aspek->id }}">{{ $aspek->nama_aspek }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Poin Penilaian</label>
                            <div class="input-group input-group-outline my-3">
                                <input name="nama_poin" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info" id="tambahPoint">Submit</button>
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
            var form = $(this).closest("form");
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
