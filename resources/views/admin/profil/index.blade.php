@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Data {{ $title }}</h6>
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn btn-primary btn-nav" data-target="#tab-data-diri">Data Diri</button>
                    <button class="btn btn-default btn-nav" data-target="#tab-akun">Akun</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 nav-tab" id="tab-data-diri">
                    <form action="{{ route('admin.pengurus.update', $pengurus->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="role_id">Jabatan</label>
                                <select name="role_id" id="role_id"
                                    class="form-control @error('role_id') is-invalid @enderror" disabled>
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach ($roles as $key => $value)
                                        <option value="{{ $value->id }}"
                                            {{ $pengurus->user->role_id == $value->id ? 'selected' : '' }}>
                                            {{ $value->nama }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <div class="invalid-feedback">{{ $errors->first('role_id') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nama')) is-invalid @endif"
                                    placeholder="Masukkan nama..." id="nama" name="nama"
                                    value="{{ $pengurus->nama }}" readonly>
                                @if ($errors->has('nama'))
                                    <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-control @if ($errors->has('jenis_kelamin')) is-invalid @endif" readonly>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ $pengurus->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki -
                                        Laki
                                    </option>
                                    <option value="P" {{ $pengurus->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @if ($errors->has('jenis_kelamin'))
                                    <div class="invalid-feedback">{{ $errors->first('jenis_kelamin') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('telepon')) is-invalid @endif"
                                    placeholder="Masukkan telepon..." id="telepon" name="telepon"
                                    value="{{ $pengurus->telepon }}" readonly>
                                @if ($errors->has('telepon'))
                                    <div class="invalid-feedback">{{ $errors->first('telepon') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="3"
                                    class="form-control @error('alamat') is-invalid @enderror" readonly>{{ $pengurus->alamat }}</textarea>
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
                    </form>
                </div>
                <div class="col-md-12 nav-tab d-none" id="tab-akun">
                    <h2>to</h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.btn-nav').click(function(e) {
            e.preventDefault();
            let this_target = $(this).data('target');

            $(".btn-nav").removeClass('btn-primary');
            $(this).addClass('btn-primary');
            $(".nav-tab").addClass('d-none');
            $(this_target).removeClass('d-none');
        });

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
    </script>
@endpush
