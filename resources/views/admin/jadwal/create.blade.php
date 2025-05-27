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
            <form action="{{ route('admin.jadwal.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nama" class="form-label">Nama Jadwal</label>
                        <input type="text" class="form-control @if ($errors->has('nama')) is-invalid @endif"
                            placeholder="Masukkan nama..." id="nama" name="nama" value="{{ old('nama') }}">
                        @if ($errors->has('nama'))
                            <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" class="form-control @if ($errors->has('tanggal')) is-invalid @endif"
                            placeholder="Masukkan tanggal..." id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                        @if ($errors->has('tanggal'))
                            <div class="invalid-feedback">{{ $errors->first('tanggal') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <select name="kegiatan[]" id="kegiatan"
                            class="form-control form-select js-select2 @if ($errors->has('kegiatan')) is-invalid @endif"
                            data-placeholder="- Pilih Kegiatan -" multiple="true">
                            <option value=""></option>
                            @foreach ($kegiatan as $item)
                                <option value="{{ $item->id }}" {{ old('kegiatan') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('kegiatan'))
                            <div class="invalid-feedback">{{ $errors->first('kegiatan') }}</div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save mr-2"></i>Simpan</button>
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary mr-2 float-right"><i
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
