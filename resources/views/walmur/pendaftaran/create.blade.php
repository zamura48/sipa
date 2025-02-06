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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('walmur.pendaftaran.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="number" class="form-control @error('nis') is-invalid @enderror"
                            placeholder="Masukkan nis..." id="nis" name="nis" value="{{ old('nis') }}">
                        @if ($errors->has('nis'))
                            <div class="invalid-feedback">{{ $errors->first('nis') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama" name="nama" value="{{ old('nama') }}">
                        @if ($errors->has('nama'))
                            <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-control @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @if ($errors->has('jenis_kelamin'))
                            <div class="invalid-feedback">{{ $errors->first('jenis_kelamin') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control-file @error('foto') is-invalid @enderror"
                            placeholder="Masukkan foto..." id="foto" name="foto" value="{{ old('foto') }}">
                        @if ($errors->has('foto'))
                            <div class="invalid-feedback">{{ $errors->first('foto') }}</div>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="d-flex">
                    <span class="text-danger">form ini bisa dilewati jika tidak diisi.</span>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-sm btn-info btn_add_ext"><i class="fa fa-plus"></i> Tambah
                            Keringanan</button>
                        <small class="text-danger"><br>jika ingin mengajukan keringanan lebih dari 1 bisa klik
                            tombol "Tambah Keringanan"</small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipe_keringanan">Tipe Keringanan</label>
                            <select name="tipe_keringanan[]" id="tipe_keringanan" class="form-control">
                                <option value="">-- Pilih Tipe Keringanan --</option>
                                @foreach ($tipe_keringanan as $key => $value)
                                    <option value="{{ $value->id }}"
                                        {{ old('tipe_keringanan') == $value->id ? 'checked' : '' }}>{{ $value->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dokumen_pelengkap">Dokumen Pelengkap</label>
                            <input type="file" class="form-control-file" name="dokumen_pelengkap[]"
                                id="dokumen_pelengkap" placeholder="Masukkan dokumen pelengkap ..." multiple>
                        </div>
                    </div>
                </div>
                <div id="ext_input_keringanan"></div>
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save mr-2"></i>Simpan</button>
                <a href="{{ route('walmur.pendaftaran.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali</a>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {});

        $('.btn_add_ext').click(function(e) {
            e.preventDefault();
            let clone_element = $(this).parent().parent().clone();

            clone_element.find('.btn_add_ext').parent().find('small').remove();
            clone_element.find('.btn_add_ext').removeClass('btn_add_ext btn-info').addClass(
                'btn_remove_ext btn-danger').html('<i class="fa fa-minus"></i> Hapus Keringanan');
            $("#ext_input_keringanan").append(clone_element);
        });

        $(document).on('click', '.btn_remove_ext', function() {
            $(this).parent().parent().remove();
        });
    </script>
@endpush
