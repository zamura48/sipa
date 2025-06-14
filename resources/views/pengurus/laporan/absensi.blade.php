@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h6>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span class="text-danger">Pilih Tanggal Terlebih Dahulu</span>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Pilih Tanggal"
                            value="{{ $tanggal ?? '' }}">
                    </div>
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
                            <th>Jadwal</th>
                            <th>Tanggal</th>
                            <th>Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            @php
                                $tanggal = $item->absensi ? $item->absensi->tanggal : '-';
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa ? $item->siswa->nama : '-' }}</td>
                                <td>{{ $item->jadwal->nama }}</td>
                                <td>{{ datetime_indo($item->tanggal) }} <br> {{ ' Tanggal Absen: ' . $tanggal }}
                                </td>
                                <td>
                                    @if ($item->absensi)
                                        @if ($item->absensi->absen == 1)
                                            <span class="badge badge-warning">Alpha</span>
                                        @endif
                                        @if ($item->absensi->izin == 1)
                                            <span class="badge badge-secondary">Izin</span>
                                        @endif
                                        @if ($item->absensi->masuk == 1)
                                            <span class="badge badge-success">Masuk</span>
                                        @endif
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
            let groupColumn = 1;

            var table = $('#data_table').DataTable({
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                },
                columnDefs: [{
                    visible: false,
                    targets: groupColumn
                }, {
                    targets: 0,
                    width: '5%'
                }],
                drawCallback: function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(groupColumn, {
                            page: 'current'
                        })
                        .data()
                        .each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="7">Nama: <span class="badge badge-success">' +
                                    group + '</span></td></tr>'
                                );

                                last = group;
                            }
                        });
                }
            });

            $("#tanggal").change(function(e) {
                e.preventDefault();
                window.location.href = "{{ url()->current() }}?tanggal=" + $(this).val();
            });
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
