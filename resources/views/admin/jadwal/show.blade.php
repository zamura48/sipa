@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Detail Data {{ $title }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nama" class="form-label">Nama Jadwal</label>
                        <input type="text" class="form-control @if ($errors->has('nama')) is-invalid @endif"
                            placeholder="Masukkan nama..." id="nama" name="nama" value="{{ $jadwal->nama }}"
                            readonly>
                        @if ($errors->has('nama'))
                            <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local"
                            class="form-control @if ($errors->has('tanggal')) is-invalid @endif"
                            placeholder="Masukkan tanggal..." id="tanggal" name="tanggal" value="{{ $jadwal->tanggal }}"
                            readonly>
                        @if ($errors->has('tanggal'))
                            <div class="invalid-feedback">{{ $errors->first('tanggal') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <select name="kegiatan[]" id="kegiatan"
                            class="form-control form-select js-select2 @if ($errors->has('kegiatan')) is-invalid @endif"
                            data-placeholder="- Pilih Kegiatan -" multiple="true" disabled>
                            <option value=""></option>
                            @php
                                $kegiatan_id_use = [];
                                foreach ($jadwal->jadwalDetails as $key => $value) {
                                    $kegiatan_id_use[] = $value->kegiatan_id;
                                }
                            @endphp
                            @foreach ($kegiatan as $item)
                                <option value="{{ $item->id }}"
                                    {{ in_array($item->id, $kegiatan_id_use) ? 'selected' : '' }}>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('kegiatan'))
                            <div class="invalid-feedback">{{ $errors->first('kegiatan') }}</div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right d-none " id="btn_save"><i
                        class="fa fa-save mr-2"></i>Simpan</button>
                <button class="btn btn-danger float-right d-none btn_cancel mr-2"><i
                        class="fa fa-save mr-2"></i>Batal</button>
            </form>
            <button class="btn btn-warning float-right" id="btn_edit"><i class="fa fa-save mr-2"></i>Edit</button>
            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary mr-2 float-right"><i
                    class="fa fa-arrow-left mr-2"></i>Kembali</a>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#btn_edit').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('#btn_save').removeClass('d-none');
                $('.btn_cancel').removeClass('d-none');
                $('.form-control').attr('readonly', false);
                $('.form-control.form-select').attr('disabled', false);
            });

            $('.btn_cancel').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('#btn_edit').removeClass('d-none');
                $('#btn_save').addClass('d-none');
                $('.form-control').attr('readonly', true);
                $('.form-select').prop('disabled', true);
            });
        });
    </script>
@endpush
