@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Tambah Data {{ $title }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sekolah.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nama_sekolah" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama_sekolah" name="nama_sekolah"
                            value="{{ old('nama_sekolah') }}">
                        @if ($errors->has('nama_sekolah'))
                            <div class="invalid-feedback">{{ $errors->first('nama_sekolah') }}</div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save mr-2"></i>Simpan</button>
                <a href="{{ route('admin.sekolah.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali</a>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {});
    </script>
@endpush
