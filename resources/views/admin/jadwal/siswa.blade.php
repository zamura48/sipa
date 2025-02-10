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
            <form action="{{ route('admin.jadwal.store') }}" method="POST">
                @csrf
                <table class="table">
                    <tr>
                        <td style="width: 150px">Nama Jadwal</td>
                        <td style="width: 30px">:</td>
                        <td>{{ $jadwal->nama }}</td>
                    </tr>
                    <tr>
                        <td>Hari</td>
                        <td>:</td>
                        <td>{{ $jadwal->hari }}</td>
                    </tr>
                    <tr>
                        <td>Jam</td>
                        <td>:</td>
                        <td>{{ $jadwal->jam }}</td>
                    </tr>
                </table>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary mr-2"><i
                                class="fa fa-arrow-left mr-2"></i>Kembali</a>
                    </div>
                    <div class="col-md-6 text-left">
                        <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save mr-2"></i>Simpan</button>
                    </div>
                </div>
                <table class="table" id="table_siswa">
                    <thead>
                        <tr>
                            <td><input type="checkbox" id="checkAll"></td>
                            <td>Nama</td>
                            <td>Kamar</td>
                            <td>Jenis Kelamin</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $key => $siswa)
                            <tr>
                                <td><input type="checkbox" id="check-{{ $key }}"></td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->kamar ? $siswa->kamar->nama : '' }}</td>
                                <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                }]
            });


            table.on('click', 'tbody tr', function(e) {
                console.log(e);

                e.currentTarget.classList.toggle('selected');
            });
        });
    </script>
@endpush
