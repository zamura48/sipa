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
            <form action="{{ route('admin.siswa.update', $siswa->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="pengguna_id">Orang Tua</label>
                        <select name="pengguna_id" id="pengguna_id"
                            class="form-control @if ($errors->has('nis')) is-invalid @endif" readonly>
                            <option value="">-- Pilih Orang Tua --</option>
                            @foreach ($ortu as $key => $value)
                                <option value="{{ $value->id }}"
                                    {{ $value->id == $siswa->pengguna_id ? 'selected' : '' }}>{{ $value->nama }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('pengguna_id'))
                            <div class="invalid-feedback">{{ $errors->first('pengguna_id') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control @if ($errors->has('nis')) is-invalid @endif"
                            placeholder="Masukkan nis..." id="nis" name="nis" value="{{ $siswa->nis }}"
                            readonly>
                        @if ($errors->has('nis'))
                            <div class="invalid-feedback">{{ $errors->first('nis') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @if ($errors->has('nama')) is-invalid @endif"
                            placeholder="Masukkan nama..." id="nama" name="nama" value="{{ $siswa->nama }}"
                            readonly>
                        @if ($errors->has('nama'))
                            <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-control @if ($errors->has('jenis_kelamin')) is-invalid @endif" readonly>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki - Laki
                            </option>
                            <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @if ($errors->has('jenis_kelamin'))
                            <div class="invalid-feedback">{{ $errors->first('jenis_kelamin') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control-file @if ($errors->has('foto')) is-invalid @endif"
                            placeholder="Masukkan foto..." id="foto" name="foto" value="{{ old('foto') }}"
                            readonly>
                            @if ($errors->has('foto'))
                                <div class="invalid-feedback">{{ $errors->first('foto') }}</div>
                            @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right d-none btn_save"><i
                        class="fa fa-save mr-2"></i>Simpan</button>
                <button class="btn btn-danger float-right d-none btn_cancel mr-2"><i
                        class="fa fa-save mr-2"></i>Batal</button>
                <button class="btn btn-warning float-right btn_edit"><i class="fa fa-save mr-2"></i>Edit</button>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali</a>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.btn_edit').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('.btn_save').removeClass('d-none');
                $('.btn_cancel').removeClass('d-none');
                $('.form-control').not('.not-edit').attr('readonly', false);
            });

            $('.btn_cancel').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('.btn_edit').removeClass('d-none');
                $('.btn_save').addClass('d-none');
                $('.form-control').not('.not-edit').attr('readonly', true);
            });
        });
    </script>
@endpush
