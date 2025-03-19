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
            <form action="{{ route('admin.wali_murid.update', $waliMurid->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @if ($errors->has('nama')) is-invalid @endif"
                            placeholder="Masukkan nama..." id="nama" name="nama" value="{{ $waliMurid->nama }}"
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
                            <option value="L" {{ $waliMurid->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki - Laki
                            </option>
                            <option value="P" {{ $waliMurid->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @if ($errors->has('jenis_kelamin'))
                            <div class="invalid-feedback">{{ $errors->first('jenis_kelamin') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control @if ($errors->has('telepon')) is-invalid @endif"
                            placeholder="Masukkan telepon..." id="telepon" name="telepon" value="{{ $waliMurid->telepon }}"
                            readonly>
                        @if ($errors->has('telepon'))
                            <div class="invalid-feedback">{{ $errors->first('telepon') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror" readonly>{{ $waliMurid->alamat }}</textarea>
                        @if ($errors->has('alamat'))
                            <div class="invalid-feedback">{{ $errors->first('alamat') }}</div>
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
