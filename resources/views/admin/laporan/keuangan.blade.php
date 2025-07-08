@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h6>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-danger">Pilih Filter Terlebih Dahulu</span>
                        </div>
                        <div class="col-md-12 d-flex">
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
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pendapatan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <span
                                            id="total_pendapatan"></span></div>
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
                            <th>Nama Siswa</th>
                            <th>Iuran</th>
                            <th>Tagihan</th>
                            <th>Bukti Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa ? $item->siswa->nama : '-' }} <br>
                                    <span class="badge badge-info">
                                        NIS: {{ $item->siswa ? $item->siswa->nis : '-' }}
                                    </span>
                                </td>
                                <td>{{ $item->iuran->nama }}</td>
                                <td>{{ $item->total_semua }}</td>
                                <td>
                                    @if ($item->bukti_bayar)
                                        <a href="{{ asset('bukti_bayar/' . $item->bukti_bayar) }}" target="_blank"
                                            class="btn btn-info">Lihat Foto</a>
                                    @endif
                                </td>
                                @php
                                    $total += $item->total_semua;
                                @endphp
                                @if ($loop->last)
                                    <script>
                                        document.getElementById("total_pendapatan").innerText = '{{ $total }}';
                                    </script>
                                @endif
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
            });

            $("#cari_data").click(function(e) {
                e.preventDefault();
                let tanggal_awal = $("#tanggal_awal").val();
                let tanggal_akhir = $("#tanggal_akhir").val();
                window.location.href = "{{ url()->current() }}?tanggal_awal=" + tanggal_awal +
                    '&tanggal_akhir=' + tanggal_akhir;
            });

            $("#clear_tanggal").click(function(e) {
                e.preventDefault();

                let tanggal_awal = $("#tanggal_awal").val('');
                let tanggal_akhir = $("#tanggal_akhir").val('');

                window.location.href = "{{ url()->current() }}?tanggal_awal=" + tanggal_awal +
                    '&tanggal_akhir=' + tanggal_akhir;
            });
        });
    </script>
@endpush
