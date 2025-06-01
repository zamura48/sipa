@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-12 d-flex">
                    <a href="{{ route('admin.penghuni.index') }}" class="btn btn-secondary mr-2"><i
                            class="fa fa-arrow-left mr-2"></i>Kembali</a>
                    <h5 class="m-0 font-weight-bold text-primary">Tambah Data {{ $title }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td style="width: 150px">Kamar</td>
                    <td style="width: 30px">:</td>
                    <td>{{ $kamar->nama }}</td>
                </tr>
                <tr>
                    <td>Kapasitas Kamar</td>
                    <td>:</td>
                    <td>{{ $kamar->jumlah_penghuni }}</td>
                </tr>
                <tr>
                    <td>Penghuni</td>
                    <td>:</td>
                    <td>{{ count($penghuni) }}</td>
                </tr>
                <tr>
                    <td>Sisa</td>
                    <td>:</td>
                    <td>{{ $sisa_kuota_kamar }}</td>
                </tr>
                <tr>
                    <td>Jenis Kamar</td>
                    <td>:</td>
                    <td>{{ $kamar->jenis ? $kamar->jenis == 'L' ? 'Laki-laki' : 'Perempuan' : '-'}}</td>
                </tr>
            </table>
            <hr>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header pb-0">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4>List Penghuni</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table_list_siswa">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Nama</td>
                            <td>Jenis Kelamin</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penghuni as $key => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa ? $item->siswa->nama : '-' }}</td>
                                <td>{{ $item->siswa ? ($item->siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') : '-' }}
                                </td>
                                <td>{{ $item->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header pb-0">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4>Tambah Siswa Ke Kamar</h4>
                </div>
                <div class="col-md-6 text-left">
                    <button type="submit" class="btn btn-primary float-right" id="btn-save"><i
                            class="fa fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="kamar" class="form-label">Kamar</label>
                    <select name="kamar" id="kamar"
                        class="form-control form-select js-select2 @if ($errors->has('jenis')) is-invalid @endif"
                        data-placeholder="- Pilih Kamar -">
                        <option value=""></option>
                        @foreach ($list_kamar as $item)
                            <option value="{{ $item->id }}" {{ $kamar_sebelum == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('jenis'))
                        <div class="invalid-feedback">{{ $errors->first('jenis') }}</div>
                    @endif
                </div>
                <div class="col-md-4 mb-3 mt-4">
                    <a href="{{ route('admin.penghuni.pindah', $kamar->id) }}" class="btn btn-secondary mt-2">Reset</a>
                </div>
            </div>
            <form action="{{ route('admin.penghuni.update_penghuni', $kamar->id) }}" method="POST" id="form-siswa">
                @csrf
                <div class="table-responsive">
                    <table class="table table-striped" id="table_siswa">
                        <thead>
                            <tr>
                                <td><input type="checkbox" id="checkAll"></td>
                                <td>Nama</td>
                                <td>Jenis Kelamin</td>
                                <td>Kamar</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $key => $value)
                                <tr>
                                    <td><input type="checkbox" id="check-{{ $key }}"></td>
                                    <td>{{ $value->siswa->nama }}</td>
                                    <td>{{ $value->siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $value->kamar->nama }}</td>
                                    <td>{{ $value->id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="data_siswa_selected" id="data_siswa_selected">
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            const table = $("#table_siswa").DataTable({
                order: 0,
                columnDefs: [{
                    targets: 0, // Tidak perlu array jika hanya satu kolom
                    orderable: false
                }, {
                    targets: 4,
                    visible: false
                }]
            });
            const table_list_siswa = $("#table_list_siswa").DataTable({
                order: 0,
                columnDefs: [{
                    targets: 0, // Tidak perlu array jika hanya satu kolom
                    orderable: false
                }, {
                    targets: 3,
                    visible: false
                }]
            });

            table.on('click', 'tbody tr', function(e) {
                e.currentTarget.classList.toggle('selected');

                if ($(this).hasClass('selected')) {
                    $(this).find('[type="checkbox"]').prop('checked', true);
                } else {
                    $(this).find('[type="checkbox"]').prop('checked', false);
                }
            });

            table_list_siswa.on('click', 'tbody tr', function(e) {
                e.currentTarget.classList.toggle('selected');

                if ($(this).hasClass('selected')) {
                    $(this).find('[type="checkbox"]').prop('checked', true);
                } else {
                    $(this).find('[type="checkbox"]').prop('checked', false);
                }
            });

            $("#kamar").change(function(e) {
                e.preventDefault();
                let this_val = $(this).val();
                window.location.href = window.location.href + "?kamar=" + this_val;
            });

            $('#btn-save').click(function(e) {
                e.preventDefault();
                let data = [];

                if (!table.rows('.selected').data().toArray().length) {
                    notif_error('Harap pilih siswa terlebih dahulu.');
                    return;
                }

                $.map(table.rows('.selected').data(), function(item, index) {
                    data.push(item[4]);
                });

                $("#data_siswa_selected").val(data);
                $("#form-siswa").submit();
            });

            $('#btn-delete').click(function(e) {
                e.preventDefault();
                let data = [];

                if (!table_list_siswa.rows('.selected').data().toArray().length) {
                    notif_error('Harap pilih siswa terlebih dahulu.');
                    return;
                }

                $.map(table_list_siswa.rows('.selected').data(), function(item, index) {
                    data.push(item[3]);
                });
                $("#data_siswa_deleted").val(data);
                $("#form-delete-siswa").submit();
            });
        });
    </script>
@endpush
