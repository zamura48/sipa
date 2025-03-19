@extends('template.login')

@section('content')
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12">
                    <div class="card o-hidden border-0 shadow-sm my-5">
                        <div class="card-header text-center bg-white border-bottom-0">
                            <h4>Pendaftaran Siswa</h4>
                            <h6>sudah punya akun? <a href="{{ route('walmur.login') }}">Log in</a></h6>
                        </div>
                        <div class="card-body p-5">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <small class="text-danger">lengkapi data dibawah ini, tunggu admin konfirmasi pendaftaran anda dan akan
                                diberikan akses untuk masuk kedalam sistem ini</small>
                            <!-- Nested Row within Card Body -->
                            <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link tab-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home" aria-selected="true" disabled>Siswa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                        role="tab" aria-controls="pills-profile" aria-selected="false" disabled>Orang Tua</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-link" id="pills-keringanan-tab" data-toggle="pill"
                                        href="#pills-keringanan" role="tab" aria-controls="pills-keringanan"
                                        aria-selected="false" disabled>Keringanan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link tab-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                        role="tab" aria-controls="pills-contact" aria-selected="false" disabled>Simpan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <form action="{{ route('walmur.do_regis') }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="tab-pane fade show active mt-3 border rounded p-3" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sekolah">Sekolah</label>
                                                    <select name="sekolah" id="sekolah" class="form-control">
                                                        <option value="">-- Pilih Sekolah --</option>
                                                        @foreach ($sekolah as $key => $value)
                                                            <option value="{{ $value->id }}"
                                                                {{ $value->id == old('sekolah') ? 'selected' : '' }}>
                                                                {{ $value->nama_sekolah }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nis">NIS</label>
                                                    <input type="number" class="form-control" name="nis" id="nis"
                                                        placeholder="Masukkan NIS ..." value="{{ old('nis') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="siswa_name">Nama Siswa</label>
                                                    <input type="text" class="form-control" name="siswa_name" id="siswa_name"
                                                        placeholder="Masukkan nama siswa ..." value="{{ old('siswa_name') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jenis_kelamin_siswa">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin_siswa" id="jenis_kelamin_siswa"
                                                        class="form-control">
                                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                                        <option value="L"
                                                            {{ old('jenis_kelamin_siswa') == 'L' ? 'checked' : '' }}>Laki - Laki
                                                        </option>
                                                        <option value="P"
                                                            {{ old('jenis_kelamin_siswa') == 'P' ? 'checked' : '' }}>Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="foto_siswa">Foto Siswa</label>
                                                    <small class="text-danger">jpeg,png,jpg</small>
                                                    <input type="file" class="form-control-file" name="foto_siswa"
                                                        id="foto_siswa" accept=".jpg,.jpeg,.png"
                                                        placeholder="Masukkan nama siswa ...">
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-primary btn-next"
                                                    data-target="pills-profile">Selanjutnya</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade mt-3 border rounded p-3" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab" hidden>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ortu_name">Nama Orang Tua</label>
                                                    <input type="text" class="form-control" name="ortu_name" id="ortu_name"
                                                        placeholder="Masukkan nama ortu ..." value="{{ old('ortu_name') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jenis_kelamin_ortu">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin_ortu" id="jenis_kelamin_ortu"
                                                        class="form-control">
                                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                                        <option value="L"
                                                            {{ old('jenis_kelamin_siswa') == 'L' ? 'checked' : '' }}>Laki - Laki
                                                        </option>
                                                        <option value="P"
                                                            {{ old('jenis_kelamin_siswa') == 'P' ? 'checked' : '' }}>Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="alamat_ortu">Alamat</label>
                                                    <textarea class="form-control" name="alamat_ortu" id="alamat_ortu" cols="30" rows="3"
                                                        placeholder="Masukkan alamat orang tua">{{ old('alamat_ortu') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nomor_hp">Nomor Telepon</label>
                                                    <input type="number" class="form-control" name="nomor_hp" id="nomor_hp"
                                                        placeholder="Masukkan nomor telepon orang tua ..."
                                                        value="{{ old('nomor_hp') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-between">
                                                <button class="btn btn-info btn-prev" data-target="pills-home">Kembali</button>
                                                <button class="btn btn-primary btn-next btn-last-next"
                                                    data-target="pills-keringanan">Selanjutnya</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade mt-3 border rounded p-3" id="pills-keringanan" role="tabpanel"
                                        aria-labelledby="pills-keringanan-tab" hidden>
                                        <div class="d-flex">
                                            <span class="text-danger">form ini bisa dilewati jika tidak diisi.</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-sm btn-info btn_add_ext"><i class="fa fa-plus"></i> Tambah
                                                    Keringanan</button>
                                                <small class="text-danger"><br>jika ingin mengajukan keringanan lebih dari 1 bisa
                                                    klik
                                                    tombol "Tambah Keringanan"</small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tipe_keringanan">Tipe Keringanan</label>
                                                    <select name="tipe_keringanan[]" id="tipe_keringanan" class="form-control">
                                                        <option value="">-- Pilih Tipe Keringanan --</option>
                                                        @foreach ($tipe_keringanan as $key => $value)
                                                            <option value="{{ $value->id }}"
                                                                {{ old('tipe_keringanan') == $value->id ? 'checked' : '' }}>
                                                                {{ $value->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="dokumen_pelengkap">Dokumen Pelengkap</label>
                                                    <input type="file" class="form-control-file" name="dokumen_pelengkap[]"
                                                        id="dokumen_pelengkap" placeholder="Masukkan dokumen pelengkap ..."
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="ext_input_keringanan"></div>
                                        <div class="row">
                                            <div class="col-md-12 d-flex justify-content-between">
                                                <button class="btn btn-info btn-prev" data-target="pills-profile">Kembali</button>
                                                <button class="btn btn-primary btn-next btn-last-next"
                                                    data-target="pills-contact">Selanjutnya</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade mt-3 border rounded p-3" id="pills-contact" role="tabpanel"
                                        aria-labelledby="pills-contact-tab" hidden>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <tr>
                                                        <td>NIS</td>
                                                        <td>:</td>
                                                        <td id="show_nis">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Siswa</td>
                                                        <td>:</td>
                                                        <td id="show_siswa_name">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>:</td>
                                                        <td id="show_jenis_kelamin_siswa">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Orang Tua</td>
                                                        <td>:</td>
                                                        <td id="show_ortu_name">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>:</td>
                                                        <td id="show_jenis_kelamin_ortu">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>:</td>
                                                        <td id="show_alamat_ortu">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nomor Telepon</td>
                                                        <td>:</td>
                                                        <td id="show_nomor_hp">-</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-between">
                                                <button class="btn btn-info btn-prev"
                                                    data-target="pills-keringanan">Kembali</button>
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        function hide_tab() {
            $(".tab-pane").each(function(index, element) {
                $(element).attr('hidden', true);
            });
        }

        function show_tab(element_id) {
            $(".tab-pane").removeClass('active show');
            $(".tab-link").removeClass('active');

            $(".tab-link").each(function(index, element) {
                let temp_element_id = $(element).attr('href');
                if (element_id == temp_element_id) {
                    $(element).addClass('active');
                }
            });

            $(element_id).attr('hidden', false).addClass('active show');
        }

        function show_input() {
            $("#show_nis").text($("#nis").val());
            $("#show_siswa_name").text($("#siswa_name").val());
            $("#show_jenis_kelamin_siswa").text($("#jenis_kelamin_siswa").val());
            $("#show_ortu_name").text($("#ortu_name").val());
            $("#show_jenis_kelamin_ortu").text($("#jenis_kelamin_ortu").val());
            $("#show_alamat_ortu").text($("#alamat_ortu").val());
            $("#show_nomor_hp").text($("#nomor_hp").val());
        }

        $(".btn-prev").click(function(e) {
            e.preventDefault();
            let this_target = $(this).data('target');

            hide_tab();
            show_tab("#" + this_target);
        });

        $(".btn-next").click(function(e) {
            e.preventDefault();
            let this_target = $(this).data('target');

            hide_tab();
            show_tab("#" + this_target);
            show_input();
        });

        $('.tab-link').click(function(e) {
            e.preventDefault();
            let this_target = $(this).attr('href');

            hide_tab();
            show_tab(this_target);
        });

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
