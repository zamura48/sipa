@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h6>
                </div>
                @if (auth()->user()->role_id = 1)
                    <div class="col-md-6">
                        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fa fa-plus mr-2"></i> Tambah Data
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sekolah</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Wali Murid</th>
                            <th>Periode Pendaftaran</th>
                            <th>Kamar</th>
                            @if (auth()->user()->role_id = 1)
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->sekolah ? $item->sekolah->nama_sekolah : '' }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis_kelamin = 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $item->ortu ? $item->ortu->nama : '' }}</td>
                                <td>{{ format_date_w_bs($item->periode->tgl_mulai) . ' - ' . format_date_w_bs($item->periode->tgl_akhir) }}
                                <td>{{ $item->penghuni ? $item->penghuni->kamar->nama : '-' }}</td>
                                </td>
                                @if (auth()->user()->role_id = 1)
                                    <td>
                                        <a href="{{ route('admin.siswa.show', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-info mr-2"></i> Detail
                                        </a>
                                        <form action="{{ route('admin.siswa.destroy', $item->id) }}" method="POST"
                                            style="display:inline;" id="delete-form-{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirm_delete({{ $item->id }})">
                                                <i class="fa fa-trash mr-2"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#data_table').DataTable({
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                }
            })
        });

        function confirm_delete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
