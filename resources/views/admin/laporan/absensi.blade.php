@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h6>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-danger">Pilih Filter Terlebih Dahulu</span>
                        </div>
                        <div class="col-md-6">
                            <label for="">Siswa</label>
                            <select name="siswa" id="siswa" class="form-control js-select2">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($siswas as $item)
                                    <option value="{{ $item->id }}" {{ $g_siswa == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="form-group">
                                <label for="">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                                    placeholder="Pilih Tanggal" value="{{ $tanggal_awal ?? '' }}">
                            </div>
                            <div class="form-group ml-3">
                                <label for="">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                                    placeholder="Pilih Tanggal" value="{{ $tanggal_akhir ?? '' }}">
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-success btn-sm mt-3 ml-3" id="cari_data">Cari</button>
                                <button class="btn btn-warning btn-sm mt-3 ml-3" id="clear_tanggal">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Alpha</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> <span id="total_absen"></span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Izin</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> <span id="total_izin"></span></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Masuk</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> <span id="total_masuk"></span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="data_table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jadwal</th>
                            <th>Tanggal Absen</th>
                            <th>Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $absen = 0;
                            $izin = 0;
                            $masuk = 0;
                        @endphp
                        @foreach ($data as $item)
                            @php
                                $tanggal = $item->absensi ? $item->absensi->tanggal : '-';
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa ? $item->siswa->nama : '-' }}</td>
                                <td>{{ $item->jadwal->nama }} <br> {{ datetime_indo($item->jadwal->tanggal) }}</td>
                                <td>{{ $tanggal }}
                                </td>
                                <td>
                                    @if ($item->absensi)
                                        @if ($item->absensi->absen == 1)
                                            <span class="badge badge-warning">Alpha</span>
                                        @endif
                                        @if ($item->absensi->izin == 1)
                                            <span class="badge badge-secondary">Izin</span><br>
                                            Alasan izin: {{ $item->absensi->alasan }}
                                        @endif
                                        @if ($item->absensi->masuk == 1)
                                            <span class="badge badge-success">Masuk</span>
                                        @endif
                                    @endif
                                </td>
                                @php
                                    if ($item->absensi) {
                                        $absen += $item->absensi->absen;
                                        $izin += $item->absensi->izin;
                                        $masuk += $item->absensi->masuk;
                                    }
                                @endphp
                                @if ($loop->last)
                                    <script>
                                        document.getElementById("total_absen").innerText = '{{ $absen }}';
                                        document.getElementById("total_izin").innerText = '{{ $izin }}';
                                        document.getElementById("total_masuk").innerText = '{{ $masuk }}';
                                    </script>
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
                                    '<tr class="group"><td colspan="7">Nama Siswa: <span class="badge badge-success">' +
                                    group + '</span></td></tr>'
                                );

                                last = group;
                            }
                        });
                }
            });

            $("#cari_data").click(function(e) {
                e.preventDefault();
                let tanggal_awal = $("#tanggal_awal").val();
                let tanggal_akhir = $("#tanggal_akhir").val();
                let siswa = $("#siswa").val();
                window.location.href = "{{ url()->current() }}?tanggal_awal=" + tanggal_awal +
                    "&tanggal_akhir=" + tanggal_akhir + "&siswa=" +
                    siswa;
            });

            $("#clear_tanggal").click(function(e) {
                e.preventDefault();
                let tanggal_awal = $("#tanggal_awal").val('');
                let tanggal_akhir = $("#tanggal_akhir").val('');
                let siswa = $("#siswa").val('');

                window.location.href = "{{ url()->current() }}?tanggal_awal=" + tanggal_awal +
                    "&tanggal_akhir=" + tanggal_akhir + "&siswa=" +
                    siswa;
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
