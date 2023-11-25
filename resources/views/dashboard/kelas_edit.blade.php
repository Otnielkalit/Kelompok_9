@extends('layout.dashboard_template')
@section('dashboard-content')
<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Form Edit Kelas</h6>
        </div>
    </div>
    <div class="card-body px-4 pb-2">
        <form action="{{ url('kelas/'.$kelas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <h6>Edit Data Kelas</h6>
                <div class="col-md-6">
                    <label class="form-label">Kode Kelas</label>
                    <div class="input-group input-group-outline my-3">
                        <input value="{{ $kelas->kode }}" name="kode" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Kelas</label>
                    <div class="input-group input-group-outline my-3">
                        <input value="{{ $kelas->nama_kelas }}" name="nama_kelas" type="text" class="form-control">
                    </div>
                </div>
                
            </div>
            <div class="row my-4">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <a href="{{ route('kelas') }}" type="reset" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection