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
            <form action="{{ route('walmur.tagihan.upload_bayar', $data->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3 border-bottom">
                        <table class="table">
                            <tr>
                                <td style="width: 250px">NIS</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $data->siswa->nis }}</td>
                            </tr>
                            <tr>
                                <td>Nama Siswa</td>
                                <td>:</td>
                                <td>{{ $data->siswa->nama }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Iuran</td>
                                <td>:</td>
                                <td>{{ $data->iuran->nama }}</td>
                            </tr>
                            <tr>
                                <td>Nominal Pembayaran</td>
                                <td>:</td>
                                <td>{{ $data->total_semua }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12 mb-3 d-none">
                        <label for="nama" class="form-label">Nominal Bayar</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama" name="nama" value="{{ old('nama') }}">
                        @if ($errors->has('nama'))
                            <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="foto" class="form-label">Bukti Bayar</label>
                        <input type="file" class="form-control-file @error('foto') is-invalid @enderror"
                            placeholder="Masukkan foto ..." id="foto" name="foto" value="{{ old('foto') }}" accept=".jpg,.jpeg,.png">
                        @if ($errors->has('foto'))
                            <div class="invalid-feedback">{{ $errors->first('foto') }}</div>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="d-flex">
                    <span class="text-danger">form ini bisa dilewati jika tidak diisi.</span>
                </div>
                <div id="ext_input_keringanan"></div>
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save mr-2"></i>Simpan</button>
                <a href="{{ route('walmur.tagihan.index') }}" class="btn btn-secondary mr-2 float-right"><i
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
