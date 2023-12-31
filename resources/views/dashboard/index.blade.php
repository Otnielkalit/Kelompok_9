@extends('layout.dashboard_template')
@section('dashboard-content')

@if(Auth::user()->role !== 'siswa')

<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-2">
        <div class="card">
            <div class="card-header p-5 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute" >
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-lg mb-0 text-capitalize" >Total Siswa</p>
                    <h4 class="mb-0">{{$total_siswa}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-5 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-secondary shadow-secondary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-lg mb-0 text-capitalize">Total Guru</p>
                    <h4 class="mb-0">{{$total_guru}}</h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-5 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-lg mb-0 text-capitalize">Total Kelas</p>
                    <h4 class="mb-0">{{$total_kelas}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->role === 'siswa')
<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Perkembangan Siswa</h6>
        </div>
    </div>
    <div class="card-body px-4 pb-2">
        <a target="_blank" href="print/{{Auth::user()->id}}" class="btn btn-outline-info">
            <i class="fa-solid fa-print"></i>
            Print
        </a>
        <div class="table-responsive p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Tahun Ajaran</th>
                            <th scope="col">Aspek</th>
                            <th scope="col">Poin Penilaian</th>
                            <th scope="col">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($nilai) > 0)
                        @foreach($nilai as $item)
                        <tr>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->semester}}</td>
                            <td>{{$item->awal_ajaran}}/{{$item->akhir_ajaran}}</td>
                            <td>{{$item->nama_aspek}}</td>
                            <td>{{$item->nama_poin}}</td>
                            <td>{{$item->nilai === "mb" ? 'Mulai Berkembang' : ($item->nilai === 'bsh' ? 'Berkembang Sesuai Harapan' : ($item->nilai === 'bsb' ? 'Berkembang Sangat Baik' : '-'))}}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {{$nilai->links()}}
            </div>
        </div>
    </div>
</div>
@endif

@endsection