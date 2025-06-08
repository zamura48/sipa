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
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Aksi <br><small class="text-danger">Tombol absen akan muncul sesuai dengan hari.</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            @php
                                $tanggal = $item->tanggal;
                                $explode = explode(', ', $tanggal);
                                $hari = '';
                                if (count($explode) > 0) {
                                    $hari = $explode[0];
                                }
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ datetime_indo($tanggal) }}</td>
                                <td>
                                    <ul>
                                        @foreach ($item->jadwalDetails as $value)
                                            <li>{{ $value->kegiatan->nama }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if (date('Y-m-d', strtotime($tanggal)) == date('Y-m-d'))
                                        <a href="{{ route('pengurus.absensi.presensi', $item->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus mr-2"></i> Absensi
                                        </a>
                                    @endif
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
