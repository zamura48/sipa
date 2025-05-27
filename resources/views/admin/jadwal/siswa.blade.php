@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-12 d-flex">
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary mr-2"><i
                            class="fa fa-arrow-left mr-2"></i>Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td style="width: 150px">Nama Jadwal</td>
                    <td style="width: 30px">:</td>
                    <td>{{ $jadwal->nama }}</td>
                </tr>
                <tr class="d-none">
                    <td>Hari</td>
                    <td>:</td>
                    <td>{{ $jadwal->hari }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ datetime_indo($jadwal->tanggal) }}</td>
                </tr>
            </table>
            <hr>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header pb-0">
            <div class="row mb-3">
                <div class="col-md-6 text-end">
                    <h4>List Siswa Pada Jadwal</h4>
                </div>
                <div class="col-md-6 text-left">
                    <button type="submit" class="btn btn-danger float-right" id="btn-delete"><i
                            class="fa fa-trash mr-2"></i>Hapus</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.jadwal.delete_siswa_jadwal', $jadwal->id) }}" method="POST"
                id="form-delete-siswa">
                @csrf
                <table class="table" id="table_list_siswa">
                    <thead>
                        <tr>
                            <td><input type="checkbox" id="checkAllDelete"></td>
                            <td>Nama</td>
                            <td>Kamar</td>
                            <td>Jenis Kelamin</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal_siswa as $key => $item)
                            <tr>
                                <td><input type="checkbox" id="check-delete-{{ $key }}"></td>
                                <td>{{ $item->siswa ? $item->siswa->nama : '-' }}</td>
                                <td>
                                    @if ($item->siswa)
                                        {{ $item->siswa->penghuni ? $item->siswa->penghuni->kamar->nama : '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->siswa ? ($item->siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') : '-' }}
                                </td>
                                <td>{{ $item->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="data_siswa_deleted" id="data_siswa_deleted">
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header pb-0">
            <div class="row mb-3">
                <div class="col-md-6 text-end">
                    <h4>Tambah Siswa Ke Jadwal</h4>
                </div>
                <div class="col-md-6 text-left">
                    <button type="submit" class="btn btn-primary float-right" id="btn-save"><i
                            class="fa fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.jadwal.store_siswa_jadwal', $jadwal->id) }}" method="POST" id="form-siswa">
                @csrf
                <table class="table" id="table_siswa">
                    <thead>
                        <tr>
                            <td><input type="checkbox" id="checkAll"></td>
                            <td>Nama</td>
                            <td>Kamar</td>
                            <td>Jenis Kelamin</td>
                            {{-- <td>Aksi</td> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $key => $siswa)
                            <tr>
                                <td><input type="checkbox" id="check-{{ $key }}"></td>
                                <td>{{ $siswa->nama }}</td>
                                <td>
                                    @if ($siswa->nama)
                                        {{ $siswa->penghuni ? $siswa->penghuni->kamar->nama : '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $siswa->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    targets: 4,
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
                    data.push(item[4]);
                });
                $("#data_siswa_deleted").val(data);
                $("#form-delete-siswa").submit();
            });
        });
    </script>
@endpush
