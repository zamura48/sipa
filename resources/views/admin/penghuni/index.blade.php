@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Kapasitas</th>
                            <th>Penghuni</th>
                            <th>Sisa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                @if ($item->jenis == 'L')
                                    <td>Laki - Laki</td>
                                @elseif ($item->jenis == 'P')
                                    <td>Perempuan</td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>{{ $item->jumlah_penghuni }}</td>
                                <td>{{ $item->penghunis_count }}</td>
                                <td>{{ $item->jumlah_penghuni - $item->penghunis_count }}</td>
                                <td>
                                    <a href="{{ route('admin.penghuni.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-info mr-2"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.penghuni.pindah', $item->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-retweet mr-2"></i> Pindah Kamar
                                    </a>
                                </td>
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
