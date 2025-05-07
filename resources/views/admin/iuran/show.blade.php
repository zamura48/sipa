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
            <form action="{{ route('admin.iuran.update', $iuran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama" name="nama"
                            value="{{ old('nama', $iuran->nama) }}" readonly>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="jenis_iuran_id" class="form-label">Jenis Iuran</label>
                        <select name="jenis_iuran_id" id="jenis_iuran_id"
                            class="form-control form-select js-select2 @error('jenis_iuran_id') is-invalid @enderror"
                            data-placeholder="- Pilih Jenis Iuran -" disabled>
                            <option value=""></option>
                            @foreach ($option_jenis as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('jenis_iuran_id', $iuran->jenis_iuran_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_iuran_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="total" class="form-label">
                            Total <span class="text-danger"><small>*Rp</small></span>
                        </label>
                        <input type="text" class="form-control js-currency @error('total') is-invalid @enderror"
                            placeholder="Masukkan total..." id="total" name="total"
                            value="{{ old('total', 'Rp' . format_currency($iuran->total)) }}" readonly>
                        @error('total')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan keterangan..."
                            id="keterangan" name="keterangan" readonly>{{ old('keterangan', $iuran->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="is_pendaftaran" class="form-label">Apakah Untuk Iuran Pendaftaran?</label>
                        <select name="is_pendaftaran" id="is_pendaftaran"
                            class="form-control form-select js-select2 @error('is_pendaftaran') is-invalid @enderror"
                            data-placeholder="- Pilih -" disabled>
                            <option value=""></option>
                            <option value="1"
                                {{ old('is_pendaftaran', $iuran->is_pendaftaran) == '1' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="0"
                                {{ old('is_pendaftaran', $iuran->is_pendaftaran) == '0' ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>
                        </select>
                        @error('is_pendaftaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right d-none btn_save"><i
                        class="fa fa-save mr-2"></i>Simpan</button>
                <button class="btn btn-danger float-right d-none btn_cancel mr-2"><i
                        class="fa fa-save mr-2"></i>Batal</button>
                <button class="btn btn-warning float-right btn_edit"><i class="fa fa-save mr-2"></i>Edit</button>
                <a href="{{ route('admin.iuran.index') }}" class="btn btn-secondary mr-2 float-right"><i
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
