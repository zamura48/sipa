@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h6>
                </div>
            </div>
        </div>
        <form action="{{ route('pengurus.absensi.presensi.save', $jadwal->id) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="data_table">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Nama</td>
                                <td>Kamar</td>
                                <td>Jenis Kelamin</td>
                                <td>Alpha</td>
                                <td>Izin</td>
                                <td>Masuk</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->siswa ? $item->siswa->nama : '-' }}</td>
                                    <td>
                                        @if ($item->siswa && isset($item->siswa->penghuni->kamar) )
                                            {{ $item->siswa->penghuni->kamar->nama }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->siswa ? ($item->siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') : '-' }}
                                    </td>
                                    <td><input type="radio" name="absensi_{{ $item->id }}" class="check-absen"
                                            id="check-absen-{{ $key }}" data-id="{{ $item->id }}"
                                            {{ $item->absensi ? ($item->absensi->absen == 1 ? 'checked' : '') : '' }}
                                            value="1">
                                    </td>
                                    <td><input type="radio" name="absensi_{{ $item->id }}" class="check-absen"
                                            id="check-izin-{{ $key }}" data-id="{{ $item->id }}"
                                            {{ $item->absensi ? ($item->absensi->izin == 1 ? 'checked' : '') : '' }}
                                            value="2">
                                    </td>
                                    <td><input type="radio" name="absensi_{{ $item->id }}" class="check-absen"
                                            id="check-sakit-{{ $key }}" data-id="{{ $item->id }}"
                                            {{ $item->absensi ? ($item->absensi->masuk == 1 ? 'checked' : '') : '' }}
                                            value="3">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="data_siswa_absen" id="data_siswa_absen">
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-success btn-save">Simpan</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#data_table').DataTable();

            $('.check-absen').each(function(index, element) {
                let checked = $(element).attr('checked');
                if (checked) {
                    let this_val = $(element).val();
                    let siswa_id = $(element).data('id');

                    store_absen(this_val, siswa_id);
                }

            });

            // Menangani perubahan radio button
            $('.check-absen').change(function() {
                let this_val = $(this).val(); // Nilai dari radio button yang dipilih (1 = Absen, 2 = Izin, 3 = Sakit)
                let siswa_id = $(this).data('id'); // ID siswa dari data-id

                store_absen(this_val, siswa_id);
            });

        });

        function store_absen(value, siswa_id) {
            let absensiData = JSON.parse($('#data_siswa_absen').val() || '{}');

            // Update data absen pada objek absensiData
            absensiData[siswa_id] = value;

            // Menyimpan data absen ke hidden input
            $('#data_siswa_absen').val(JSON.stringify(absensiData));
        }
    </script>
@endpush
