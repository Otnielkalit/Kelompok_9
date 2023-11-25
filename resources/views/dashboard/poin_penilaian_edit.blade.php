@extends('layout.dashboard_template')
@section('dashboard-content')
<div class="card my-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Form Edit Poin Penilaian</h6>
        </div>
    </div>
    <div class="card-body px-4 pb-2">
        <form action="{{ url('poin-penilaian/'.$poin->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <h6>Tambah Data Aspek</h6>
                <div class="col-md-6">
                    <div class="input-group input-group-static mb-4">
                        <label for="aspek" class="ms-0">Aspek</label>
                        <select name="aspek_id" class="form-control" id="aspek" required>
                            <option value="">Pilih Aspek</option>
                            @foreach($aspeks as $aspek)
                                <option value="{{ $aspek->id }}">{{ $aspek->nama_aspek }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Poin Penilaian</label>
                    <div class="input-group input-group-outline my-3">
                        <input value="{{ $poin->nama_poin }}" name="nama_poin" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <a href="{{ route('poin_penilaian') }}" type="reset" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection