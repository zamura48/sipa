@extends('template.admin')

@section('content')
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pendaftar Belum Tekonfirmasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendaftar_belum_confirm }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pendaftar Terkonfirmasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendaftar_confirm }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Total Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_siswa }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Tagihan Belum Terbayar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tagihan_belum_terbayar }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tagihan Terbayar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tagihan_terbayar }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Tagihan Ditolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tagihan_ditolak }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pendapatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Total Pendaftar</h4>
                </div>
                <div class="card-body">
                    <div id="chart-total-pendaftar"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Tagihan</h4>
                </div>
                <div class="card-body">
                    <div id="chart-tagihan"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Sisa Kamar</h4>
                </div>
                <div class="card-body">
                    <div id="chart-sisa-kamar"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Total Absensi Per Tanggal {{ date_indo($tanggal_hari_ini) }}</h4>
                </div>
                <div class="card-body">
                    <div id="chart-absensi"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-header">
                    <h5>List kamar yang hampir penuh</h5>
                </div>
                <div class="card-body">
                    <table id="data_table" class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kapasitas</th>
                                <th>Penghuni</th>
                                <th>Sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($sisa_kamar as $item)
                                @if ($item->jumlah_penghuni - $item->penghunis_count > 0)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jumlah_penghuni }}</td>
                                        <td>{{ $item->penghunis_count }}</td>
                                        <td>{{ $item->jumlah_penghuni - $item->penghunis_count }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            chart_sisa_kamar();
            chart_total_pendaftar();
            chart_tagihan();
            chart_total_absensi();

            $("#chart-sisa-kamar .apx-legend-position-bottom").html(`<div class="">
    <div class="d-flex mt-2">
        <div class="d-flex align-items-center mr-4">
            <span class="d-inline-block mr-2" style="width: 14px; height: 14px; background-color: #008FFB;"></span>
            <span>Laki-laki</span>
        </div>
        <div class="d-flex align-items-center">
            <span class="d-inline-block mr-2" style="width: 14px; height: 14px; background-color: #FEB019;"></span>
            <span>Perempuan</span>
        </div>
    </div>
</div>
`);
        });

        function chart_tagihan() {
            var options = {
                series: [{
                    name: 'Total',
                    data: @json($data_tagihan)
                }, ],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        borderRadius: 5,
                        borderRadiusApplication: 'end',
                        distributed: true // aktifkan ini
                    },
                },
                colors: ['#00E396', '#008FFB', '#FEB019', '#FF4560', '#775DD0'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: @json($data_nama_tagihan),
                },
                yaxis: {
                    title: {
                        text: ''
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-tagihan"), options);
            chart.render();
        }

        function chart_sisa_kamar() {
            let jenis_kamar = @json($data_jenis_kamar);
            var options = {
                series: [{
                    name: 'Total',
                    data: @json($data_sisa_kamar)
                }, ],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        borderRadius: 5,
                        borderRadiusApplication: 'end',
                        distributed: true // aktifkan ini
                    },
                },
                colors: jenis_kamar.map(jenis => {
                    return jenis == 'L' ? '#008FFB' : '#FEB019';
                }),
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: @json($data_nama_kamar),
                },
                yaxis: {
                    title: {
                        text: ''
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-sisa-kamar"), options);
            chart.render();
        }

        function chart_total_pendaftar() {
            var options = {
                series: [{
                    name: 'Total Pendaftar',
                    data: @json($total_pendaftar)
                }, {
                    name: 'Pendaftar Terkonfirmasi',
                    data: @json($total_pendaftar_confirm)
                }, {
                    name: 'Pendaftar Belum Konfirmasi',
                    data: @json($total_pendaftar_not_confirm)
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        borderRadius: 5,
                        borderRadiusApplication: 'end'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: @json($data_sekolah),
                },
                yaxis: {
                    title: {
                        text: ''
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-total-pendaftar"), options);
            chart.render();
        }

        function chart_total_absensi() {
            var options = {
                series: [{
                    name: 'Alpha',
                    data: @json($absensi_absen)
                }, {
                    name: 'Masuk',
                    data: @json($absensi_masuk)
                }, {
                    name: 'Izin',
                    data: @json($absensi_izin)
                }, {
                    name: 'Belum Diabsen',
                    data: @json($belum_diabsen)
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        borderRadius: 5,
                        borderRadiusApplication: 'end'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: @json($jadwal_label),
                },
                yaxis: {
                    title: {
                        text: ''
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-absensi"), options);
            chart.render();
        }
    </script>
@endpush
