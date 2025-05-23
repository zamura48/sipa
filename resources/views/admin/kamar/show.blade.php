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
            <form action="{{ route('admin.kamar.update', $kamar->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama" name="nama"
                            value="{{ old('nama', $kamar->nama) }}" readonly>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jumlah_penghuni" class="form-label">
                            Kapasitas Penghuni
                            <span class="text-danger"><small>*orang</small></span>
                        </label>
                        <input type="number" class="form-control @error('jumlah_penghuni') is-invalid @enderror"
                            placeholder="Masukkan jumlah penghuni..." id="jumlah_penghuni" name="jumlah_penghuni"
                            value="{{ old('jumlah_penghuni', $kamar->jumlah_penghuni) }}" readonly>
                        @error('jumlah_penghuni')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jenis" class="form-label">Jenis Kamar</label>
                        <select name="jenis" id="jenis"
                            class="form-control form-select js-select2 @if ($errors->has('jenis')) is-invalid @endif"
                            data-placeholder="- Pilih Jenis Kamar -" disabled>
                            <option value=""></option>
                            <option value="L" <?= old('jenis', $kamar->jenis) == 'L' ? 'selected' : '' ?>>Laki - laki</option>
                            <option value="P" <?= old('jenis', $kamar->jenis) == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        @if ($errors->has('jenis'))
                            <div class="invalid-feedback">{{ $errors->first('jenis') }}</div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right d-none btn_save"><i
                        class="fa fa-save mr-2"></i>Simpan</button>
                <button class="btn btn-danger float-right d-none btn_cancel mr-2"><i
                        class="fa fa-save mr-2"></i>Batal</button>
                <button class="btn btn-warning float-right btn_edit"><i class="fa fa-save mr-2"></i>Edit</button>
                <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary mr-2 float-right"><i
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
                $('.form-control').attr('readonly', false);
                $('.form-control').attr('disabled', false);
            });

            $('.btn_cancel').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('.btn_edit').removeClass('d-none');
                $('.btn_save').addClass('d-none');
                $('.form-control').attr('readonly', true);
                $('.form-control').attr('disabled', true);
            });
        });
    </script>
@endpush
