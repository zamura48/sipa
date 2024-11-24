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
            <form action="{{ route('admin.periode.update', $periode->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control js-datepicker @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama" name="nama"
                            value="{{ old('nama', $periode->nama) }}" readonly>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status"
                            class="form-control form-select js-select2 @error('status') is-invalid @enderror"
                            data-placeholder="- Pilih Status -" disabled>
                            <option value=""></option>
                            <option value="1" {{ old('status', $periode->status) == '1' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="0" {{ old('status', $periode->status) == '0' ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="text" class="form-control js-datepicker @error('tgl_mulai') is-invalid @enderror"
                            placeholder="Masukkan tanggal mulai..." id="tgl_mulai" name="tgl_mulai"
                            value="{{ old('tgl_mulai', format_date_w_bs($periode->tgl_mulai)) }}" readonly>
                        @error('tgl_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="text" class="form-control @error('tgl_akhir') is-invalid @enderror"
                            placeholder="Masukkan tanggal akhir..." id="tgl_akhir" name="tgl_akhir"
                            value="{{ old('tgl_akhir', format_date_w_bs($periode->tgl_akhir)) }}" readonly>
                        @error('tgl_akhir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right d-none btn_save"><i
                        class="fa fa-save mr-2"></i>Simpan</button>
                <button class="btn btn-danger float-right d-none btn_cancel mr-2"><i
                        class="fa fa-save mr-2"></i>Batal</button>
                <button class="btn btn-warning float-right btn_edit"><i class="fa fa-save mr-2"></i>Edit</button>
                <a href="{{ route('admin.periode.index') }}" class="btn btn-secondary mr-2 float-right"><i
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
                $('.form-control.form-select').attr('disabled', false);
            });

            $('.btn_cancel').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('.btn_edit').removeClass('d-none');
                $('.btn_save').addClass('d-none');
                $('.form-control').attr('readonly', true);
                $('.form-control.form-select').attr('disabled', true);
            });
        });
    </script>
@endpush
